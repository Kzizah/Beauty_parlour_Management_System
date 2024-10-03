<?php
session_start();

include("connections.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve posted data
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];

    // Check if passwords match
    if ($password != $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } elseif (!empty($user_name) && !empty($password) && !is_numeric($user_name) && !empty($email)) {
        // Hash password using password_hash() and save to the database
        $password_hash = password_hash($password, PASSWORD_DEFAULT); // Secure password hashing
        $user_id = random_num(20);
        $query = "INSERT INTO customer (user_id, user_name, password, email) VALUES ('$user_id', '$user_name', '$password_hash', '$email')";
        mysqli_query($conn, $query);

        echo "<script>alert('Registration successful');</script>";
        header("Location: login.php");
        die;
    } else {
        echo "<script>alert('Please fill in all fields correctly');</script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup | The Hobbits Parlour</title>
    
    <!-- Bootstrap CSS -->
    <link href="bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="index.css" rel="stylesheet">
</head>
<body>

<div class="logo">The Hobbits Parlour</div>

<div class="container">
    <div class="card p-4">
        <h2 class="text-center text-muted">Signup</h2>
        <form method="POST" id="signupForm" onsubmit="return validatePassword()">
            <div class="mb-3">
                <label for="user_name" class="form-label">Username</label>
                <input type="text" class="form-control" id="user_name" name="user_name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="someone@email.com" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <small id="passwordHelp" class="form-text text-muted">
                    Password must be at least 8 characters long, contain an uppercase letter, a lowercase letter, a digit, and a special character.
                </small>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <!-- Show Password Checkbox -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
                <label class="form-check-label" for="showPassword">
                    Show Password
                </label>
            </div><br>

            <button type="submit" class="btn btn-custom w-100">Signup</button>
            <div class="text-center mt-3">
                <a href="login.php">Already have an account? Login here</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="index.js"></script>

<!-- JavaScript to Toggle Password Visibility -->
<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var confirmPasswordField = document.getElementById("confirm_password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            confirmPasswordField.type = "text";
        } else {
            passwordField.type = "password";
            confirmPasswordField.type = "password";
        }
    }

    // JavaScript for password validation
    function validatePassword() {
        var password = document.getElementById("password").value;
        var passwordHelp = document.getElementById("passwordHelp");
        
        // Regex for password validation
        var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/;

        if (!passwordRegex.test(password)) {
            passwordHelp.style.color = "red";
            passwordHelp.textContent = "Password must meet the required criteria!Password must be at least 8 characters long, contain an uppercase letter, a lowercase letter, a digit, and a special character.";
            return false;
        } else {
            passwordHelp.style.color = "green";
            passwordHelp.textContent = "Password meets the criteria!Password must be at least 8 characters long, contain an uppercase letter, a lowercase letter, a digit, and a special character.";
            return true;
        }
    }
</script>
</body>
</html>
