<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;

class UserLogController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $users = HospitalUser::when($query, function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%");
        })->orderBy('name', 'asc')->get();

        return view('user-logs', compact('users'));
    }

    public function show($id)
    {
        $user = HospitalUser::findOrFail($id);
        return view('user-profile', compact('user')); // Optional detailed view
    }
}
