<?php
session_start(); // Start the session (if not already started)



// Include your database connection logic here
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
$user = $_SESSION['userid'];
// Get the logged-in user ID from the session
$logged_user_id = $user;

// Query to count "Present," "Absent," and "Late" values for the logged user
$sql = "SELECT 
            COUNT(CASE WHEN overall_att = 'present' THEN 1 END) AS present_count,
            COUNT(CASE WHEN overall_att = 'absent' THEN 1 END) AS absent_count,
            COUNT(CASE WHEN late = 'present' THEN 1 END) AS late_count
        FROM useratt
        WHERE userid = $logged_user_id";

$result = $conn->query($sql);

// Prepare data for JSON response
$data = [
    'labels' => [],
    'values' => [],
    'colors' => ["#30BEB6", "#FF7F74", "#FFCB67"]
];

// Fetch data from the query result
while ($row = $result->fetch_assoc()) {
$data['values'][] = $row['present_count'];
$data['values'][] = $row['absent_count'];
$data['values'][] = $row['late_count'];
}

// Close the database connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
