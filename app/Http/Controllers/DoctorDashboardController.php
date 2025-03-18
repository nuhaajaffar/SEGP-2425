<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        // For now, fetch all patients.
        // Later, you might filter by assigned doctor.
        $patients = HospitalUser::where('role', 'patient')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('doctor.dashboard', compact('patients'));
    }

    // Optional: Add a review method if needed
    public function review($patientId)
    {
        $patient = HospitalUser::where('role', 'patient')->findOrFail($patientId);
        return view('doctor.review', compact('patient'));
    }

    public function uploadReportStore(Request $request, $patientId)
    {
        // Validate and process the file upload here
        // For example:
        $request->validate([
            'report' => 'required|mimes:pdf|max:2048',
        ]);
        
        // Retrieve the patient (assumed to be a HospitalUser with role 'patient')
        $patient = HospitalUser::where('role', 'patient')->findOrFail($patientId);
        
        // Process file upload (for example, store the file)
        $file = $request->file('report');
        $filename = $file->getClientOriginalName();
        $path = $file->storeAs('reports', $filename, 'public');
    
        // Update the patient or create a report record as needed
        // For example, if using a PatientReport model:
        // PatientReport::create([
        //     'hospital_user_id' => $patient->id,
        //     'report_path'      => $path,
        // ]);
    
        return redirect()->back()->with('success', 'Report uploaded successfully.');
    }

}
