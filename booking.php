<?php
session_start();
include 'connections.php';
include 'functions.php';

// Fetch user data
$user_data = check_login($conn);

// Fetch services from the database
$sql = "SELECT * FROM services";
$result = $conn->query($sql);

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <style>
        /* General Body Styling */
        body {
            background-color: black; /* Brown color */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Navbar Styling */
        .navbar {
            background-color: black; /* Adjust as needed */
            color: white;
            padding: 10px;
        }

        .navbar__container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar__logo {
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
        }

        .navbar__menu {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .navbar__item {
            margin: 0 10px;
        }

        .navbar__links {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
        }

        .navbar__links:hover {
            background-color: #5a6268; /* Darker shade for hover effect */
            border-radius: 4px;
        }

        .search-box {
            display: flex;
            align-items: center;
        }

        .tbox {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-btn {
            background-color: #5a6268;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
            margin-left: 5px;
        }

        /* Card Styling */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .card-horizontal {
            display: flex;
            flex-direction: row;
            align-items: center;
            background-color: #ffffff;
        }

        .card-img-left {
            width: 30%;
            height: 30%; /* Adjust height as needed */
            object-fit: cover;
        }

        .card-body-right {
            flex-grow: 1;
            padding-left: 15px;
        }

        .card-text {
            max-height: 60px;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 12px;
            color: #6c757d; /* Matching the text color */
        }

        /* Custom Button Styling */
        .btn-custom {
            background-color: #6c757d;
            color: white;
            border-radius: 0.25rem;
            border: none;
            cursor: pointer;
            padding: 10px;
        }

        .btn-custom:hover {
            background-color: #5a6268;
        }

        h1 {
            color: #ffffff; /* Heading color */
        }
    </style>
</head>
<body>
    <!-- Navbar Section -->
    <nav class="navbar">
        <div class="navbar__container">
            <a href="#home" id="navbar__logo">ZILDAI</a>
            <!-- This is our hamburger menu -->
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
                    <a href="index" class="navbar__links" id="about-page">About Us</a>
                </li>
                <li class="navbar__item">
                    <a href="booking.php" class="navbar__links" id="services-page">Services</a>
                </li>
            </ul>
            <div class="search-box">
                <input type="text" class="tbox" placeholder="Search.." onkeyup="search_service()" id="searchbar">
                <button class="search-btn"><i class="fas fa-search"></i></button>
            </div>
        </div>
        <li><button onclick="document.location='logout.php'">Log Out</button></li>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center">Our Services</h1>

        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card card-horizontal">
                            <img src="<?php echo $row['image']; ?>" class="card-img-left" alt="<?php echo $row['service_name']; ?>">
                            <div class="card-body card-body-right">
                                <h5 class="card-title"><?php echo $row['service_name']; ?></h5>
                                <p class="card-text"><?php echo substr($row['description'], 0, 100) . (strlen($row['description']) > 100 ? '...' : ''); ?></p>
                                <p class="card-text">Price: $<?php echo number_format($row['price'], 2); ?></p>
                                <p class="card-text">Available Slots: <?php echo $row['session_slots'] - $row['booked_slots']; ?></p>
                                <br>
                                <a href="book_service.php?service_id=<?php echo $row['id']; ?>" class="btn btn-custom">Book Now</a>
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
