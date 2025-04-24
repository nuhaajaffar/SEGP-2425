<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;
use App\Models\PatientImage;
use App\Models\PatientReport;
use App\Jobs\ProcessMRIImage;
use App\Notifications\ReportCompleted;
use Illuminate\Support\Facades\Log;


class PatientController extends Controller
{
    /**
     * Show the form for uploading a scan for a specific patient.
     *
     * @param  int  $patientId
     * @return \Illuminate\Http\Response
     */
    public function uploadScanForm($patientId)
    {
        // Retrieve the patient (ensure the role is 'patient')
        $patient = HospitalUser::where('role', 'patient')->findOrFail($patientId);
        return view('radiographer.upload-scan', compact('patient'));
    }
    
    /**
     * Process the scan upload and link it to the patient.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $patientId
     * @return \Illuminate\Http\Response
     */
    public function uploadScanStore(Request $request, $patientId)
    {
        $request->validate([
            'scan' => 'required|mimes:jpg,png,pdf|max:2048',
        ]);
        
        $patient = HospitalUser::where('role', 'patient')->findOrFail($patientId);
        $file = $request->file('scan');
        $filename = $file->getClientOriginalName();
        
        // Save the file in the "scans" folder on the public disk
        $path = $file->storeAs('scans', $filename, 'public');
        
        // Create a record in the patient_images table
        \App\Models\PatientImage::create([
            'hospital_user_id' => $patient->id,
            'image_path'       => $path,
        ]);
        
        // Dispatch the job to process the scan (convert the storage path to a full system path)
        \App\Jobs\ProcessMRIImage::dispatch($patient->id, storage_path('app/public/' . $path));
        
        return redirect()->route('radiographer.dashboard')
                         ->with('success', 'Scan uploaded successfully for patient: ' . $patient->name);
    }
    
    /**
     * Show the form for uploading a report (PDF) for a specific patient.
     *
     * @param  int  $patientId
     * @return \Illuminate\Http\Response
     */
    public function uploadReportForm($patientId)
    {
        // Retrieve the patient (ensure the role is 'patient')
        $patient = HospitalUser::where('role', 'patient')->findOrFail($patientId);
        // Return the view located at resources/views/radiographer/report.blade.php
        return view('radiologist.report', compact('patient'));
    }
    
    /**
     * Process the report upload and link it to the patient.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $patientId
     * @return \Illuminate\Http\Response
     */
    public function uploadReportStore(Request $request, $patientId)
    {
        $request->validate([
            'report' => 'required|mimes:pdf|max:2048',
        ]);
        
        $patient = HospitalUser::where('role', 'patient')->findOrFail($patientId);
        $file = $request->file('report');
        $filename = $file->getClientOriginalName();
        // Save the file in the "reports" folder on the public disk
        $path = $file->storeAs('reports', $filename, 'public');
        
        // Create a record in the patient_reports table
        PatientReport::create([
            'hospital_user_id' => $patient->id,
            'image_path'       => $this->imagePath,
            'report_path'      => $reportPathForDB,
        ]);
        
        return redirect()->route('radiologist.dashboard')
                         ->with('success', 'Report uploaded successfully for patient: ' . $patient->name);
    }
    
    /**
     * Display patient details along with any linked scan and report.
     * (This method is for patients to view details, not for radiologists.)
     *
     * @param  int  $patientId
     * @return \Illuminate\Http\Response
     */
    public function view($patientId)
    {
        $patient = HospitalUser::with(['images', 'reports'])
                     ->where('role', 'patient')
                     ->findOrFail($patientId);
        return view('radiologist.report', compact('patient'));
    }

    /**
    * Mark a patient's report as complete and notify all doctors.
    * 
    * @param  int  $patientId
    * @return \Illuminate\Http\RedirectResponse
    */
    
    public function markComplete(int $patientId)
    {
        // 1) Fetch patient
        $patient = HospitalUser::findOrFail($patientId);
    
        // 2) Identify radiologist from session
        $radiologistId = session('hospital_user');
        $radiologist   = HospitalUser::where('role','radiologist')->find($radiologistId);
    
        // 3) Log it
        Log::info("Radiologist {$radiologistId} marked patient {$patientId} complete.");
    
        // 4) Notify **all** doctors
        HospitalUser::where('role', 'doctor')
            ->get()
            ->each
            ->notify(new ReportCompleted($radiologist, $patient));
    
        // 5) Redirect back
        return redirect()
            ->route('radiologist.dashboard')
            ->with('success', 'Patient marked complete & doctors have been notified.');
    }

}