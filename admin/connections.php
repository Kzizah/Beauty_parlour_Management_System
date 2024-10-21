<?php
//creating a variable begins with a dollar sign followed by the name of the variable
//making a connection to the database
$databasehost = "mysql";//name of the server
$databaseuser = "root";//user name
$databasepassword = "6970";
$databasename = "parlour";//database name
//create and check connection
//test for errors
if (!$conn = mysqli_connect($databasehost,$databaseuser,$databasepassword,$databasename))
{
    echo "<script> alert(Connection successful </script>)";
    die ("Failed to connect!");
}
?>