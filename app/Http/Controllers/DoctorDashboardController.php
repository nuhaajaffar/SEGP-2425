<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalUser;
use App\Models\DoctorReview;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        // For now, fetch all patients.
        // Later, you might filter by assigned doctor.
        $patients = HospitalUser::where('role', 'patient')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('doctor.dashboard', compact('patients'));
    }

    public function review($patientId)
    {
        $patient = HospitalUser::findOrFail($patientId);
        $reviews = DoctorReview::where('patient_id', $patientId)
                     ->with('doctor')
                     ->latest()
                     ->get();
    
        return view('doctor.review', compact('patient','reviews'));
    }

    public function uploadReportStore(Request $request, $patientId)
    {
        // Validate and process the file upload here
        // For example:
        $request->validate([
            'report' => 'required|mimes:pdf|max:2048',
        ]);
        
        // Retrieve the patient (assumed to be a HospitalUser with role 'patient')
        $patient = HospitalUser::where('role', 'patient')->findOrFail($patientId);
        
        // Process file upload (for example, store the file)
        $file = $request->file('report');
        $filename = $file->getClientOriginalName();
        $path = $file->storeAs('reports', $filename, 'public');
    
        // Update the patient or create a report record as needed
        // For example, if using a PatientReport model:
        // PatientReport::create([
        //     'hospital_user_id' => $patient->id,
        //     'report_path'      => $path,
        // ]);
    
        return redirect()->back()->with('success', 'Report uploaded successfully.');
    }
    public function storeReview(Request $request, $patientId)
    {
        $request->validate([
            'review' => 'required|string',
        ]);
    
        $doctorId = 1; // 👈 TEMP: manually assign a doctor ID until login works
    
        DoctorReview::create([
            'patient_id' => $patientId,
            'doctor_id'  => $doctorId,
            'review'     => $request->input('review'),
        ]);
    
        return redirect()->back()->with('success', 'Review submitted successfully.');
    }

    public function saveReview(Request $request, $patientId)
    {
        // Validate the review input
        $request->validate([
            'review' => 'required|string',
        ]);
    
    
        // Save the review
        DoctorReview::create([
            'patient_id' => $patientId,
            'doctor_id'  => $doctorId,
            'review'     => $request->input('review'),
        ]);
    
        // Redirect back to the patient's page with success message
        return back()->with('success', 'Review submitted successfully.');
    }
    public function supportForm()
    {
        // GET /management/support
        return view('doctor.support');
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

        return view('doctor.settings', compact('user'));
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
            ->route('doctor.settings')
            ->with('success','Profile updated successfully.');
    }

}
