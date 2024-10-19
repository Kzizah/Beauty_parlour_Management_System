<?php
include "connections.php";

// Fetch the booking details based on booking_id
if (isset($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];
    $query = "SELECT * FROM bookings WHERE id = '$booking_id';"; // Use 'id' as the primary key
    $result = mysqli_query($conn, $query);
    
    // Check if the booking exists
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Booking not found.";
        exit;
    }
}

// Handle the update form submission
if (isset($_POST['update'])) {
    $user_name = $_POST['user_name'];
    $customer_email = $_POST['customer_email'];
    $booking_date = $_POST['booking_date'];
    $status = $_POST['status'];
    $payment_status = $_POST['payment_status'];
    $booking_time = $_POST['booking_time'];

    // Update the booking details in the database, excluding locked fields
    $updateQuery = "UPDATE bookings SET 
        user_name = '$user_name', 
        customer_email = '$customer_email', 
        booking_date = '$booking_date', 
        status = '$status', 
        payment_status = '$payment_status', 
        booking_time = '$booking_time' 
        WHERE id = '$booking_id';";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: bookings.php"); // Redirect to bookings.php after successful update
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
    <title>Update Booking</title>
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
        input[type="email"],
        input[type="date"],
        input[type="time"] {
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
    <!-- Navigation -->
  

    <h2>Update Booking Details</h2>

    <form action="update_booking.php" method="POST">
        <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($row['id']); ?>">

        <label for="service_name">Service Name:</label>
        <input type="text" name="service_name" value="<?php echo htmlspecialchars($row['service_name']); ?>" readonly><br>

        <label for="user_name">User Name:</label>
        <input type="text" name="user_name" value="<?php echo htmlspecialchars($row['user_name']); ?>" required><br>

        <label for="customer_email">Customer Email:</label>
        <input type="email" name="customer_email" value="<?php echo htmlspecialchars($row['customer_email']); ?>" required><br>

        <label for="booking_date">Booking Date:</label>
        <input type="date" name="booking_date" value="<?php echo htmlspecialchars($row['booking_date']); ?>" required><br>

        <label for="status">Status:</label>
        <input type="text" name="status" value="<?php echo htmlspecialchars($row['status']); ?>" required><br>

        <label for="payment_status">Payment Status:</label>
        <input type="text" name="payment_status" value="<?php echo htmlspecialchars($row['payment_status']); ?>" required><br>

        <label for="booking_time">Booking Time:</label>
        <input type="time" name="booking_time" value="<?php echo htmlspecialchars($row['booking_time']); ?>" required><br>

        <button type="submit" name="update" class="update-btn">Update Booking</button>
    </form>

    <!-- Footer -->
    <footer>
        <div class="logo">
            <a onmouseover="style.color='red'" onmouseout="style.color='black'">
                <b>The <br> Hobbits <br> Parlour</b>
            </a>
        </div>
        <div class="social-bar">
            <a href="https://m.me/darrells.jaccuzzi"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/jaccuzzi8/"><i class="fab fa-instagram"></i></a>
            <a href="https://api.whatsapp.com/send?phone=254791938182&text=%F0%9F%98%87%F0%9F%A5%B0%F0%9F%91%8D%F0%9F%98%98"><i class="fab fa-whatsapp"></i></a>
            <a href="https://twitter.com/Darrell00564947?s=09"><i class="fab fa-twitter"></i></a>
        </div>
        <div>Copyright &copy; 2023 The Beauty Parlour<br></div>
    </footer>
</body>
</html>
