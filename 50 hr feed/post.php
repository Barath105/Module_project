<?php
// Database connection details
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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];

    // File handling
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_destination = "uploads/" . $file_name; // Change "uploads/" to your desired destination folder

    // Move the uploaded file to the destination folder
    if (move_uploaded_file($file_tmp, $file_destination)) {
        // Use prepared statement to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO hrfeed (feeds, pdf, pdf_name) VALUES (?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("sss", $message, $file_destination, $file_name);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Data Stored Successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error uploading file";
    }
}

// Close the database connection
$conn->close();
?>
