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

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Retrieve patients with role 'patient', optionally filtering by name.
        $patients = HospitalUser::where('role', 'patient')
            ->when($query, function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->orderBy('name', 'asc')
            ->get();

        return view('radiologist.patient', compact('patients'));
    }
    public function supportForm()
    {
        // GET /management/support
        return view('radiologist.support');
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
    public function editProfile()
    {
        $userId = session('hospital_user');
        $user   = HospitalUser::findOrFail($userId);

        return view('radiologist.settings', compact('user'));
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
            ->route('radiologist.settings')
            ->with('radiologist','Profile updated successfully.');
    }
    public function show($id)
    {
        // Retrieve the patient record (for patients with role 'patient')
        $patient = HospitalUser::where('role', 'patient')->findOrFail($id);
        return view('radiologist.history', compact('patient'));
    }
    
    public function notifications()
    {
        $user  = HospitalUser::findOrFail(session('hospital_user'));
        $notes = $user->notifications()->latest()->get();
    
        return view('radiologist.notifications', compact('notes'));
    }
}
