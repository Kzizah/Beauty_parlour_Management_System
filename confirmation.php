<?php
session_start();
include 'connections.php';
include 'functions.php';
include 'header.php'; // Include the session management logic

// Use Composer's autoload
require 'vendor/autoload.php'; // Adjust the path according to your project structure

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Fetch user data
$user_data = check_login($conn);

// Check if success parameter is present
if (isset($_GET['success']) && $_GET['success'] == '1') {
    // Confirmation message
    $message = "Your booking has been successfully completed!";
    
    // Fetch the customer's email from the user data
    $customer_email = $user_data['email']; // Assuming 'email' is a field in the user data
    $user_name = $user_data['user_name']; // Assuming 'user_name' is a field in the user data
    
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true); 

    try {
        // Server settings
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'mailhog'; // Use mailhog for MailHog
        $mail->Port = 1025; // MailHog SMTP port
        $mail->SMTPAuth = false; // No authentication needed for MailHog

        // Recipients
        $mail->setFrom('HobbitsParlour@gmail.com', 'Your Booking Service'); // Set sender's email
        $mail->addAddress($customer_email, $user_name); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Booking Confirmation';
        $mail->Body    = '<h1>Booking Confirmation</h1><p>Your booking has been successfully completed!Click the link below to proceed with the payment.</p>';
        $mail->AltBody = 'Your booking has been successfully completed!Click the link below to proceed with the payment.'; // Plain text version

        $mail->send(); // Send the email
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // Redirect back to the booking page if accessed directly
    header("Location: booking.php");
    exit();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css">
    <style>
        /* Custom styles for Booking Confirmation Page */
        body {
            background-color: #f8f9fa; /* Light gray background */
        }

        h1 {
            color: #343a40; /* Dark gray text */
            margin-bottom: 20px;
        }

        .alert {
            font-size: 1.2rem; /* Increase font size for alert */
            padding: 20px; /* Add padding to alert */
            border-radius: 10px; /* Round corners of the alert */
        }

        .btn {
            width: 150px; /* Set a fixed width for buttons */
            margin: 10px; /* Add margin between buttons */
            transition: background-color 0.3s; /* Smooth transition for hover effect */
        }

        .btn-primary {
            background-color: white; /* Primary button color */
            border: none; /* Remove border */
        }

        .btn-primary:hover {
            background-color: red; /* Darker blue on hover */
        }

        .btn-secondary {
            background-color: white; /* Secondary button color */
            border: none; /* Remove border */
        }

        .btn-secondary:hover {
            background-color: red; /* Darker gray on hover */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Booking Confirmation</h1>
        <div class="alert alert-success text-center">
            <?php echo $message; ?>
        </div>
        <div class="text-center">
            <a href="index.php" class="btn btn-primary">Go to Home</a>
            <a href="booking.php" class="btn btn-secondary">Book Another Service</a>
        </div>
    </div>
</body>
</html>
