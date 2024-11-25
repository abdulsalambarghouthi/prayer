<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "prayer_tracker";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Save prayer log
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prayer_type = $_POST['prayer_type'];
    $prayer_date = $_POST['prayer_date'];
    $status = $_POST['status'];
    $user_id = 1; // Static for now, replace with session-based user ID

    $stmt = $conn->prepare("INSERT INTO prayer_logs (prayer_type, prayer_date, status, user_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $prayer_type, $prayer_date, $status, $user_id);
    $stmt->execute();
    $stmt->close();

    echo "Prayer log saved successfully!";
}

$conn->close();
?>
