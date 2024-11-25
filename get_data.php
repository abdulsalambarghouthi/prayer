<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "prayer_tracker";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch prayer progress
$query = "SELECT prayer_type, COUNT(*) as count FROM prayer_logs WHERE status = 'completed' GROUP BY prayer_type";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>
