<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;

class RadiologistDashboardController extends Controller
{
    public function index()
    {
        // Only retrieve patients that have the current radiologist assigned
        $patients = HospitalUser::where('role', 'patient')
            ->where('assigned_radiologist_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('radiologist.dashboard', compact('patients'));
    }
}
