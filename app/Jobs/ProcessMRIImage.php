<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\HospitalUser;
use App\Models\PatientReport;

class ProcessMRIImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $patientId;
    public string $imagePath;

    public function __construct(int $patientId, string $imagePath)
    {
        $this->patientId = $patientId;
        $this->imagePath = $imagePath;
    }

    public function handle()
    {
        Log::info("⚙️ [ProcessMRIImage] Starting job for patient {$this->patientId}");
        // 1) Ensure the reports directory exists
        $reportsDir = public_path('storage/reports');
        Log::info("➡️ Reports dir: {$reportsDir}");
        if (! file_exists($reportsDir)) {
            mkdir($reportsDir, 0755, true);
            Log::info("➡️ Created reports dir");
        }

        // 2) Dump patient info into JSON
        $patient = HospitalUser::findOrFail($this->patientId);
        $infoDir   = storage_path('app/public/temp');
        $infoPath  = $infoDir . "/patient_{$this->patientId}_info.json";
        if (! file_exists($infoDir)) {
            mkdir($infoDir, 0755, true);
        }
        file_put_contents($infoPath, json_encode([
            'name' => $patient->name,
            'dob'  => $patient->dob,
            'sex'  => $patient->sex,
            // add more fields as needed…
        ]));
        Log::info("➡️ Wrote patient info JSON: {$infoPath}");

        // 3) Build the Python command with 3 args
        $scriptPath       = base_path('app/ai_model/MRI_Analysis.py');
        $baseName         = pathinfo($this->imagePath, PATHINFO_FILENAME);
        $reportOutputPath = "{$reportsDir}/{$baseName}_report.pdf";

        $command = 'py -3.11'
                 . ' "' . $scriptPath       . '"'
                 . ' "' . $this->imagePath  . '"'
                 . ' "' . $reportOutputPath . '"'
                 . ' "' . $infoPath         . '"';

        Log::info("▶️ Running: {$command}");

        // 4) Exec & capture everything
        $output   = [];
        $exitCode = null;
        exec($command . ' 2>&1', $output, $exitCode);
        Log::info("▶️ Exit code: {$exitCode}");
        Log::info("▶️ Output:\n" . implode("\n", $output));

        // 5) Check for the PDF
        $generated = file_exists($reportOutputPath);
        Log::info("📂 Reports dir now contains: " . implode(', ', array_diff(scandir($reportsDir), ['.', '..'])));
        Log::info($generated
            ? "✔️ Found PDF at {$reportOutputPath}"
            : "❌ PDF not generated.");

        // 6) Store a new PatientReport (one per scan)
        $reportPathForDB = $generated
            ? "storage/reports/{$baseName}_report.pdf"
            : "No report generated (processing error).";

        Log::info("DB → recording report for patient {$this->patientId}");
        try {
            PatientReport::create([
                'hospital_user_id' => $this->patientId,
                'report_path'      => $reportPathForDB,
            ]);
            Log::info("DB → report-record saved: {$reportPathForDB}");
        } catch (\Exception $e) {
            Log::error("DB → failed to save report: " . $e->getMessage());
        }
    }
}
