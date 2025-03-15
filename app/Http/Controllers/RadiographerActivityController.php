<?php

namespace App\Http\Controllers;

use App\Models\HospitalUser;

class RadiographerActivityController extends Controller
{
    public function index()
    {
        // Retrieve all patients (with role 'patient')
        $patients = HospitalUser::where('role', 'patient')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('radiographer.dashboard', compact('patients'));
    }
}
