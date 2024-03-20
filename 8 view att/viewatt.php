<?php
// Connect to your database (you need to replace these placeholders)
session_start();

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'adminhr';

// Parse the date parameter from the request (ensure to validate and sanitize it)
$date = $_GET['attendance_date']; // Assuming the date is sent as a GET parameter
$uid = $_SESSION["userid"];
// Create a database connection
$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Perform a database query to retrieve data for the given date
$query = "SELECT att1, att2, overall_att FROM useratt WHERE attendance_date = ? AND userid = ?";

// Prepare the statement
$stmt = $connection->prepare($query);

if ($stmt) {
    // Bind the date parameter and execute the query
    $stmt->bind_param("ss", $date, $uid);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Close the statement
    $stmt->close();

    // Close the database connection
    $connection->close();

    if ($row) {
        // Data found for the given date, return it as JSON
        header("Content-Type: application/json");
        echo json_encode($row);
    } else {
        // No data found, return default values as JSON
        $defaultValues = [
            "att1" => null,
            "att2" => null,
            "overall_att" => null
        ];
        header("Content-Type: application/json");
        echo json_encode($defaultValues);
    }
} else {
    echo "Error in database query";
}

?>
