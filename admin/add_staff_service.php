<?php
include "connections.php"; // Include your database connection

// Initialize variables
$staff_id = '';
$service_id = '';
$message = '';

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $staff_id = $_POST['staff_id'];
    $service_id = $_POST['service_id'];

    // Prepare the SQL query to insert the new assignment
    $insert_query = "INSERT INTO staff_service (staff_id, service_id) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("si", $staff_id, $service_id); // Assuming service_id is an integer

    if ($stmt->execute()) {
        $message = "Assignment added successfully.";
        // Redirect to staffservice.php after successful addition
        header("Location: staffservice.php");
        exit();
    } else {
        $message = "Error adding assignment: " . $conn->error;
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
    <title>Add Staff-Service Assignment</title>
    <style>
        /* Basic styling for the form */
        form {
            margin: 20px 0;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .message {
            margin: 10px 0;
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<h2>Add Staff-Service Assignment</h2>

<?php if ($message): ?>
    <div class="message"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<form action="add_staff_service.php" method="POST">
    <label for="staff_id">Staff ID:</label>
    <input type="text" name="staff_id" required value="<?php echo htmlspecialchars($staff_id); ?>">

    <label for="service_id">Service ID:</label>
    <input type="number" name="service_id" required value="<?php echo htmlspecialchars($service_id); ?>">

    <button type="submit" name="add">Add Assignment</button>
</form>

</body>
</html>
