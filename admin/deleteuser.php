<?php
include "connections.php";

if (isset($_POST['delete'])) {
    // Get the user_id from the form submission
    $user_id = $_POST['user_id'];

    // Prepare the DELETE query
    $query = "DELETE FROM customer WHERE user_id='$user_id'";

    // Execute the query and check for errors
    if (mysqli_query($conn, $query)) {
        // Redirect to users.php on successful deletion
        header("Location: users.php");
        exit();
    } else {
        // Handle the error if the deletion fails
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
