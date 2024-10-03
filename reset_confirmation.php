<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Confirmation</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Password Reset Status</h2>
        <div class="alert alert-info" role="alert">
            <?php
            // Display the message from the session
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']); // Clear the message after displaying it
            } else {
                echo "No message available.";
            }
            ?>
        </div>
        <a href="login.php" class="btn btn-primary">Go to Login</a>
    </div>
</body>
</html>
