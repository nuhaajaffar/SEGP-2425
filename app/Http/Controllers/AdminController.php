<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;

class AdminController extends Controller
{
    /**
     * Show the hospital-admin dashboard.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show all notifications for the logged-in admin.
     */
    public function notifications()
    {
        $adminId = session('hospital_user');
        $admin   = HospitalUser::find($adminId);
        $notes   = $admin ? $admin->notifications : collect();

        return view('admin.notifications', compact('notes'));
    }

    /**
     * Mark all unread as read.
     */
    public function markAllRead()
    {
        $adminId = session('hospital_user');
        $admin   = HospitalUser::find($adminId);

        if ($admin) {
            $admin->unreadNotifications->markAsRead();
        }

        return redirect()->route('admin.notifications');
    }
}
