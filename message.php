<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Notification</h2>
        <div class="alert alert-info">
            <?php
            // Display the message from the session
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                // Clear the message after displaying it
                unset($_SESSION['message']);
            } else {
                echo "No message available.";
            }
            ?>
        </div>
        <a href="index.php" class="btn btn-primary">Back to Home</a>
    </div>
</body>
</html>
