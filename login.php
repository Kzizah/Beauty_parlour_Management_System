<?php
session_start();

include("connections.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        $query = "SELECT * FROM customer WHERE user_name = '$user_name' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            // Verify the hashed password
            if (password_verify($password, $user_data['password'])) {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: index.php");
                die;
            }
        }
        echo "Wrong username or password!";
    } else {
        echo "Wrong username or password!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div id="box">
        <form method="post">
            <div class="form-heading">Login</div>

            <label for="user_name">Username</label>
            <input id="text" type="text" name="user_name" required><br><br>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required><br><br>

            <!-- Show Password Checkbox -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">
                <label class="form-check-label" for="showPassword">
                    Show Password
                </label>
            </div><br>

            <input id="button" type="submit" value="Login"><br><br>

            <a href="signup.php">Click to Signup</a><br><br>

            <a href="forgot_password.php">Forgot Password</a><br><br>
        </form>
        <button onclick="document.location='index.php'">Back</button>
    </div>

    <script src="index.js"></script>

    <!-- JavaScript to Toggle Password Visibility -->
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>
</html>
