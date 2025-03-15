<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;

class RadiographerPatientController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        // Retrieve patients with role 'patient', optionally filtering by name.
        $patients = HospitalUser::where('role', 'patient')
            ->when($query, function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->orderBy('name', 'asc')
            ->get();

        return view('radiographer.patient', compact('patients'));
    }
}
