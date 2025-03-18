<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;

class RadiographerActivityController extends Controller
{
    public function index()
    {
        // Only retrieve patients that have the current radiographer assigned
        $patients = HospitalUser::where('role', 'patient')
            ->where('assigned_radiographer_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('radiographer.dashboard', compact('patients'));
    }
}
