<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;

class ManagementController extends Controller
{
    /**
     * Display the Manage Patient list.
     */
    public function managePatient()
    {
        // Retrieve all patients with role 'patient' (case-insensitive check)
        $patients = HospitalUser::whereRaw('LOWER(role) = ?', ['patient'])
            ->orderBy('name', 'asc')
            ->get();

        return view('management.manage-patient', compact('patients'));
    }

    /**
     * Show the edit form for a patient profile.
     */
    public function editPatient($id)
    {
        // Retrieve the patient record (ensure role is 'patient')
        $patient = HospitalUser::where('role', 'patient')->findOrFail($id);
        return view('management.profile', compact('patient'));
    }

    /**
     * Update the patient record.
     */
    public function updatePatient(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required|string|max:100|unique:hospital_users,username,' . $id,
            'name'     => 'required|string|max:255',
            'ic'       => 'required|string|max:50',
            'address'  => 'required|string|max:255',
            'contact'  => 'required|string|max:50',
            'dob'      => 'required|date',
            'sex'      => 'required|in:male,female',
        ]);

        // Retrieve the patient record
        $patient = HospitalUser::where('role', 'patient')->findOrFail($id);

        // Update the record (hospital_id remains unchanged)
        $patient->update([
            'username' => $request->username,
            'name'     => $request->name,
            'ic'       => $request->ic,
            'address'  => $request->address,
            'contact'  => $request->contact,
            'dob'      => $request->dob,
            'sex'      => $request->sex,
        ]);

        return redirect()->route('management.manage-patient')
                         ->with('success', 'Patient profile updated successfully.');
    }
}
