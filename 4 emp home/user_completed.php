<?php
// Establish connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminhr";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the userid is set in the URL parameter
if(isset($_GET['id'])) {
    // Sanitize input to prevent SQL injection
    $userid = $conn->real_escape_string($_GET['id']);
    
    // Update the product_status_1 column for the given userid
    $sql = "UPDATE userinfo SET product_status_1 = 'Completed' WHERE userid = '$userid'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Status Updated Successfully.'); window.location.href = 'i4.php';</script>";
    } else {
        echo "Error updating status: " . $conn->error;
    }
} else {
    echo "User ID not provided.";
}

// Close the database connection
$conn->close();
?>
