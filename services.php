<?php
include 'connections.php';

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
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
            color: #6c757d; /* Heading color */
        }
    </style>
</head>
<body>
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
                                <a href="booking.php?service_id=<?php echo $row['id']; ?>" class="btn btn-custom">Book Now</a>
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
