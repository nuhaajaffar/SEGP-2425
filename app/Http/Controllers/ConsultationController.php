<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;
use App\Models\Appointment;
use App\Notifications\AppointmentBooked;
use Illuminate\Support\Facades\Notification;

class ConsultationController extends Controller
{
    /** Show the “book consultation” form **/
    public function create()
    {
        $patients = HospitalUser::where('role','patient')
                                ->orderBy('name')
                                ->get();
        return view('doctor.consultation', compact('patients'));
    }

    /** Validate input, save to appointments table, send notifications **/
    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id'       => 'required|exists:hospital_users,id',
            'appointment_date' => 'required|date|after:now',
        ]);

        // Lookup the patient record:
        $patient = HospitalUser::findOrFail($data['patient_id']);

        // Persist a new row in appointments (copying patient info into it)
        $appt = Appointment::create([
            'full_name'       => $patient->name,
            'dob'             => $patient->dob,
            'ic'              => $patient->ic,
            'address'         => $patient->address,
            'username'        => $patient->username,
            'doctor_id'       => session('hospital_user'),
            'radiologist_id'  => null,
            'radiographer_id' => null,
            'appointment_date'=> $data['appointment_date'],
        ]);

        // Notify admins, the doctor, and the patient
        $admins  = HospitalUser::where('role','admin')->get();
        $doctor  = HospitalUser::findOrFail($appt->doctor_id);

        Notification::send($admins,   new AppointmentBooked($appt));
        $doctor->notify(  new AppointmentBooked($appt));
        $patient->notify(new AppointmentBooked($appt));

        return redirect()
            ->route('doctor.consultation')
            ->with('success','Consultation booked & notifications sent.');
    }
}
