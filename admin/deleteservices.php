<?php
include "connections.php";

if (isset($_POST['delete'])) {
    $service_id = $_POST['service_id'];

    // Use the correct column name 'id' instead of 'service_id'
    $query = "DELETE FROM services WHERE id='$service_id'"; // Change 'service_id' to 'id'
    
    if (mysqli_query($conn, $query)) {
        header("Location: services.php");
        exit; // Always use exit after header redirection to stop script execution
    } else {
        echo "Error deleting service: " . mysqli_error($conn); // Optional: display error message
    }
}
?>
