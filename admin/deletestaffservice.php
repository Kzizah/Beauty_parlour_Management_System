<?php
include "connections.php"; // Include the database connection

if (isset($_POST['delete'])) {
    // Get the staff_id and service_id from the POST request
    $staff_id = mysqli_real_escape_string($conn, $_POST['staff_id']);
    $service_id = mysqli_real_escape_string($conn, $_POST['service_id']);
    
    // Prepare the SQL delete statement
    $query = "DELETE FROM staff_service WHERE staff_id = '$staff_id' AND service_id = '$service_id'";
    
    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Success: Redirect to the previous page with a success message
        header("Location: staffservice.php?delete=success");
        exit();
    } else {
        // Error: Redirect to the previous page with an error message
        header("Location: staffservice.php?delete=error");
        exit();
    }
} else {
    // Redirect back to the assignments page if accessed directly
    header("Location: staffservice.php");
    exit();
}
?>
