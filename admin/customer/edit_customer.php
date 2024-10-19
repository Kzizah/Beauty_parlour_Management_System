<?php
session_start();
include '../connections.php';

// Redirect to login if the user is not an admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

// Check if a POST request was made to update the customer
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE customer SET user_name=?, email=? WHERE user_id=?");
    $stmt->bind_param("ssi", $user_name, $email, $user_id);

    if ($stmt->execute()) {
        header("Location: manage_customers.php");
        exit;
    } else {
        echo "Error updating customer: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Check if the user ID is provided in the URL
    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];
        
        // Fetch customer data using prepared statements
        $stmt = $conn->prepare("SELECT * FROM customer WHERE user_id=?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $customer = $result->fetch_assoc();
        } else {
            echo "Customer not found.";
            exit;
        }
        
        $stmt->close();
    } else {
        echo "Invalid request.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Customer</title>
</head>
<body>
    <h1>Edit Customer</h1>
    <form method="POST">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($customer['user_id']) ?>">
        <label for="user_name">User Name:</label>
        <input type="text" name="user_name" value="<?= htmlspecialchars($customer['user_name']) ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($customer['email']) ?>" required>
        <br>
        <input type="submit" value="Update Customer">
    </form>
</body>
</html>
