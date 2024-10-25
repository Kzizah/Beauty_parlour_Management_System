<?php
// Check if the session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set session timeout duration (5 minutes)
$timeout_duration = 300; // 5 minutes in seconds

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Check if the last activity time is set
    if (isset($_SESSION['LAST_ACTIVITY'])) {
        // Check if the time since last activity exceeds the timeout duration
        if ((time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
            // Session has timed out, unset and destroy the session
            session_unset();
            session_destroy();
            header("Location: login.php?message=Session expired. Please log in again.");
            exit();
        }
    }
    // Update last activity time
    $_SESSION['LAST_ACTIVITY'] = time(); // Update last activity timestamp
} else {
    // If user is not logged in, redirect to login page
    header("Location: login.php?message=Please log in first.");
    exit();
}
?>
