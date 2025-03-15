<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;

class RadiologistDashboardController extends Controller
{
    public function index()
    {
        // Fetch all users with role "patient" where patient_image is null.
        $patients = HospitalUser::where('role', 'patient')
            ->whereNull('patient_image')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('radiologist.dashboard', compact('patients'));
    }
}
