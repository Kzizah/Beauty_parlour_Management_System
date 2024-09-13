<?php

function check_login($conn)
{
    if (isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        // Adjusted to use the correct table and fields
        $query = "SELECT * FROM customer WHERE user_id = '$id' LIMIT 1";

        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    // Redirect to login if no session found
    header("Location: login.php");
    die;
}

function random_num($length)
{
    $text = "";
    if ($length < 5)
    {
        $length = 5;
    }

    $len = rand(4, $length);

    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }

    return $text;
}
