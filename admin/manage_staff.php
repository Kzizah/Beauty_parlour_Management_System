<?php
session_start();
include '../connections.php';

// Check if user is admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

// Fetch all staff
$staffQuery = mysqli_query($conn, "SELECT * FROM staff");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Manage Staff</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Position</th>
            <th>Actions</th>
        </tr>
        <?php while ($staff = mysqli_fetch_assoc($staffQuery)): ?>
            <tr>
                <td><?= $staff['id'] ?></td>
                <td><?= $staff['name'] ?></td>
                <td><?= $staff['email'] ?></td>
                <td><?= $staff['phone'] ?></td>
                <td><?= $staff['position'] ?></td>
                <td>
                    <a href="edit_staff.php?id=<?= $staff['id'] ?>">Edit</a> |
                    <a href="delete_staff.php?id=<?= $staff['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="add_staff.php">Add New Staff</a>
</body>
</html>
