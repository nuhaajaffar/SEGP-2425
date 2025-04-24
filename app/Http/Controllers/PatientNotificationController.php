<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;

class PatientNotificationController extends Controller
{
    /**
     * Show the patient’s notifications.
     */
    public function index()
    {
        // Pull the patient’s ID out of the session
        $patientId = session('hospital_user');

        // Look up the HospitalUser
        $patient = HospitalUser::find($patientId);

        // If no patient in session, show empty
        $notes = $patient
            ? $patient->notifications
            : collect();

        return view('patient.notifications', compact('notes'));
    }

    /**
     * Mark all as read.
     */
    public function markAllRead()
    {
        $patientId = session('hospital_user');
        $patient   = HospitalUser::find($patientId);

        if ($patient) {
            $patient->unreadNotifications->markAsRead();
        }

        return redirect()->route('patient.notifications');
    }
}
