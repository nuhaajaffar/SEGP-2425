<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;
use App\Models\Hospital;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AdminController extends Controller
{
    
    /**
     * Show the hospital-admin dashboard.
     */
    public function dashboard()
    {
        $patients = HospitalUser::where('role', 'patient')
                      ->with('hospital')        // ← eager‐load here
                      ->orderBy('created_at','desc')
                      ->get();
    
        return view('admin.dashboard', compact('patients'));
    }

    /**
     * Show all notifications for the logged-in admin.
     */
    public function notifications()
    {
        $adminId = session('hospital_user');
        $admin   = HospitalUser::find($adminId);
        $notes   = $admin ? $admin->notifications : collect();

        return view('admin.notifications', compact('notes'));
    }

    /**
     * Mark all unread as read.
     */
    public function markAllRead()
    {
        $adminId = session('hospital_user');
        $admin   = HospitalUser::find($adminId);

        if ($admin) {
            $admin->unreadNotifications->markAsRead();
        }

        return redirect()->route('admin.notifications');
    }
    public function editPatient(HospitalUser $patient)
    {
        $hospitals = Hospital::orderBy('name')->get();

        return view('admin.edit-patient', compact('patient', 'hospitals'));
    }

    /**
     * Validate & persist the patient updates.
     */
    public function updatePatient(Request $request, HospitalUser $patient)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255|unique:hospital_users,email,' . $patient->id,
            'password'       => 'nullable|string|min:8|confirmed',
            'contact'        => 'required|string|max:20',
            'address'        => 'nullable|string|max:255',
            'hospital_code'  => 'nullable|string|max:50',
        ]);
    
        // If a new password was provided, hash it; otherwise leave as-is
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
    
        $patient->update($data);
    
        return redirect()
               ->route('admin.dashboard')
               ->with('success', 'Patient updated successfully.');
    }
    public function userLogs(Request $request)
    {
        $query = $request->input('query');
        $users = HospitalUser::when($query, function($q, $query) {
                       $q->where('name', 'like', "%{$query}%");
                   })
                   ->orderBy('name')
                   ->get();
    
        return view('admin.user-logs', compact('users'));
    }

    public function editProfile()
    {
        $userId = session('hospital_user');
        $user   = HospitalUser::findOrFail($userId);

        return view('admin.settings', compact('user'));
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
            ->route('admin.settings')
            ->with('success','Profile updated successfully.');
    }

    /**
     * Show the support form or handle its submission.
     */
    public function supportForm()
    {
        // GET /admin/support
        return view('admin.support');
    }

    public function submitSupport(Request $request)
    {
        // POST /admin/support
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

        $mail->setFrom('sophieaaurora@gmail.com', 'Pixelence Support');
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

        return back()->with('success', 'Your support ticket has been sent.');
    }
}
