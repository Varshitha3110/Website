<?php
// forgot_password.php

$host = "localhost";
$dbname = "techgesture";
$username = "root";
$password = ""; // Change this to your actual DB password

$conn = new mysqli($host, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['reset'])) {
    $email = trim($_POST['email']);
    $newPassword = $_POST['new_password'];
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Check if email exists
    $checkQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        // Update the password
        $updateQuery = "UPDATE users SET password = ? WHERE email = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ss", $hashedPassword, $email);
        if ($updateStmt->execute()) {
            echo "<script>alert('Password updated successfully!'); window.location.href='index.html';</script>";
        } else {
            echo "<script>alert('Failed to update password.');</script>";
        }
    } else {
        echo "<script>alert('Email not found. Please register first.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
