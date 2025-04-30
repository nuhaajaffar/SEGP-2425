<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\HospitalUser;
use Illuminate\Http\Request;

class UserRegistrationController extends Controller
{
    /**
     * Show the “Add User” form with a hospital dropdown.
     */
    public function create()
    {
        // Load all hospitals (code + name) for the <select>
        $hospitals = Hospital::orderBy('name')
                             ->get(['code','name']);

        // Render the blade that lives at resources/views/admin/user.blade.php
        return view('admin.user', compact('hospitals'));
    }

    /**
     * Handle the form POST and create a new HospitalUser.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'ic'             => 'required|string|max:20',
            'address'        => 'required|string',
            'dob'            => 'required|date',
            'sex'            => 'required|in:male,female',
            'role'           => 'required|in:patient,doctor,radiologist,radiographer,hospital management,hospital admin',
            'contact'        => 'required|string',
            'username'       => 'required|email|unique:hospital_users,username',
            'password'       => 'required|string|confirmed|min:6',
            'hospital_code'  => 'required|exists:hospitals,code',
        ]);

        $hospital = Hospital::where('code', $data['hospital_code'])->firstOrFail();

        // Create the user record
        HospitalUser::create([
            'name'           => $data['name'],
            'ic'             => $data['ic'],
            'address'        => $data['address'],
            'dob'            => $data['dob'],
            'sex'            => $data['sex'],
            'role'           => $data['role'],
            'contact'        => $data['contact'],
            'username'       => $data['username'],
            'password'       => bcrypt($data['password']),
            'hospital_code'  => $data['hospital_code'],
            'hospital_id'    => $hospital->id,
        ]);

        return redirect()->route('management.manage-patient')
                         ->with('success','User added successfully—please log in.');
    }
}
