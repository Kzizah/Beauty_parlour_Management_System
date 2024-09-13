<?php

//creating a variable begins with a dollar sign followed by the name of the variable
//making a connection to the my sql database

$databasehost = "localhost";//name of the server
$databaseuser = "root";//username of my database
$databasepassword = "6970"; //password
$databasename = "parlour";//database name of Beauty Parlour Management System

//create and check connection
//test for errors
if (!$conn = mysqli_connect($databasehost,$databaseuser,$databasepassword,$databasename))
{
    echo "<script> alert(Connection successful </script>)";
    die ("Failed to connect!");
}
?>