<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\HospitalUser;

class AppointmentController extends Controller
{
    /**
     * Display the appointment booking form.
     * Patient information is pre-populated.
     * Dropdowns are used to select a doctor, radiologist, and radiographer.
     */
    public function create($patientId)
    {
        // Retrieve the patient details (assuming role is 'patient')
        $patient = HospitalUser::where('role', 'patient')->findOrFail($patientId);

        // Retrieve lists for dropdowns
        $doctors = HospitalUser::where('role', 'doctor')->orderBy('name')->get();
        $radiologists = HospitalUser::where('role', 'radiologist')->orderBy('name')->get();
        $radiographers = HospitalUser::where('role', 'radiographer')->orderBy('name')->get();

        return view('management.appointment', compact('patient', 'doctors', 'radiologists', 'radiographers'));
    }

    /**
     * Process the appointment booking.
     */
    public function store(Request $request, $patientId)
    {
        $request->validate([
            'doctor_id'        => 'required|exists:hospital_users,id',
            'radiologist_id'   => 'nullable|exists:hospital_users,id',
            'radiographer_id'  => 'nullable|exists:hospital_users,id',
            'appointment_date' => 'required|date_format:Y-m-d\TH:i',
        ]);
    
        $patient = HospitalUser::where('role', 'patient')->findOrFail($patientId);
    
        // Create the appointment record
        Appointment::create([
            'full_name'        => $patient->name,
            'dob'              => $patient->dob,
            'ic'               => $patient->ic,
            'address'          => $patient->address,
            'username'         => $patient->username,
            'doctor_id'        => $request->doctor_id,
            'radiologist_id'   => $request->radiologist_id,
            'radiographer_id'  => $request->radiographer_id,
            'appointment_date' => $request->appointment_date,
        ]);
    
        // **Important:** Update the patient record with assignment info
        $patient->update([
            'assigned_doctor_id'        => $request->doctor_id,
            'assigned_radiologist_id'   => $request->radiologist_id,
            'assigned_radiographer_id'  => $request->radiographer_id,
        ]);
    
        return redirect()->route('management.dashboard')
                         ->with('success', 'Appointment booked successfully.');
    }
    
}
