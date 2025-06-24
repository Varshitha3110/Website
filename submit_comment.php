<?php
$servername = "localhost";
$username = "root";
$password = ""; // your password
$dbname = "techgesture"; // your database

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$comment = $_POST['comment'] ?? '';

if ($name && $email && $comment) {
    $stmt = $conn->prepare("INSERT INTO comments (name, email, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $comment);

    if ($stmt->execute()) {
        echo "Comment posted successfully!";
    } else {
        echo "Failed to post comment.";
    }

    $stmt->close();
} else {
    echo "Please fill all fields.";
}

$conn->close();
?>
