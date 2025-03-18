<?php

namespace App\Http\Controllers;

use App\Models\HospitalUser;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    /**
     * Display the Manage Patient list.
     */
    public function managePatient()
    {
        // Retrieve all patients with role 'patient' (case-insensitive)
        $patients = HospitalUser::whereRaw('LOWER(role) = ?', ['patient'])
            ->orderBy('name', 'asc')
            ->get();

        return view('management.manage-patient', compact('patients'));
    }
}
