<?php
session_start();
include '../connections.php';
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $query = "DELETE FROM customer WHERE user_id='$user_id'";
    mysqli_query($conn, $query);
}
header("Location: manage_customers.php");
?>
