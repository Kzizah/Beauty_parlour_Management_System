<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty Parlour</title>
    <link rel="stylesheet" type="text/css" href="index.css" />
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- Navigation -->
    <nav>
        <div class="logo">
            <a onmouseover="style.color='red'" onmouseout="style.color='black'">
                <b>The <br> Hobbits <br> Parlour</b>
            </a>
        </div>
        <li><button onclick="document.location='users.php'">Registered Customers</button></li>
        <li><button onclick="document.location='services.php'">Services We Offer</button></li>
        <li><button onclick="document.location='bookings.php'">Bookings Done</button></li>
    </nav>
</head>

<body>
    <?php
    include "connections.php";
    ?>

    <br>
    <table border="1" class="bookings-table">
        <tr>
            <th>Booking Id</th>
            <th>Service Name</th>
            <th>User Name</th>
            <th>Customer Email</th>
            <th>Booking Date</th>
            <th>Status</th>
            <th>Payment Status</th>
            <th>Booking Time</th>
            <th>DELETE</th>
            <th>UPDATE</th>
        </tr>
        <?php
        $query = "SELECT * FROM bookings;";
        $result = mysqli_query($conn, $query);
        $resultCheck = mysqli_num_rows($result); // Checks if there's data in the db
        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td>" . htmlspecialchars($row['service_name']) . "</td>
                <td>" . htmlspecialchars($row['user_name']) . "</td>
                <td>" . htmlspecialchars($row['customer_email']) . "</td>
                <td>" . htmlspecialchars($row['booking_date']) . "</td>
                <td>" . htmlspecialchars($row['status']) . "</td>
                <td>" . htmlspecialchars($row['payment_status']) . "</td>
                <td>" . htmlspecialchars($row['booking_time']) . "</td>
                <td>
                    <form action='./deletebookings.php' method='POST' >
                        <input type='hidden' name='booking_id' value='" . htmlspecialchars($row['id']) . "'>
                        <button type='submit' name='delete' class='delete-btn'>Delete</button>
                    </form>
                </td>
                <td>
                    <form action='./update_booking.php' method='POST'>
                        <input type='hidden' name='booking_id' value='" . htmlspecialchars($row['id']) . "'>
                        <button type='submit' name='edit' class='update-btn'>Update</button>
                    </form>
                </td>
            </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No data</td></tr>";
        }
        ?>
    </table>
    <br>
    <br>

</body>
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
</html>
