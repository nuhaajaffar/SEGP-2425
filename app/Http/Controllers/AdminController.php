<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;
use App\Models\Hospital;

class AdminController extends Controller
{
    
    /**
     * Show the hospital-admin dashboard.
     */
    public function dashboard()
    {
        $patients = HospitalUser::where('role', 'patient')
                      ->with('hospital')        // ← eager‐load here
                      ->orderBy('created_at','desc')
                      ->get();
    
        return view('admin.dashboard', compact('patients'));
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
    public function editPatient(HospitalUser $patient)
    {
        $hospitals = Hospital::orderBy('name')->get();

        return view('admin.edit-patient', compact('patient', 'hospitals'));
    }

    /**
     * Validate & persist the patient updates.
     */
    public function updatePatient(Request $request, HospitalUser $patient)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255|unique:hospital_users,email,' . $patient->id,
            'password'       => 'nullable|string|min:8|confirmed',
            'contact'        => 'required|string|max:20',
            'address'        => 'nullable|string|max:255',
            'hospital_code'  => 'nullable|string|max:50',
        ]);
    
        // If a new password was provided, hash it; otherwise leave as-is
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
    
        $patient->update($data);
    
        return redirect()
               ->route('admin.dashboard')
               ->with('success', 'Patient updated successfully.');
    }
    public function userLogs(Request $request)
    {
        $query = $request->input('query');
        $users = HospitalUser::when($query, function($q, $query) {
                       $q->where('name', 'like', "%{$query}%");
                   })
                   ->orderBy('name')
                   ->get();
    
        return view('admin.user-logs', compact('users'));
    }
}
