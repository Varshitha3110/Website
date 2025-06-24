<?php
session_start();
$conn = new mysqli("localhost", "root", "", "techgesture");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // Redirect back to the page showing messages
        header("Location: admin-message.php"); // Correct redirect with Location:
        exit();
    } else {
        echo "Error deleting message.";
    }
} else {
    echo "Invalid request.";
}
?>
