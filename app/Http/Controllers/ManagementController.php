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
    public function editPatient(HospitalUser $patient)
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
    public function updatePatient(Request $request, HospitalUser $patient)
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

    public function editProfile()
    {
        $userId = session('hospital_user');
        $user   = HospitalUser::findOrFail($userId);

        return view('management.settings', compact('user'));
    }

    /**
     * Handle the settings form submission.
     */
    public function updateProfile(Request $request)
    {
        $userId = session('hospital_user');
        $user   = HospitalUser::findOrFail($userId);

        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:100|unique:hospital_users,username,'.$user->id,
            'email'         => 'required|email|unique:hospital_users,email,'.$user->id,
            'password'      => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        if ($file = $request->file('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $data['profile_photo'] = $file->store('profile_photos','public');
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('management.settings')
            ->with('success','Profile updated successfully.');
    }

    public function manageHospital()
    {
        // load all hospitals (adjust query as needed)
        $hospitals = Hospital::orderBy('created_at', 'desc')->get();

        // return the management.manage-hospital view
        return view('management.manage-hospital', compact('hospitals'));
    }
    public function userLogs(Request $request)
    {
        // Grab optional search term
        $search = $request->input('query');

        $users = HospitalUser::when($search, function($q, $search) {
                        return $q->where('name', 'like', "%{$search}%");
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();

        // assumes you have a Blade at resources/views/management/user-logs.blade.php
        return view('management.user-logs', compact('users', 'search'));
    }
    public function supportForm()
    {
        // GET /management/support
        return view('management.support');
    }

    /**
     * Handle support form submission.
     */
    public function submitSupport(Request $request)
    {
        // POST /management/support
        $data = $request->validate([
            'subject'    => 'required|string|max:150',
            'message'    => 'required|string',
            'attachment' => 'nullable|file|max:2048',
        ]);

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sophieaaurora@gmail.com';
        $mail->Password   = env('GMAIL_APP_PASSWORD');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('sophieaaurora@gmail.com','Pixelence Support');
        $mail->addAddress('sophieaaurora@gmail.com');

        if ($file = $request->file('attachment')) {
            $mail->addAttachment(
                $file->getRealPath(),
                $file->getClientOriginalName()
            );
        }

        $mail->isHTML(true);
        $mail->Subject = 'Support Ticket: ' . $data['subject'];
        $mail->Body    = nl2br(e($data['message']));
        $mail->send();

        return back()->with('success','Your support ticket has been sent.');
    }
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

        return view('management.patient', compact('patients'));
    }

    /**
     * Optionally, implement a separate search method if needed.
     */
    public function search(Request $request)
    {
        // You can have similar logic as index
        return $this->index($request);
    }
    public function show($id)
    {
        // Retrieve the patient record (for patients with role 'patient')
        $patient = HospitalUser::where('role', 'patient')->findOrFail($id);
        return view('management.history', compact('patient'));
    }
}
