<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\HospitalUser;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    /** List all patients **/
    public function managePatient()
    {
        $patients = HospitalUser::whereRaw('LOWER(role) = ?', ['patient'])
            ->orderBy('name','asc')
            ->get();

        return view('management.manage-patient', compact('patients'));
    }

    /** Show form to edit a patient’s assigned staff **/
    public function editPatient(int $patient)
    {
        $patient      = HospitalUser::findOrFail($patient);
        $doctors      = HospitalUser::where('role','doctor')->get();
        $radiologists = HospitalUser::where('role','radiologist')->get();
        $radiographers= HospitalUser::where('role','radiographer')->get();

        return view('management.edit-patient', compact(
            'patient','doctors','radiologists','radiographers'
        ));
    }

    /** Persist changes to that patient **/
    public function updatePatient(Request $r, int $patient)
    {
        $data = $r->validate([
            'assigned_doctor_id'      => 'nullable|exists:hospital_users,id',
            'assigned_radiologist_id' => 'nullable|exists:hospital_users,id',
            'assigned_radiographer_id'=> 'nullable|exists:hospital_users,id',
        ]);

        HospitalUser::findOrFail($patient)->update($data);

        return redirect()
            ->route('management.manage-patient')
            ->with('success','Patient assignments updated.');
    }

    /** List all staff users **/
    public function manageUser()
    {
        $users     = HospitalUser::orderBy('created_at','desc')->get();
        $hospitals = Hospital::orderBy('name')->get(['code','name']);

        return view('management.manage-user', compact('users','hospitals'));
    }

    /** Show form to edit which patients a staff user has **/
    public function editUserPatients(int $user)
    {
        $user     = HospitalUser::findOrFail($user);
        $patients = HospitalUser::where('role','patient')->get();

        return view('management.edit-user', compact('user','patients'));
    }

    /** Persist staff’s patient list **/
    public function updateUserPatients(Request $r, int $user)
    {
        $r->validate([
            'patients'   => 'nullable|array',
            'patients.*' => 'exists:hospital_users,id',
        ]);

        // clear old assignments
        HospitalUser::where('assigned_doctor_id', $user)
            ->update(['assigned_doctor_id'=>null]);

        // reassign selected
        if ($r->patients) {
            HospitalUser::whereIn('id', $r->patients)
                ->update(['assigned_doctor_id'=>$user]);
        }

        return redirect()
            ->route('management.manage-user')
            ->with('success','Staff’s patient list updated.');
    }
}
