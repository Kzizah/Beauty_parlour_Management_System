<?php
session_start();
include 'connections.php';
include 'functions.php';
include 'header.php'; // Include the session management logic

// Fetch user data
$user_data = check_login($conn);

// Fetch services from the database
$sql = "SELECT * FROM services";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <!-- Navbar Section -->
    <nav class="navbar">
        <div class="navbar__container">
            <a href="#home" id="navbar__logo">ZILDAI</a>
            <div class="navbar__toggle" id="mobile-menu">
                <span class="bar"></span> 
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="navbar__menu">
                <li class="navbar__item">
                    <a href="index.php" class="navbar__links" id="home-page">Home</a>
                </li>
                <li class="navbar__item">
                    <a href="index.php" class="navbar__links" id="about-page">About Us</a>
                </li>
                <li class="navbar__item">
                    <a href="booking.php" class="navbar__links" id="services-page">Services</a>
                </li>
            </ul>
            <li><button onclick="document.location='logout.php'">Log Out</button></li>
        </div>
    </nav>
    
    <div class="container mt-5">
        <h1 class="text-center">Our Services</h1>

        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card card-horizontal">
                            <img src="<?php echo $row['image']; ?>" class="card-img-left img-circle" alt="<?php echo $row['service_name']; ?>">
                            <div class="card-body card-body-right">
                                <h5 class="card-title"><?php echo $row['service_name']; ?></h5>
                                <p class="card-text"><?php echo substr($row['description'], 0, 100) . (strlen($row['description']) > 100 ? '...' : ''); ?></p>
                                <p class="card-text">Price: $<?php echo number_format($row['price'], 2); ?></p>
                                <p class="card-text">Available Slots: <?php echo $row['session_slots'] - $row['booked_slots']; ?></p>
                                <br>
                                <!-- Booking Form -->
                                <form action="process_booking.php" method="POST">
                                    <input type="hidden" name="service_id" value="<?php echo $row['id']; ?>">

                                    <!-- Fetch staff for this service -->
                                    <div class="mb-3">
                                        <label for="staff_id" class="form-label">Select Staff</label>
                                        <select name="staff_id" class="form-select" required>
                                            <option value="">Choose Staff...</option>
                                            <?php
                                            // Fetch staff members from the customer table based on the role of 'staff'
                                            $staff_sql = "SELECT customer.user_id, customer.user_name
                                                          FROM customer
                                                          INNER JOIN staff_service ON customer.user_id = staff_service.staff_id
                                                          WHERE staff_service.service_id = " . $row['id'];
                                            $staff_result = $conn->query($staff_sql);
                                            while ($staff_row = $staff_result->fetch_assoc()): ?>
                                                <option value="<?php echo $staff_row['user_id']; ?>"><?php echo $staff_row['user_name']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-custom">Book Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No services found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
