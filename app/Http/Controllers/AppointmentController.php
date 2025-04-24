<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\Appointment;
use App\Models\HospitalUser;
use App\Notifications\AppointmentScheduled;

class AppointmentController extends Controller
{
    public function create($patientId)
    {
        $patient      = HospitalUser::where('role','patient')->findOrFail($patientId);
        $doctors      = HospitalUser::where('role','doctor')->orderBy('name')->get();
        $radiologists = HospitalUser::where('role','radiologist')->orderBy('name')->get();
        $radiographers= HospitalUser::where('role','radiographer')->orderBy('name')->get();

        return view('management.appointment', compact(
            'patient','doctors','radiologists','radiographers'
        ));
    }

    public function store(Request $request, $patientId)
    {
        $data = $request->validate([
            'doctor_id'        => 'required|exists:hospital_users,id',
            'radiologist_id'   => 'nullable|exists:hospital_users,id',
            'radiographer_id'  => 'nullable|exists:hospital_users,id',
            'appointment_date' => 'required|date_format:Y-m-d\TH:i',
        ]);

        // 1) Update patient’s assigned staff
        $patient = HospitalUser::where('role','patient')->findOrFail($patientId);
        $patient->update([
            'assigned_doctor_id'      => $data['doctor_id'],
            'assigned_radiologist_id' => $data['radiologist_id'],
            'assigned_radiographer_id'=> $data['radiographer_id'],
        ]);

        // 2) Create the appointment
        $appointment = Appointment::create([
            'hospital_user_id'  => $patient->id,
            'full_name'         => $patient->name,
            'dob'               => $patient->dob,
            'ic'                => $patient->ic,
            'address'           => $patient->address,
            'username'          => $patient->username,
            'doctor_id'         => $data['doctor_id'],
            'radiologist_id'    => $data['radiologist_id'],
            'radiographer_id'   => $data['radiographer_id'],
            'appointment_date'  => $data['appointment_date'],
        ]);

        // 3) Notify patient & doctor
        $doctor = HospitalUser::findOrFail($data['doctor_id']);
        $patient->notify(new AppointmentScheduled($appointment));
        $doctor->notify(new AppointmentScheduled($appointment));

        return redirect()
            ->route('management.dashboard')
            ->with('success','Appointment booked & notifications sent.');
    }
}
