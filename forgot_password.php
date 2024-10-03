<?php
session_start();
include("connections.php");
include("mailer.php");  // Include mailer.php for sending the email

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];

    // Check if the email exists
    $query = "SELECT * FROM customer WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Generate a unique token for password reset
        $token = bin2hex(random_bytes(50));

        // Store the token and expiration time in the password_resets table
        $query = "INSERT INTO password_resets (email, token, expires_at) VALUES ('$email', '$token', DATE_ADD(NOW(), INTERVAL 1 HOUR))";
        mysqli_query($conn, $query);

        // Send password reset email using PHPMailer
        sendPasswordResetEmail($email, $token);
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
