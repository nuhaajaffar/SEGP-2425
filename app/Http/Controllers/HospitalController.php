<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display the list of hospitals.
     */
    public function manage()
    {
        $hospitals = Hospital::with(['users', 'patients'])->get();
        return view('admin.manage-hospital', compact('hospitals'));
    }

    /**
     * Show the form for creating a new hospital.
     */
    public function create()
    {
        return view('hospital-registration');
    }

    /**
     * Store a newly created hospital.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:hospitals,code|max:10',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'pic_name' => 'required|string',
            'pic_contact' => 'required|string',
            'secondary_contact' => 'nullable|string',
            'pic_username' => 'required|email',
            'pic_password' => 'required|string|min:6',
            'license' => 'required|string',
        ]);

        Hospital::create([
            'code' => $request->code,
            'name' => $request->name,
            'address' => $request->address,
            'pic_name' => $request->pic_name,
            'pic_contact' => $request->pic_contact,
            'secondary_contact' => $request->secondary_contact,
            'pic_username' => $request->pic_username,
            'pic_password' => bcrypt($request->pic_password),
            'license' => $request->license,
        ]);

        return redirect()->route('admin.hospital.index')->with('success', 'Hospital created successfully.');
    }

    /**
     * Show the form to edit a hospital.
     */
    public function edit($id)
    {
        $hospital = Hospital::findOrFail($id);
        return view('admin.edit-hospital', compact('hospital'));
    }

    /**
     * Update an existing hospital.
     */
    public function update(Request $request, $id)
    {
        $hospital = Hospital::findOrFail($id);

        $request->validate([
            'code' => 'required|max:10|unique:hospitals,code,' . $hospital->id,
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'pic_name' => 'required|string',
            'pic_contact' => 'required|string',
            'secondary_contact' => 'nullable|string',
            'pic_username' => 'required|email',
            'pic_password' => 'nullable|string|min:6',
            'license' => 'required|string',
        ]);

        $hospital->code = $request->code;
        $hospital->name = $request->name;
        $hospital->address = $request->address;
        $hospital->pic_name = $request->pic_name;
        $hospital->pic_contact = $request->pic_contact;
        $hospital->secondary_contact = $request->secondary_contact;
        $hospital->pic_username = $request->pic_username;
        $hospital->license = $request->license;

        if (!empty($request->pic_password)) {
            $hospital->pic_password = bcrypt($request->pic_password);
        }

        $hospital->save();

        return redirect()->route('admin.hospital.index')->with('success', 'Hospital updated successfully.');
    }

    /**
     * Delete a hospital.
     */
    public function destroy($id)
    {
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();

        return redirect()->route('admin.hospital.index')->with('success', 'Hospital deleted successfully.');
    }
}
