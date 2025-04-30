<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Show the read-only profile
    public function show(int $id)
    {
        $user = HospitalUser::findOrFail($id);
        return view('profile', compact('user'));
    }
    
    public function edit(int $id)
    {
        $user = HospitalUser::findOrFail($id);
        return view('settings', compact('user'));
    }

    // Process the submitted edits
    public function update(Request $request, int $id)
    {
        $patient = HospitalUser::findOrFail($id);

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:hospital_users,username,'.$patient->id,
            'email'    => 'required|email|unique:hospital_users,email,'.$patient->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        // Handle photo
        if ($file = $request->file('profile_photo')) {
            if ($patient->profile_photo) {
                Storage::disk('public')->delete($patient->profile_photo);
            }
            $data['profile_photo'] = $file->store('profile_photos', 'public');
        }

        // Hash password if given
        if ($data['password'] ?? false) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $patient->update($data);

        return redirect()
            ->route('profile.show', $patient->id)
            ->with('success','Profile updated.');
    }
}
