<?php
include "connections.php";

if (isset($_POST['delete'])) {
    $booking_id = $_POST['booking_id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $booking_id);

    if ($stmt->execute()) {
        // Redirect to the bookings page after successful deletion
        header("Location: booking.php");
        exit();
    } else {
        // Handle error
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>
