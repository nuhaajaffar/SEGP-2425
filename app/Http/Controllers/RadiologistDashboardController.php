<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;

class RadiologistDashboardController extends Controller
{
    public function index()
    {
        $patients = HospitalUser::where('role','patient')
            ->with(['images','reports'])
            ->orderBy('created_at','desc')
            ->get();
    
        return view('radiologist.dashboard', compact('patients'));
    }
    
}
