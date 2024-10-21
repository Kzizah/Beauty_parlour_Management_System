<?php
include "connections.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index.css"/>
    <title>Registered Users</title>
    <style>
        /* Basic Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 1em;
            font-family: 'Arial', sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
        }

        /* Header Styling */
        th {
            background-color: #009879;
            color: #ffffff;
        }

        tr {
            border-bottom: 1px solid #dddddd;
        }

        tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        /* Button Styling */
        .action-btn {
            padding: 8px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .action-btn:hover {
            background-color: #218838;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this user?");
        }
    </script>
</head>
<body>
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
        <li><button onclick="document.location='logout.php'">Log Out </button></li>

    </nav>

    <h2>Registered Users</h2>

    <table id="table1">
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Login Attempts</th>
            <th>Last Failed Login</th>
            <th>Lockout Until</th>
            <th>DELETE</th>
            <th>UPDATE</th>
        </tr>

        <?php
        // Fetch all users from the customer table
        $query = "SELECT * FROM customer;";
        $result = mysqli_query($conn, $query);
        $resultCheck = mysqli_num_rows($result); // Check if there are records in the DB

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" 
                    . htmlspecialchars($row['user_id']) . "</td><td>" 
                    . htmlspecialchars($row['user_name']) . "</td><td>" 
                    . htmlspecialchars($row['email']) . "</td><td>" 
                    . htmlspecialchars($row['role']) . "</td><td>" 
                    . htmlspecialchars($row['login_attempts']) . "</td><td>" 
                    // . htmlspecialchars($row['last_failed_login']) . "</td><td>"
                    . htmlspecialchars($row['last_failed_login'] ?? '') . "</td><td>"
                    // . htmlspecialchars($row['lockout_until']) . "</td><td>";
                    . htmlspecialchars($row['lockout_until'] ?? '') . "</td><td>";
                
                // DELETE button
                echo "<form action='./deleteuser.php' method='POST' onsubmit='return confirmDelete();'>
                    <input type='hidden' name='user_id' value='" . htmlspecialchars($row['user_id']) . "'>
                    <button type='submit' name='delete' class='action-btn delete-btn'>Delete</button>
                </form></td><td>";
                
                // UPDATE button
                echo "<form action='./update_user.php' method='POST'>
                    <input type='hidden' name='user_id' value='" . htmlspecialchars($row['user_id']) . "'>
                    <button type='submit' name='edit' class='action-btn'>Update</button>
                </form></td></tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No users found</td></tr>";
        }
        ?>   
    </table>

    <br>

</body>

<!-- Footer -->
<footer>
    <!-- Logo -->
    <div class="logo">
        <a onmouseover="this.style.color='red'" onmouseout="this.style.color='black'">
            <b>The <br> Hobbits <br> Parlour</b>
        </a>
    </div>
    <!-- Social Bar -->
    <div class="social-bar">
        <a href="https://m.me/darrells.jaccuzzi"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/jaccuzzi8/"><i class="fab fa-instagram"></i></a>
        <a href="https://api.whatsapp.com/send?phone=254791938182&text=%F0%9F%98%87%F0%9F%A5%B0%F0%9F%91%8D%F0%9F%98%98"><i class="fab fa-whatsapp"></i></a>
        <a href="https://twitter.com/Darrell00564947?s=09"><i class="fab fa-twitter"></i></a>
    </div>
    <div>Copyright &copy; 2023 The Beauty Parlour<br></div>
</footer>

</html>
