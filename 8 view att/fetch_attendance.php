<?php

// Connect to your database (replace these values with your actual database credentials)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'adminhr';

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the useratt table
$sql = "SELECT attendance_date, overall_att FROM useratt";
$result = $conn->query($sql);

$dataStatus = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $attendanceDate = $row['attendance_date'];
        $overallAtt = $row['overall_att'];

        // Add the data to the dataStatus object
        $dataStatus[$attendanceDate] = $overallAtt;
    }
}

// Close the database connection
$conn->close();

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode($dataStatus);
?>
