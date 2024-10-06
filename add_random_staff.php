<?php
include 'connections.php'; // Include your database connection

// Function to generate random name
function generateRandomName() {
    $firstNames = ["John", "Jane", "Alice", "Bob", "Charlie", "Daisy", "Eve", "Frank", "Grace", "Hannah"];
    $lastNames = ["Smith", "Johnson", "Williams", "Jones", "Brown", "Davis", "Miller", "Wilson", "Moore", "Taylor"];
    
    return $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
}

// Function to generate random email
function generateRandomEmail($name) {
    $domains = ["example.com", "test.com", "demo.com"];
    $nameParts = explode(" ", strtolower($name));
    return implode(".", $nameParts) . "@" . $domains[array_rand($domains)];
}

// Function to generate random phone number
function generateRandomPhone() {
    $numbers = "0123456789";
    return "+254" . rand(700000000, 799999999); // Generate a random phone number starting with +254
}

// Number of random staff members to add
$numStaffToAdd = 10; // Adjust this number as needed

for ($i = 0; $i < $numStaffToAdd; $i++) {
    $name = generateRandomName();
    $email = generateRandomEmail($name);
    $phone = generateRandomPhone();
    $position = "Staff Member"; // Default position, you can modify this as needed

    // Prepare the SQL statement
    $sql = "INSERT INTO staff (name, email, phone, position) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $phone, $position);

    if ($stmt->execute()) {
        echo "Staff member added: Name: $name, Email: $email, Phone: $phone<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }
}

// Close the connection
$conn->close();
?>
