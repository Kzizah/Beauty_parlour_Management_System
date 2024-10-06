<?php
session_start();

// Check if the QR code URL exists in the session
if (!isset($_SESSION['qrCodeUrl'])) {
    header("Location: signup.php");
    die;
}

$qrCodeUrl = $_SESSION['qrCodeUrl'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup 2FA | The Hobbits Parlour</title>
    
    <!-- Bootstrap CSS -->
    <link href="bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="index.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="card p-4">
            <h2 class="text-center text-muted">Setup Two-Factor Authentication (2FA)</h2>
            <p class="text-center">Scan the QR code below with your Google Authenticator app:</p>
            <div class="text-center">
                <img src="<?php echo $qrCodeUrl; ?>" alt="Scan this code with Google Authenticator">
            </div>
            <div class="text-center mt-4">
                <a href="login.php" class="btn btn-custom">Proceed to Login</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
