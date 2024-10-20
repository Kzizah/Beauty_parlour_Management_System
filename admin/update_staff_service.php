<?php
include "connections.php";

// Initialize variables for the assignment
$assignment = null;

// Check if staff_id and service_id are set in the POST request
if (isset($_POST['staff_id']) && isset($_POST['service_id'])) {
    $staff_id = $_POST['staff_id'];
    $service_id = $_POST['service_id'];

    // Fetch the existing assignment details
    $query = "SELECT * FROM staff_service WHERE staff_id = ? AND service_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $staff_id, $service_id); // Assuming service_id is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a record was found
    if ($result->num_rows > 0) {
        $assignment = $result->fetch_assoc();
    } else {
        echo "No assignment found.";
        exit();
    }
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $new_staff_id = $_POST['new_staff_id'];
    $new_service_id = $_POST['new_service_id'];

    // Perform the update operation
    $update_query = "UPDATE staff_service SET staff_id = ?, service_id = ? WHERE staff_id = ? AND service_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssis", $new_staff_id, $new_service_id, $staff_id, $service_id); // Adjust binding types as necessary

    if ($update_stmt->execute()) {
        // Redirect to staffservice.php after successful update
        header("Location: staffservice.php");
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo "Error updating assignment: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index.css"/>
    <title>Update Staff-Service Assignment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h2 {
            color: #009879;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #009879;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #007f65;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h2>Update Staff-Service Assignment</h2>

<?php if ($assignment): ?>
<form action="update_staff_service.php" method="POST">
    <input type="hidden" name="staff_id" value="<?php echo htmlspecialchars($assignment['staff_id']); ?>">
    <input type="hidden" name="service_id" value="<?php echo htmlspecialchars($assignment['service_id']); ?>">
    
    <label for="new_staff_id">New Staff ID:</label>
    <input type="text" name="new_staff_id" value="<?php echo htmlspecialchars($assignment['staff_id']); ?>" required><br>

    <label for="new_service_id">New Service ID:</label>
    <input type="number" name="new_service_id" value="<?php echo htmlspecialchars($assignment['service_id']); ?>" required><br>

    <button type="submit" name="update">Update Assignment</button>
</form>
<?php else: ?>
<p class="error">No assignment data available to edit.</p>
<?php endif; ?>

</body>
</html>
