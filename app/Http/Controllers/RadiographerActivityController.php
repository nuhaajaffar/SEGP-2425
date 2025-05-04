<?php

namespace App\Http\Controllers;

use App\Models\HospitalUser;

class RadiographerActivityController extends Controller
{
    public function index()
    {
        // Retrieve all patients (with role 'patient')
        $patients = HospitalUser::where('role', 'patient')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('radiographer.dashboard', compact('patients'));
    }
    public function supportForm()
    {
        // GET /management/support
        return view('radiographer.support');
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

        return view('radiographer.settings', compact('user'));
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
            ->route('radiographer.settings')
            ->with('success','Profile updated successfully.');
    }
    public function show($id)
    {
        // Retrieve the patient record (for patients with role 'patient')
        $patient = HospitalUser::where('role', 'patient')->findOrFail($id);
        return view('radiographer.history', compact('patient'));
    }
}
