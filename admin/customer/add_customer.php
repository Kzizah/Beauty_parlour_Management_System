<?php
session_start();
include '../connections.php';
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO customer (user_name, email, password) VALUES ('$user_name', '$email', '$password')";
    mysqli_query($conn, $query);
    header("Location: manage_customers.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Customer</title>
</head>
<body>
    <h1>Add Customer</h1>
    <form method="POST">
        <label for="user_name">User Name:</label>
        <input type="text" name="user_name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Add Customer">
    </form>
</body>
</html>
