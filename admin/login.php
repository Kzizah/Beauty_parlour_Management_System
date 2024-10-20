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

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM customer WHERE user_name = ? LIMIT 1");
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user_data = $result->fetch_assoc();

        // Check if account is locked
        if ($user_data['lockout_until'] && strtotime($user_data['lockout_until']) > time()) {
            $remaining_time = strtotime($user_data['lockout_until']) - time();
            $unlock_time = date("H:i:s", strtotime($user_data['lockout_until']));
            echo "<div id='lockoutMessage'>Account is locked. Please try again at $unlock_time.</div>";
            echo "<div id='countdown'></div>"; // Add countdown div
            echo "<script>var remainingTime = $remaining_time;</script>"; // Pass remaining time to JavaScript
            exit;
        }

        // Check login attempts
        if ($user_data['login_attempts'] >= 5) {
            // Lock account for 5 minutes
            $lockout_time = date("Y-m-d H:i:s", strtotime("+5 minutes"));
            $update_lockout_query = "UPDATE customer SET lockout_until = ?, login_attempts = login_attempts + 1 WHERE user_name = ?";
            $stmt = $conn->prepare($update_lockout_query);
            $stmt->bind_param("ss", $lockout_time, $user_name);
            $stmt->execute();
            echo "<div id='lockoutMessage'>Too many failed attempts. Your account is locked for 5 minutes.</div>";
            echo "<div id='countdown'></div>"; // Add countdown div
            echo "<script>var remainingTime = 300;</script>"; // Set initial lockout duration in seconds
            exit;
        }

        // Verify password
        if (password_verify($password, $user_data['password'])) {
            // Verify 2FA code
            $secret = $user_data['two_fa_secret'];
            if ($gAuth->verifyCode($secret, $code)) {
                // Reset login attempts and lockout time on successful login
                $reset_attempts_query = "UPDATE customer SET login_attempts = 0, lockout_until = NULL WHERE user_name = ?";
                $stmt = $conn->prepare($reset_attempts_query);
                $stmt->bind_param("s", $user_name);
                $stmt->execute();

                // Store user details in session
                $_SESSION['user_id'] = $user_data['user_id'];
                $_SESSION['role'] = $user_data['role']; // Store user role in session

                // Redirect based on role
                if ($user_data['role'] === 'admin') {
                    header("Location: admin/users.php");  // Redirect admin to admin dashboard
                } else {
                    header("Location: index.php");  // Redirect non-admin users to homepage
                }
                die;
            } else {
                // Increment login attempts on failed 2FA code
                $update_attempts_query = "UPDATE customer SET login_attempts = login_attempts + 1 WHERE user_name = ?";
                $stmt = $conn->prepare($update_attempts_query);
                $stmt->bind_param("s", $user_name);
                $stmt->execute();
                echo "Invalid 2FA code.";
            }
        } else {
            // Increment login attempts on failed password
            $update_attempts_query = "UPDATE customer SET login_attempts = login_attempts + 1 WHERE user_name = ?";
            $stmt = $conn->prepare($update_attempts_query);
            $stmt->bind_param("s", $user_name);
            $stmt->execute();
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
                    <label class="form-check-label" for="showPassword">Show Password</label>
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
        <div id="countdown" class="text-center mt-3"></div> <!-- Add countdown div -->
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

        // Countdown Timer
        var countdownElement = document.getElementById('countdown');
        if (typeof remainingTime !== 'undefined' && remainingTime > 0) {
            countdownElement.textContent = `Please wait ${Math.ceil(remainingTime / 60)} minute(s) before trying again.`;

            const countdownInterval = setInterval(() => {
                remainingTime--;
                countdownElement.textContent = `Please wait ${Math.ceil(remainingTime / 60)} minute(s) before trying again.`;

                if (remainingTime <= 0) {
                    clearInterval(countdownInterval);
                    countdownElement.textContent = ""; // Clear countdown when time is up
                }
            }, 1000);
        }
    </script>
</body>
</html>
