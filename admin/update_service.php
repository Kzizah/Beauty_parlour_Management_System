<?php
include "connections.php";

// Fetch the service details based on service_id
if (isset($_POST['service_id'])) {
    $service_id = $_POST['service_id'];
    $query = "SELECT * FROM services WHERE id = '$service_id';"; // Use 'id' as the primary key
    $result = mysqli_query($conn, $query);
    
    // Check if the service exists
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Service not found.";
        exit;
    }
}

// Handle the update form submission
if (isset($_POST['update'])) {
    $service_name = $_POST['service_name'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $session_slots = $_POST['session_slots'];
    $booked_slots = $_POST['booked_slots'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];

    // Update the service details in the database
    $updateQuery = "UPDATE services SET 
        service_name = '$service_name', 
        description = '$description', 
        image = '$image', 
        session_slots = '$session_slots', 
        booked_slots = '$booked_slots', 
        price = '$price', 
        duration = '$duration' 
        WHERE id = '$service_id';";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: services.php"); // Redirect to services.php after successful update
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
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
    <title>Update Service</title>
    <style>
        /* Basic Table Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
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

        textarea {
            resize: vertical;
        }
    </style>
</head>
<body>

    <h2>Update Service Details</h2>

    <form action="update_service.php" method="POST">
        <input type="hidden" name="service_id" value="<?php echo htmlspecialchars($row['id']); ?>">

        <label for="service_name">Service Name:</label>
        <input type="text" name="service_name" value="<?php echo htmlspecialchars($row['service_name']); ?>" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required><?php echo htmlspecialchars($row['description']); ?></textarea><br>

        <label for="image">Image URL:</label>
        <input type="text" name="image" value="<?php echo htmlspecialchars($row['image']); ?>"><br>

        <label for="session_slots">Session Slots:</label>
        <input type="number" name="session_slots" value="<?php echo htmlspecialchars($row['session_slots']); ?>" min="0" required><br>

        <label for="booked_slots">Booked Slots:</label>
        <input type="number" name="booked_slots" value="<?php echo htmlspecialchars($row['booked_slots']); ?>" min="0" required><br>

        <label for="price">Price:</label>
        <input type="number" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" step="0.01" required><br>

        <label for="duration">Duration (in minutes):</label>
        <input type="number" name="duration" value="<?php echo htmlspecialchars($row['duration']); ?>" min="0" required><br>

        <button type="submit" name="update">Update Service</button>
    </form>

</body>
</html>
