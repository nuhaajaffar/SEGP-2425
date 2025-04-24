<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class OtpController extends Controller
{
    // 1. Show the signup form (loads resources/views/admin/signup.blade.php)
    public function showSignupForm()
    {
        return view('index');
    }

    // 2. Handle the POST from signup, insert & email the OTP
    public function send(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email',
            'phone'    => 'required|string',
            'password' => 'required|string|min:6',
            'otp'      => 'required|digits:6',
        ]);

        // save
        DB::table('otp')->insert([
            'name'           => $data['name'],
            'email'          => $data['email'],
            'phone'          => $data['phone'],
            'password'       => Hash::make($data['password']),
            'otp'            => $data['otp'],
            'status'         => 'pending',
            'otp_send_time'  => now(),
            'ip'             => $request->ip(),
        ]);

        // send mail
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'tishalni27@gmail.com';
            $mail->Password   = 'ybja kqua dfrk nekj';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom('tishalni27@gmail.com', 'Vector Coding');
            $mail->addAddress($data['email']);
            $mail->isHTML(true);
            $mail->Subject = 'Received OTP';
            $mail->Body    = "Your OTP verification code is: <b>{$data['otp']}</b>";

            $mail->send();
        } catch (Exception $e) {
            return back()
                ->withErrors(['mail' => "Mailer Error: {$mail->ErrorInfo}"])
                ->withInput();
        }

        // store email so the verify page can display it
        session(['email_for_otp' => $data['email']]);

        return redirect()->route('otp.verify.form');
    }

    // 3. Show the verify form (loads resources/views/admin/verify.blade.php)
    public function showVerifyForm(Request $request)
    {
        $record = \DB::table('otp')
        ->where('ip', $request->ip())
        ->where('status', 'pending')
        ->orderByDesc('otp_send_time')
        ->first();

        // Pass both email and stored OTP to the view
        return view('verify', [
            'email'      => $record->email ?? null,
        ]);
    }

    // 4. Handle the POST from verify, check & update status
    public function verify(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $record = DB::table('otp')
            ->where('ip', $request->ip())
            ->where('status', 'pending')
            ->orderByDesc('otp_send_time')
            ->first();

        if (! $record) {
            return back()->withErrors(['otp' => 'No pending OTP found.']);
        }

        if (trim($request->otp) !== trim($record->otp)) {
            return back()->withErrors(['otp' => 'INVALID OTP. Please try again.']);
        }

        DB::table('otp')->where('id', $record->id)->update(['status' => 'verified']);

        return redirect()->route('login')
        ->with('success', 'OTP verified! You may now log in.');
    }

}
