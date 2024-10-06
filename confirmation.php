<?php
session_start();
include 'connections.php';
include 'functions.php';

// Fetch user data
$user_data = check_login($conn);

// Check if success parameter is present
if (isset($_GET['success']) && $_GET['success'] == '1') {
    // Confirmation message
    $message = "Your booking has been successfully completed!";
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
