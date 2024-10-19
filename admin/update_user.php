<?php
include "connections.php";

// Fetch the user details based on user_id
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $query = "SELECT * FROM customer WHERE user_id = '$user_id';";
    $result = mysqli_query($conn, $query);
    
    // Check if the user exists
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "User not found.";
        exit;
    }
}

// Handle the update form submission
if (isset($_POST['update'])) {
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $login_attempts = $_POST['login_attempts'];

    // Check if the datetime inputs are set and valid
    $last_failed_login = !empty($_POST['last_failed_login']) ? date('Y-m-d H:i:s', strtotime($_POST['last_failed_login'])) : null;
    $lockout_until = !empty($_POST['lockout_until']) ? date('Y-m-d H:i:s', strtotime($_POST['lockout_until'])) : null;

    // Prepare the update query dynamically based on which fields are provided
    $updateFields = [
        "user_name = '$user_name'",
        "email = '$email'",
        "role = '$role'",
        "login_attempts = '$login_attempts'"
    ];

    // Add last_failed_login if it's not null
    if ($last_failed_login !== null) {
        $updateFields[] = "last_failed_login = '$last_failed_login'";
    } else {
        $updateFields[] = "last_failed_login = NULL"; // Set to NULL if no date is provided
    }

    // Add lockout_until if it's not null
    if ($lockout_until !== null) {
        $updateFields[] = "lockout_until = '$lockout_until'";
    } else {
        $updateFields[] = "lockout_until = NULL"; // Set to NULL if no date is provided
    }

    // Build the final update query
    $updateQuery = "UPDATE customer SET " . implode(", ", $updateFields) . " WHERE user_id = '$user_id';";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: users.php"); // Redirect to users.php after successful update
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
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="datetime-local"] {
            width: calc(100% - 22px); /* Full width minus padding */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #009879;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #007f68;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <h2>Update User Details</h2>

    <form action="update_user.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($row['user_id']); ?>">

        <label for="user_name">Username:</label>
        <input type="text" name="user_name" value="<?php echo htmlspecialchars($row['user_name']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>

        <label for="role">Role:</label>
        <input type="text" name="role" value="<?php echo htmlspecialchars($row['role']); ?>" required>

        <label for="login_attempts">Login Attempts:</label>
        <input type="number" name="login_attempts" value="<?php echo htmlspecialchars($row['login_attempts']); ?>" min="0" required>

        <label for="last_failed_login">Last Failed Login:</label>
        <input type="datetime-local" name="last_failed_login" value="<?php echo $row['last_failed_login'] ? date('Y-m-d\TH:i', strtotime($row['last_failed_login'])) : ''; ?>">

        <label for="lockout_until">Lockout Until:</label>
        <input type="datetime-local" name="lockout_until" value="<?php echo $row['lockout_until'] ? date('Y-m-d\TH:i', strtotime($row['lockout_until'])) : ''; ?>">

        <button type="submit" name="update">Update User</button>
    </form>

</body>
</html>
