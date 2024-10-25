<?php

// Load environment variables from .env file
require 'vendor/autoload.php'; // Ensure this path is correct

use Dotenv\Dotenv;

// Load the .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Creating a variable begins with a dollar sign followed by the name of the variable
// Making a connection to the MySQL database

$databasehost = "mysql"; // name of the server
$databaseuser = "root"; // username of the database
$databasepassword = "6970"; // password
$databasename = $_ENV['MYSQL_DATABASE']; // database name of Beauty Parlour Management System

// Create and check connection
// Test for errors
$conn = mysqli_connect($databasehost, $databaseuser, $databasepassword, $databasename);

if (!$conn) {
    echo "<script>alert('Connection failed!');</script>";
    die("Failed to connect: " . mysqli_connect_error());
}
// Close the connection (optional, you can keep it open if needed later)
// mysqli_close($conn);
?>
