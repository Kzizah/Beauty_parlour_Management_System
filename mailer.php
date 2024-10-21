<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure you have Composer autoload

function sendPasswordResetEmail($email, $token) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mailhog';                            // Set the MailHog server
        $mail->SMTPAuth = false;                              // No SMTP authentication for MailHog
        $mail->Port = 1025;                                   // TCP port to connect to MailHog
        
        // Recipients
        $mail->setFrom('no-reply@yourwebsite.com', 'Password Reset'); // Sender's email
        $mail->addAddress($email);                            // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Reset your password';
        $mail->Body    = "Click here to reset your password: <a href='http://localhost:8001/reset_password.php?token=$token'>Reset Password</a>";
        $mail->AltBody = "Click here to reset your password: http://localhost:8001/reset_password.php?token=$token"; // Plain text alternative

        $mail->send();
        
        // Start session to store the message
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['message'] = 'A password reset link has been sent to your email.';
        
        // Redirect to the message page
        header("Location: message.php");
        exit();
        
    } catch (Exception $e) {
        // Check if session is not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $_SESSION['message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
        // Redirect to the message page
        header("Location: message.php");
        exit();
    }
}
