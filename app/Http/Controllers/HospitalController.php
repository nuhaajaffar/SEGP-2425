<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function manage()
    {
        // Your logic to display and manage hospital details
        return view('hospital.manage');
    }
}
