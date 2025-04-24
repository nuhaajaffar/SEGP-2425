<?php
// app/Http/Controllers/NotificationController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;
use Illuminate\Support\Collection;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        // Always build a Collection, even if session key is missing
        $admin = HospitalUser::where('role','hospital admin')->first();
        $notifications = $admin
            ? $admin->notifications
            : collect();

        return view('admin.notifications', compact('notifications'));
    }

    public function markAllRead(Request $request)
    {
        $admin = HospitalUser::where('role', 'hospital admin')->first();

        if ($admin ){
            $admin->unreadNotifications->markAsRead();
        }

        return redirect()->route('admin.notifications.index');
    }
}
