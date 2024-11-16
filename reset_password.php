<?php
session_start(); // Start the session
include("connections.php"); // Include your database connection
// include 'header.php'; // Include the session management logic

function isValidPassword($password) {
    // Password must be at least 8 characters long, contain an uppercase letter, a lowercase letter, a digit, and a special character
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get the token from the URL
    $token = $_GET['token'];
    
    // Get the new password and confirmation from the form
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($new_password === $confirm_password) {
        // Validate password complexity
        if (!isValidPassword($new_password)) {
            $_SESSION['message'] = "Password must be at least 8 characters long, contain an uppercase letter, a lowercase letter, a digit, and a special character.";
            header("Location: reset_confirmation.php"); // Redirect to confirmation page
            exit();
        }

        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Find the email associated with the token and check if the token is still valid (not expired)
        $query = "SELECT email FROM password_resets WHERE token = '$token' AND expires_at > NOW() LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $email = $row['email'];

            // Update the user's password in the customer table
            $update_query = "UPDATE customer SET password = '$hashed_password' WHERE email = '$email'";
            mysqli_query($conn, $update_query);

            // Delete the token from the password_resets table
            $delete_query = "DELETE FROM password_resets WHERE token = '$token'";
            mysqli_query($conn, $delete_query);

            // Set success message
            $_SESSION['message'] = "Your password has been successfully updated!";
            header("Location: reset_confirmation.php"); // Redirect to confirmation page
            exit();
        } else {
            // Set error message
            $_SESSION['message'] = "Invalid or expired token!";
            header("Location: reset_confirmation.php"); // Redirect to confirmation page
            exit();
        }
    } else {
        // Set error message
        $_SESSION['message'] = "Passwords do not match!";
        header("Location: reset_confirmation.php"); // Redirect to confirmation page
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        .form-control {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Reset Password</h2>
        <form method="post">
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="show_password">
                <label class="form-check-label" for="show_password">Show Password</label>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>

    <script>
        // Show/Hide password functionality
        document.getElementById('show_password').addEventListener('click', function () {
            var newPasswordInput = document.getElementById('new_password');
            var confirmPasswordInput = document.getElementById('confirm_password');
            if (this.checked) {
                newPasswordInput.type = 'text';
                confirmPasswordInput.type = 'text';
            } else {
                newPasswordInput.type = 'password';
                confirmPasswordInput.type = 'password';
            }
        });
    </script>
</body>
</html>
