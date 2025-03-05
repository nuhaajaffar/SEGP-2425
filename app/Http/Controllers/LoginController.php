<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('login'); // assuming your login view is at resources/views/login.blade.php
    }

    // Process login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Retrieve the user by the username (email)
        $user = HospitalUser::where('username', $request->input('email'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Save user id in session
            $request->session()->put('hospital_user', $user->id);
            
            // Normalize role text for redirection
            $role = strtolower($user->role);
            switch ($role) {
                case 'hospital management':
                    return redirect()->route('management.dashboard');
                case 'hospital admin':
                    return redirect()->route('admin.dashboard');
                case 'radiographer':
                    return redirect()->route('radiographer.dashboard');
                case 'radiologist':
                    return redirect()->route('radiologist.dashboard');
                case 'doctor':
                    return redirect()->route('doctor.dashboard');
                case 'patient':
                    return redirect()->route('patient.dashboard');
                default:
                    return redirect()->route('home');
            }
        }

        return back()->with('error', 'Invalid email or password.');
    }
}
