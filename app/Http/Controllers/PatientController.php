<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\HospitalUser;
use App\Models\PatientImage;
use App\Models\PatientReport;
use App\Jobs\ProcessMRIImage;
use App\Notifications\ReportCompleted;
use Illuminate\Support\Facades\Log;
use App\Notifications\ScanUploaded;
use Illuminate\Support\Facades\Notification;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with(['reports', 'appointments'])->get(); // Prevents N+1 queries
        return view('patient.dashboard', compact('patients'));
    }
    
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
        // 1) Validate the upload
        $request->validate([
            'scan' => 'required|mimes:jpg,png,pdf|max:2048',
        ]);

        // 2) Retrieve the patient model
        $patient = HospitalUser::where('role','patient')->findOrFail($patientId);

        // 3) Save the file to disk
        $path = $request->file('scan')->storeAs('scans', $request->file('scan')->getClientOriginalName(), 'public');

        // 4) Create the DB record
        PatientImage::create([
            'hospital_user_id' => $patient->id,
            'image_path'       => $path,
        ]);

        $radiographer = HospitalUser::findOrFail(session('hospital_user'));
        $admins        = HospitalUser::where('role','admin')->get();

        Notification::send(
            $admins,
            new ScanUploaded($radiographer, $patient)
        );

        // 5) Redirect back with a success message
        return redirect()
            ->route('radiographer.dashboard')
            ->with('success', 'Scan uploaded & admins have been notified.');
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
    
        $patient = HospitalUser::where('role','patient')->findOrFail($patientId);
        $file    = $request->file('report');
        $filename= $file->getClientOriginalName();
    
        // 1) Store the PDF
        $path = $file->storeAs('reports', $filename, 'public');
    
        // 2) Insert into patient_reports
        PatientReport::create([
            'hospital_user_id' => $patient->id,
            'report_path'      => $path,
        ]);
    
        // 3) Dispatch the “report complete” notification
        $radiologist = HospitalUser::findOrFail(session('hospital_user'));
        $admins      = HospitalUser::where('role','hospital admin')->get();
    
        // Notify all hospital admins
        Notification::send($admins, new ReportCompleted($radiologist, $patient));
    
        // Notify assigned doctor if there is one
        if ($doctor = $patient->assignedDoctor) {
            $doctor->notify(new ReportCompleted($radiologist, $patient));
        }
    
        return redirect()
               ->route('radiologist.dashboard')
               ->with('success','Report uploaded and notifications sent.');
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
        // 1) Load the patient
        $patient = HospitalUser::findOrFail($patientId);
    
        // 2) Pull radiologist from session
        $radiologistId = session('hospital_user');
        $radiologist   = HospitalUser::where('role','radiologist')->find($radiologistId);
    
        if (! $radiologist) {
            return redirect()
                ->route('radiologist.dashboard')
                ->with('error','Radiologist not recognized.');
        }
    
        // 3) Notify all hospital admins
        HospitalUser::where('role','hospital admin')
            ->get()
            ->each
            ->notify(new ReportCompleted($radiologist, $patient));
    
        // 4) Also notify the assigned doctor (if any)
        if ($doctor = $patient->assignedDoctor) {
            $doctor->notify(new ReportCompleted($radiologist, $patient));
        }
    
        return redirect()
            ->route('radiologist.dashboard')
            ->with('success','Patient marked complete & notifications sent to admins and doctor.');
    }
    

}