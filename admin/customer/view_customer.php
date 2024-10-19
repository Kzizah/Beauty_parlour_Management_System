<?php
session_start();
include '../connections.php';
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$user_id = $_GET['id'];
$customerQuery = mysqli_query($conn, "SELECT * FROM customer WHERE user_id='$user_id'");
$customer = mysqli_fetch_assoc($customerQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Customer</title>
</head>
<body>
    <h1>View Customer</h1>
    <p>User ID: <?= $customer['user_id'] ?></p>
    <p>User Name: <?= $customer['user_name'] ?></p>
    <p>Email: <?= $customer['email'] ?></p>
    <a href="manage_customers.php">Back to Customers</a>
</body>
</html>
