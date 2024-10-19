<?php
session_start();

// Database connection
$databasehost = "localhost"; // Name of the server
$databaseuser = "root";      // Username of my database
$databasepassword = "6970";  // Password
$databasename = "parlour";   // Database name of Beauty Parlour Management System

// Create and check connection
if (!$conn = mysqli_connect($databasehost, $databaseuser, $databasepassword, $databasename)) {
    echo "<script>alert('Connection failed!');</script>";
    die("Failed to connect!");
}

// Fetch counts for the dashboard (only if the user is an admin)
if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
    $numCustomers = mysqli_query($conn, "SELECT COUNT(*) AS count FROM customer")->fetch_assoc()['count'];
    $numBookings = mysqli_query($conn, "SELECT COUNT(*) AS count FROM bookings")->fetch_assoc()['count'];
    $numStaff = mysqli_query($conn, "SELECT COUNT(*) AS count FROM staff")->fetch_assoc()['count'];
    $numServices = mysqli_query($conn, "SELECT COUNT(*) AS count FROM services")->fetch_assoc()['count'];
} else {
    // Default values for non-admin users
    $numCustomers = $numBookings = $numStaff = $numServices = "N/A";
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="path/to/your/styles.css"> <!-- Link to your CSS -->
</head>
<body>
    <header>
        <h1>User Dashboard</h1>
        <nav>
            <ul>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="book_service.php">Book a Service</a></li>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin'): ?>
                    <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
                    <li><a href="manage_customers.php">Manage Customers</a></li>
                    <li><a href="manage_bookings.php">Manage Bookings</a></li>
                    <li><a href="manage_staff.php">Manage Staff</a></li>
                    <li><a href="manage_services.php">Manage Services</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Statistics</h2>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin'): ?>
                <div class="dashboard-cards">
                    <div class="card">
                        <h3>Number of Customers</h3>
                        <p><?php echo htmlspecialchars($numCustomers); ?></p>
                    </div>
                    <div class="card">
                        <h3>Number of Bookings Made</h3>
                        <p><?php echo htmlspecialchars($numBookings); ?></p>
                    </div>
                    <div class="card">
                        <h3>Number of Staff</h3>
                        <p><?php echo htmlspecialchars($numStaff); ?></p>
                    </div>
                    <div class="card">
                        <h3>Number of Services</h3>
                        <p><?php echo htmlspecialchars($numServices); ?></p>
                    </div>
                </div>
            <?php else: ?>
                <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! You can book services and manage your account.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Beauty Parlour Management System</p>
    </footer>
</body>
</html>
