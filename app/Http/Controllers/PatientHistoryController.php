<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;

class PatientHistoryController extends Controller
{
    public function show($id)
    {
        // Retrieve the patient record (for patients with role 'patient')
        $patient = HospitalUser::where('role', 'patient')->findOrFail($id);
        return view('patient.history', compact('patient'));
    }
}
