<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sent_otp";

$connect = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $otp = $_POST['otp'];
    $subject = $_POST['subject'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    $sql = "INSERT INTO otp(name, email, phone, password, otp, status, otp_send_time, ip)
            VALUES ('$name', '$email', '$phone', '$password', '$otp', 'pending', NOW(), '$ip_address')";

    if ($connect->query($sql) === TRUE) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tishalni27@gmail.com';
            $mail->Password = 'ybja kqua dfrk nekj'; // Consider using env or config
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('tishalni27@gmail.com', 'Vector coding');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "Your OTP verification code is: " . $otp;

            $mail->send();

            echo "
                <script>
                    alert('Verification code has been sent to your email');
                    document.location.href='verify.php';
                </script>
            ";

        } catch (Exception $e) {
            echo "
                <script>
                    alert('Mailer Error: {$mail->ErrorInfo}');
                    document.location.href='index.php';
                </script>
            ";
        }

    } else {
        echo "
            <script>
                alert('Database Error: " . $connect->error . "');
                document.location.href='index.php';
            </script>
        ";
    }
}
?>
