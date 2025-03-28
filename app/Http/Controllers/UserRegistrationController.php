<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;
use Illuminate\Support\Facades\Hash;

class UserRegistrationController extends Controller
{
    // Display the registration form
    public function create()
    {
        // Now using the view 'admin.user' for registration
        return view('admin.user');
    }

    // Process the registration data
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'name'     => 'required|string|max:255',
            'ic'       => 'required|string|max:50',
            'address'  => 'required|string|max:255',
            'role'     => 'required|string|max:100',
            'contact'  => 'required|string|max:50',
            'username' => 'required|string|max:100|unique:hospital_users,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Auto-generate a unique hospital ID (at least 4 digits)
        $randomNumber = rand(1, 9999);
        $hospitalId = str_pad($randomNumber, 4, '0', STR_PAD_LEFT);

        HospitalUser::create([
            'name'        => $request->name,
            'ic'          => $request->ic,
            'address'     => $request->address,
            'hospital_id' => $hospitalId,
            'role'        => $request->role,
            'contact'     => $request->contact,
            'username'    => $request->username,
            'password'    => Hash::make($request->password),
            'dob'         => $request->dob,  
            'sex'         => $request->sex,  
        ]);

        return redirect()->back()->with('success', 'User registration successful.');
    }
}
