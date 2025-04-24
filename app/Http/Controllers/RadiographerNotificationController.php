<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;

class RadiographerNotificationController extends Controller
{
    /**
     * Display the radiographer’s notifications.
     */
    public function index(Request $request)
    {
        $radId = session('hospital_user');
        $rad   = HospitalUser::where('role','radiographer')->find($radId);

        $notifications = $rad
            ? $rad->notifications
            : collect();

        return view('radiographer.notifications', compact('notifications'));
    }

    /**
     * Mark all unread notifications as read.
     */
    public function markAllRead(Request $request)
    {
        $radId = session('hospital_user');
        $rad   = HospitalUser::where('role','radiographer')->find($radId);

        if ($rad) {
            $rad->unreadNotifications->markAsRead();
        }

        return redirect()->route('radiographer.notifications.index');
    }
}
