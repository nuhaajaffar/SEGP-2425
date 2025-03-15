<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;
use App\Models\PatientImage;
use App\Models\PatientReport;

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
        return view('radiologist.upload-scan', compact('patient'));
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
        PatientImage::create([
            'hospital_user_id' => $patient->id,
            'image_path'       => $path,
        ]);
        
        // Redirect to the radiologist dashboard with a success message
        return redirect()->route('radiologist.dashboard')
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
        return view('radiographer.report', compact('patient'));
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
            'report_path'      => $path,
        ]);
        
        return redirect()->route('radiographer.dashboard')
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
        $patient = HospitalUser::with(['images', 'report'])
                     ->where('role', 'patient')
                     ->findOrFail($patientId);
        return view('radiographer.report', compact('patient'));
    }
    
}
