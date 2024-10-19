<?php

//creating a variable begins with a dollar sign followed by the name of the variable
//making a connection to the MySQL database

$databasehost = "localhost"; //name of the server
$databaseuser = "root"; //username of the database
$databasepassword = "6970"; //password
$databasename = "parlour"; //database name of Beauty Parlour Management System

//create and check connection
//test for errors
if (!$conn = mysqli_connect($databasehost, $databaseuser, $databasepassword, $databasename)) {
    echo "<script>alert('Connection failed!');</script>";
    die("Failed to connect!");
} 
?>
