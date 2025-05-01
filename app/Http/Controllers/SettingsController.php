<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;
use PHPMailer\PHPMailer\PHPMailer;    // ← import PHPMailer
use PHPMailer\PHPMailer\Exception;     // ← import Exception
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function editProfile()
    {
        $userId = session('hospital_user');
        $user   = HospitalUser::findOrFail($userId);

        return view('sidebar.settings', compact('user'));
    }

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
            ->route('settings')
            ->with('success','Profile updated successfully.');
    }

    public function submitSupport(Request $request)
    {
        // 1) Validate
        $data = $request->validate([
            'subject'    => 'required|string|max:150',
            'message'    => 'required|string',
            'attachment' => 'nullable|file|max:2048',
        ]);

        // 2) Configure PHPMailer
        $mail = new PHPMailer(true);

        // Tell PHPMailer to use SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sophieaaurora@gmail.com';
        $mail->Password   = env('GMAIL_APP_PASSWORD');     // from .env
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // SSL on 465
        $mail->Port       = 465;

        // From / To
        $mail->setFrom('sophieaaurora@gmail.com', 'Pixelence Support');
        $mail->addAddress('sophieaaurora@gmail.com');     // send to yourself

        // Optional file attachment
        if ($file = $request->file('attachment')) {
            $mail->addAttachment(
                $file->getRealPath(),
                $file->getClientOriginalName()
            );
        }

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Support Ticket: ' . $data['subject'];
        $mail->Body    = nl2br(e($data['message']));

        // 3) Send
        $mail->send();

        // 4) Redirect back
        return back()->with('success', 'Your support ticket has been sent.');
    }
}
