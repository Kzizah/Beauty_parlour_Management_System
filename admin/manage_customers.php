<?php
include '../connections.php'; // Correct path for the connection

// Fetch customers from the database
$result = mysqli_query($conn, "SELECT * FROM customer");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers</title>
</head>
<body>
    <h1>Manage Customers</h1>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td>
                <form action="customer/edit_customer.php" method="POST" style="display:inline;">
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                    <input type="submit" value="Edit">
                </form>
                <form action="customer/delete_customer.php" method="POST" style="display:inline;">
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                    <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="create_customer.php">Create New Customer</a>
</body>
</html>
