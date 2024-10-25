<?php
session_start();
include 'connections.php';
include 'functions.php';
include 'header.php'; // Include the session management logic

// Fetch user data
$user_data = check_login($conn);

// Check if form data is received
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the service ID and staff ID from the form submission
    $service_id = $_POST['service_id'];
    $staff_id = $_POST['staff_id'];

    // Fetch customer details from the session
    $user_name = isset($user_data['user_name']) ? $user_data['user_name'] : '';
    $customer_email = isset($user_data['email']) ? $user_data['email'] : '';

    // Check if required fields are empty
    if (empty($service_id) || empty($user_name) || empty($customer_email) || empty($staff_id)) {
        die("Required fields cannot be empty!");
    }

    // Check if the user has already booked this service
    $check_booking_sql = "SELECT * FROM bookings WHERE service_id = ? AND user_name = ?";
    $check_booking_stmt = $conn->prepare($check_booking_sql);
    $check_booking_stmt->bind_param("is", $service_id, $user_name);
    $check_booking_stmt->execute();
    $check_booking_result = $check_booking_stmt->get_result();

    if ($check_booking_result->num_rows > 0) {
        die("You have already booked this service.");
    }

    // Fetch the service details from the database (including available slots)
    $service_sql = "SELECT service_name, session_slots, booked_slots FROM services WHERE id = ?";
    $service_stmt = $conn->prepare($service_sql);
    $service_stmt->bind_param("i", $service_id);
    $service_stmt->execute();
    $service_result = $service_stmt->get_result();

    if ($service_result->num_rows === 0) {
        die("No service found with the provided ID.");
    }

    $service = $service_result->fetch_assoc();

    // Check if slots are available
    if ($service['booked_slots'] >= $service['session_slots']) {
        die("No available slots for this service.");
    }

    // Prepare the SQL statement for inserting the booking (without booking_time)
    $sql = "INSERT INTO bookings (service_id, user_name, customer_email, booking_date, service_name, staff_id) 
            VALUES (?, ?, ?, CURDATE(), ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssi", $service_id, $user_name, $customer_email, $service['service_name'], $staff_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Update the service's booked slots
        $update_slots_sql = "UPDATE services SET booked_slots = booked_slots + 1 WHERE id = ?";
        $update_stmt = $conn->prepare($update_slots_sql);
        $update_stmt->bind_param("i", $service_id);
        $update_stmt->execute();

        // Redirect to confirmation page
        header("Location: confirmation.php?success=1");
        exit();
    } else {
        die("Error processing booking: " . $stmt->error);
    }

    // Close the connections
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
