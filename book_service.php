<?php
session_start();
include 'connections.php';
include 'functions.php';

// Fetch user data
$user_data = check_login($conn);

// Check if the service ID is provided
if (!isset($_GET['service_id'])) {
    echo "Service ID is required.";
    exit();
}

$service_id = $_GET['service_id'];
$customer_name = $user_data['user_name'];
$customer_email = $user_data['email'];
$booking_date = date('Y-m-d'); // Current date

// Fetch the service details from the database
$service_query = "SELECT service_name, session_slots, booked_slots FROM services WHERE id = ?";
$stmt = $conn->prepare($service_query);
$stmt->bind_param('i', $service_id);
$stmt->execute();
$service_result = $stmt->get_result();

if ($service_result->num_rows > 0) {
    $service = $service_result->fetch_assoc();
    $service_name = $service['service_name'];
    $available_slots = $service['session_slots'] - $service['booked_slots'];
} else {
    echo "Service not found.";
    exit();
}

// Check if there are available slots
if ($available_slots <= 0) {
    echo "No available slots for this service.";
    exit();
}

// Check if the booking already exists
$check_query = "SELECT * FROM bookings WHERE service_id = ? AND customer_email = ? AND booking_date = ?";
$stmt = $conn->prepare($check_query);
$stmt->bind_param('sss', $service_id, $customer_email, $booking_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "You have already booked this service today.";
} else {
    // Prepare and execute the SQL statement for booking
    $sql = "INSERT INTO bookings (service_id, customer_name, customer_email, booking_date, service_name) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $service_id, $customer_name, $customer_email, $booking_date, $service_name);

    if ($stmt->execute()) {
        // Update the available slots
        $update_slots = "UPDATE services SET booked_slots = booked_slots + 1 WHERE id = ?";
        $stmt = $conn->prepare($update_slots);
        $stmt->bind_param('i', $service_id);
        if ($stmt->execute()) {
            echo "Booking successful!";
        } else {
            echo "Error updating slots: " . $stmt->error;
        }
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Close the connection
$stmt->close();
$conn->close();
?>
