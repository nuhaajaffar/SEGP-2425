<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;

class DoctorNotificationController extends Controller
{
    /**
     * Display the doctor’s notifications.
     */
    public function index(Request $request)
    {
        // Assuming you store the logged‑in doctor’s ID in session
        $doctorId = session('hospital_user');
        $doctor   = HospitalUser::where('role','doctor')->find($doctorId);

        $notifications = $doctor
            ? $doctor->notifications
            : collect();

        return view('doctor.notifications', compact('notifications'));
    }

    /**
     * Mark all unread notifications as read.
     */
    public function markAllRead(Request $request)
    {
        $doctorId = session('hospital_user');
        $doctor   = HospitalUser::where('role','doctor')->find($doctorId);

        if ($doctor) {
            $doctor->unreadNotifications->markAsRead();
        }

        return redirect()->route('doctor.notifications.index');
    }
}
