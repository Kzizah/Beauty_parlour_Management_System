<?php
session_start();
include("connections.php");
include("mailer.php");
// include 'header.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];

    // Check if the email exists using a prepared statement
    $query = "SELECT * FROM customer WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // Generate a unique token for password reset
        $token = bin2hex(random_bytes(50));

        // Store the token and expiration time using a prepared statement
        $query = "INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $email, $token);

        if ($stmt->execute()) {
            // Send password reset email using PHPMailer
            if (sendPasswordResetEmail($email, $token)) {
                echo "Password reset email has been sent.";
            } else {
                echo "Failed to send the email.";
            }
        } else {
            echo "Failed to insert the reset token.";
        }
    } else {
        echo "No account found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Forgot Password</h2>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Enter your email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>
</body>
</html>
