<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;

class ProfileController extends Controller
{
    public function show($id)
    {
        // Retrieve the user by id; in a production app, add error handling.
        $user = HospitalUser::findOrFail($id);
        return view('profile.show', compact('user'));
    }
}
