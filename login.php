<?php
session_start();
include("connections.php");
include("functions.php");
require_once 'vendor/autoload.php'; // Include Composer autoloader

$gAuth = new PHPGangsta_GoogleAuthenticator();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $code = trim($_POST['2fa_code']);

    $query = "SELECT * FROM customer WHERE user_name = '$user_name' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);

        if (password_verify($password, $user_data['password'])) {
            // Verify 2FA code
            $secret = $user_data['two_fa_secret'];
            if ($gAuth->verifyCode($secret, $code)) {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: index.php");
                die;
            } else {
                echo "Invalid 2FA code.";
            }
        } else {
            echo "Wrong username or password!";
        }
    } else {
        echo "Wrong username or password!";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | The Hobbits Parlour</title>
    <link href="bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-5">Login</h2>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="user_name" class="form-label">Username</label>
                <input type="text" class="form-control" id="user_name" name="user_name" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" id="showPassword">
                    <label class="form-check-label" for="showPassword">
                        Show Password
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="2fa_code" class="form-label">2FA Code</label>
                <input type="text" class="form-control" id="2fa_code" name="2fa_code" required>
                <button type="button" id="scanQRCode" class="btn btn-secondary mt-2">Scan QR Code</button>
                <div id="qrCodeScanner" style="display:none;"></div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <div class="text-center mt-3">
                <a href="signup.php">Don't have an account? Sign up here</a>
            </div>
            <div class="text-center mt-2">
                <a href="forgot_password.php">Forgot Password?</a>
            </div>
        </form>
    </div>

    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript to toggle password visibility
        const showPasswordCheckbox = document.getElementById('showPassword');
        const passwordInput = document.getElementById('password');

        showPasswordCheckbox.addEventListener('change', function() {
            const type = this.checked ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });

        // QR Code Scanner
        const scanQRCodeButton = document.getElementById('scanQRCode');
        const qrCodeScannerDiv = document.getElementById('qrCodeScanner');
        const twoFACodeInput = document.getElementById('2fa_code');

        scanQRCodeButton.addEventListener('click', function() {
            qrCodeScannerDiv.innerHTML = ""; // Clear any previous scanner

            const html5QrCode = new Html5Qrcode("qrCodeScanner");

            html5QrCode.start(
                { facingMode: "environment" }, // Use the back camera
                {
                    fps: 10,
                    qrbox: 250 // Customize the scanning area
                },
                (decodedText, decodedResult) => {
                    twoFACodeInput.value = decodedText; // Set the scanned code in the input
                    html5QrCode.stop().then(ignore => {
                        qrCodeScannerDiv.style.display = "none"; // Hide the scanner
                    }).catch(err => {
                        console.warn(`Failed to stop scanning: ${err}`);
                    });
                },
                (errorMessage) => {
                    // Log errors if needed
                })
                .catch(err => {
                    console.error(`Unable to start scanning: ${err}`);
                });
            
            qrCodeScannerDiv.style.display = "block"; // Show the scanner
        });
    </script>
</body>
</html>
