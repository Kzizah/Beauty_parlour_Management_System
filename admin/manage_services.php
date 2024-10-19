<?php
session_start();
include '../connections.php';

// Check if user is admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

// Fetch all services
$serviceQuery = mysqli_query($conn, "SELECT * FROM services");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Manage Services</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Service Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Duration</th>
            <th>Actions</th>
        </tr>
        <?php while ($service = mysqli_fetch_assoc($serviceQuery)): ?>
            <tr>
                <td><?= $service['id'] ?></td>
                <td><?= $service['service_name'] ?></td>
                <td><?= $service['description'] ?></td>
                <td><?= $service['price'] ?></td>
                <td><?= $service['duration'] ?> mins</td>
                <td>
                    <a href="edit_service.php?id=<?= $service['id'] ?>">Edit</a> |
                    <a href="delete_service.php?id=<?= $service['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="add_service.php">Add New Service</a>
</body>
</html>
