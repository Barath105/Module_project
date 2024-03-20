<?php
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

// Query to count gender occurrences in the userinfo column
$sql = "SELECT gender, COUNT(*) as count FROM userinfo GROUP BY gender";
$result = $conn->query($sql);

// Prepare data for JSON response
$data = [
  'labels' => [],
  'values' => [],
  'colors' => ["#b91d47", "#00aba9"]
];

// Fetch data from the query result
while ($row = $result->fetch_assoc()) {
  $data['labels'][] = $row['gender'];
  $data['values'][] = $row['count'];
}

// Close the database connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
