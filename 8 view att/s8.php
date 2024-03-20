<?php
session_start();
// Connect to your database (replace these with your database credentials)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'adminhr';

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);
$uid= $_SESSION["userid"];
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the attendance data for the specified date (replace with your actual SQL query)
$attendance_date = $_GET['attendance_date'];
$sql = "SELECT att1, att2,overall_att FROM useratt WHERE attendance_date = '$attendance_date' AND userid='$uid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(array("att1" => "", "att2" => "", "overall_att" => ""));
}

$conn->close();
?>
