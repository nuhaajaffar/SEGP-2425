<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;

class ProfileController extends Controller
{
    /**
     * Display the profile page for the given user.
     */
    public function show($id)
    {
        $patient = HospitalUser::findOrFail($id);
        return view('profile', compact('patient'));
    }
    
    /**
     * Show the form for editing the user profile.
     */
    public function edit($id)
    {
        $patient = HospitalUser::findOrFail($id);
        return view('profile', compact('patient'));
        // Alternatively, if you want a separate edit form, you can create a separate view.
    }
    
    /**
     * Update the user profile.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:100|unique:hospital_users,username,' . $id,
            'name'     => 'required|string|max:255',
            'ic'       => 'required|string|max:50',
            'address'  => 'required|string|max:255',
            'contact'  => 'required|string|max:50',
            'dob'      => 'required|date',
            'sex'      => 'required|in:male,female',
        ]);
        
        $patient = HospitalUser::findOrFail($id);
        $patient->update([
            'username' => $request->username,
            'name'     => $request->name,
            'ic'       => $request->ic,
            'address'  => $request->address,
            'contact'  => $request->contact,
            'dob'      => $request->dob,
            'sex'      => $request->sex,
        ]);
        
        return redirect()->route('profile.show', $patient->id)
                         ->with('success', 'Profile updated successfully.');
    }
}
