<?php
// Replace with your actual database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminhr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user ID from the query string
$userId = isset($_GET['userid']) ? $_GET['userid'] : null;

// Check if the user ID is provided
if ($userId === null) {
    die(json_encode(['valid' => false, 'error' => 'User ID not provided']));
}

// Perform validation against the userinfo table
$sql = "SELECT * FROM userinfo WHERE userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Return JSON response indicating whether the user ID is valid
header('Content-Type: application/json');

if ($row) {
    echo json_encode(['valid' => true, 'userDetails' => $row]);
} else {
    echo json_encode(['valid' => false]);
}

$stmt->close();
$conn->close();
?>
