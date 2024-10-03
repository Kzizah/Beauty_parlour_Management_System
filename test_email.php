<?php
$to = 'silateizizah@gmail.com'; // Replace with your email address
$subject = 'Test Email from PHP';
$message = 'This is a test email sent using MailHog!';
$headers = 'From: no-reply@yourdomain.com' . "\r\n" .
           'Reply-To: no-reply@yourdomain.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully!';
} else {
    echo 'Email sending failed.';
}
?>
