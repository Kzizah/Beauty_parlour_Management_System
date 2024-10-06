<?php
session_start();
include 'connections.php';
include 'functions.php';

// Fetch user data
$user_data = check_login($conn);

// Fetch service details
$service_id = $_GET['service_id'];
$sql = "SELECT * FROM services WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $service_id);
$stmt->execute();
$service_result = $stmt->get_result();

if ($service_result->num_rows === 0) {
    echo "Service not found.";
    exit; // Stop further processing if the service is not found
}

$service = $service_result->fetch_assoc();

// Fetch staff for the selected service
$staff_sql = "SELECT * FROM staff WHERE service_id = ?";
$staff_stmt = $conn->prepare($staff_sql);
$staff_stmt->bind_param("i", $service_id);
$staff_stmt->execute();
$staff_result = $staff_stmt->get_result();

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Service</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <style>
        /* Your existing styles here */
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Book Service: <?php echo htmlspecialchars($service['service_name']); ?></h1>

        <form action="process_booking.php" method="POST">
            <input type="hidden" name="service_id" value="<?php echo htmlspecialchars($service['id']); ?>">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_data['user_id']); ?>">

            <div class="mb-3">
                <label for="booking_time" class="form-label">Choose a Time Slot:</label>
                <input type="datetime-local" name="booking_time" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="staff_id" class="form-label">Choose Staff:</label>
                <select name="staff_id" class="form-select" required>
                    <option value="">Select Staff</option>
                    <?php while($staff = $staff_result->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($staff['id']); ?>"><?php echo htmlspecialchars($staff['name']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="payment" class="form-label">Payment Amount:</label>
                <p>$<?php echo number_format($service['price'], 2); ?></p>
            </div>

            <button type="submit" class="btn btn-custom">Confirm Booking</button>
        </form>
    </div>
</body>
</html>
