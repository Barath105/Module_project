<?php

// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminhr";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID and task ID from the request parameters
$userId = $_GET['userid'];
$projectId = $_GET['projectId'];


// Check if the user already has a product_id
$sqlCheck = "SELECT * FROM userinfo WHERE userid = '$userId'";
$resultCheck = $conn->query($sqlCheck);

if ($resultCheck->num_rows > 0) {
    // User already has a product_id, find the first available column to store the data
    $columnIndex = 1;

    while ($row = $resultCheck->fetch_assoc()) {
        while (isset($row["product_id_$columnIndex"])) {
            $columnIndex++;
        }
    }

    // Create a new column product_id_$columnIndex and store the data
    $newColumn = "product_id_" . $columnIndex;
$newColumn1 = "product_status_" . $columnIndex;

// Check if the new column already exists for product_id
$sqlCheckColumn = "SHOW COLUMNS FROM userinfo LIKE '$newColumn'";
$resultCheckColumn = $conn->query($sqlCheckColumn);

if ($resultCheckColumn->num_rows == 0) {
    // New column doesn't exist, so add it to the table for product_id
    $alterTableQuery = "ALTER TABLE userinfo ADD COLUMN $newColumn INT";
    $conn->query($alterTableQuery);
}

// Check if the new column already exists for product_status
$sqlCheckColumn1 = "SHOW COLUMNS FROM userinfo LIKE '$newColumn1'";
$resultCheckColumn1 = $conn->query($sqlCheckColumn1);

if ($resultCheckColumn1->num_rows == 0) {
    // New column doesn't exist, so add it to the table for product_status
    $alterTableQuery1 = "ALTER TABLE userinfo ADD COLUMN $newColumn1 VARCHAR(255) DEFAULT 'Pending'";
    $conn->query($alterTableQuery1);
}


    // Update the new column with the project ID
    $sqlUpdate = "UPDATE userinfo SET $newColumn = '$projectId' WHERE userid = '$userId'";

    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Project ID stored successfully for the user in $newColumn";
    } else {
        echo "Error: " . $sqlUpdate . "<br>" . $conn->error;
    }
} else {
    // User does not have a product_id, create a new column and store the data
    $sqlUpdate = "UPDATE userinfo SET product_id = '$projectId' WHERE userid = '$userId'";

    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Project ID stored successfully for the user";
    } else {
        echo "Error: " . $sqlUpdate . "<br>" . $conn->error;
    }
}

$conn->close();

?>
