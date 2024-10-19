<?php
session_start();
include '../connections.php';
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}
$bookingQuery = mysqli_query($conn, "SELECT * FROM bookings");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Bookings</title>
</head>
<body>
    <h1>Manage Bookings</h1>
    <table>
        <tr><th>ID</th><th>Customer</th><th>Service</th><th>Status</th><th>Actions</th></tr>
        <?php while ($booking = mysqli_fetch_assoc($bookingQuery)): ?>
        <tr>
            <td><?= $booking['id'] ?></td>
            <td><?= $booking['customer_email'] ?></td>
            <td><?= $booking['service_name'] ?></td>
            <td><?= $booking['status'] ?></td>
            <td><a href="edit_booking.php?id=<?= $booking['id'] ?>">Edit</a> | 
                <a href="delete_booking.php?id=<?= $booking['id'] ?>">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="add_booking.php">Add Booking</a>
</body>
</html>
