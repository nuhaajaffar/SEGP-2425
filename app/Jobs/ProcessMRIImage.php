<?php

namespace App\Jobs;

use App\Models\PatientReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessMRIImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $patientId;
    public $imagePath; // Full filesystem path to the uploaded image

    public function __construct($patientId, $imagePath)
    {
        $this->patientId = $patientId;
        $this->imagePath = $imagePath;
    }

    public function handle()
    {
        \Log::info("Processing MRI image for patient: " . $this->patientId);
        set_time_limit(0);
    
        $scriptPath = base_path('app/ai_model/MRI_Analysis.py');
        $baseName = pathinfo($this->imagePath, PATHINFO_FILENAME);
        $reportFilename = $baseName . '_report.pdf';
    
        // Use public_path to save directly in public/storage/reports
        $reportsDir = public_path('storage/reports');
        if (!file_exists($reportsDir)) {
            mkdir($reportsDir, 0755, true);
        }
        $reportOutputPath = $reportsDir . '/' . $reportFilename;
        
        // Build the command (adjust the python command if needed)
        $command = "py -3.11 " 
                 . escapeshellarg($scriptPath) . " " 
                 . escapeshellarg($this->imagePath) . " " 
                 . escapeshellarg($reportOutputPath);
        \Log::info("Command: " . $command);
        
        // Run command synchronously so that PHP waits for it to finish.
        $output = shell_exec($command);
        \Log::info("AI script output: " . $output);
        
        // Wait a few seconds to ensure the file has been written
        sleep(5);
        
        if (file_exists($reportOutputPath)) {
            \Log::info("Report generated at: " . $reportOutputPath);
            // Store the relative path (so asset() can generate the URL correctly)
            $reportPathForDB = "storage/reports/" . $reportFilename;
        } else {
            \Log::warning("Report not generated. Command output may indicate an error.");
            $reportPathForDB = "No report generated due to processing error.";
        }
        
        \App\Models\PatientReport::updateOrCreate(
            ['hospital_user_id' => $this->patientId],
            ['report_path' => $reportPathForDB]
        );
    }
    
}
