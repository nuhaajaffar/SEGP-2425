<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Hospital;

class HospitalRegistrationController extends Controller
{
    // Show the registration form
    public function create()
    {
        // Updated to look for the view in resources/views/admin/register.blade.php
        return view('admin.register');
    }

    // Store the registration data
    public function store(Request $request)
    {
        // Validate form input
        $request->validate([
            'name'              => 'required|string|max:255',
            'address'           => 'required|string|max:255',
            'pic_name'          => 'required|string|max:255',
            'pic_contact'       => 'required|string|max:255',
            'secondary_contact' => 'nullable|string|max:255',
            'pic_username'      => 'required|string|max:255|unique:hospitals,pic_username',
            'pic_password'      => 'required|string|min:6',
            'license'           => 'required|in:free,monthly,yearly,business',
        ]);

        // Auto-generate a hospital ID
        $generatedHospitalId = 'HSP-' . Str::upper(Str::random(6));

        Hospital::create([
            'name'              => $request->input('name'),
            'address'           => $request->input('address'),
            'hospital_id'       => $generatedHospitalId,
            'pic_name'          => $request->input('pic_name'),
            'pic_contact'       => $request->input('pic_contact'),
            'secondary_contact' => $request->input('secondary_contact'),
            'pic_username'      => $request->input('pic_username'),
            // Consider hashing the password for security:
            // 'pic_password' => Hash::make($request->input('pic_password')),
            'pic_password'      => $request->input('pic_password'),
            'license'           => $request->input('license'),
        ]);

        return redirect()->route('hospital.create')->with('success', 'Hospital registration successful!');
    }
}
