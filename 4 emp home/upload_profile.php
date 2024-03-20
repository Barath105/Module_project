<?php
session_start();

if (!isset($_SESSION['userid'])) {
    // Handle the case where the user is not logged in
    header("Location: ../4 emp home/i4.php");
    exit();
}

$userid = $_SESSION['userid'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_picture"])) {
    $targetDir = "uploads/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = uniqid() . "_" . basename($_FILES["profile_picture"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    // Check if the file is an image
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    if (getimagesize($_FILES["profile_picture"]["tmp_name"])) {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFilePath)) {
            // File upload successful, update the database with the file path
            $servername = "localhost";
            $username = "root"; // Replace with your actual database username
            $password = ""; // Replace with your actual database password
            $database = "adminhr";

            $connection = mysqli_connect($servername, $username, $password, $database);

            if (!$connection) {
                die("Error in DB connection: " . mysqli_connect_errno() . " : " . mysqli_connect_error());
            }

            // Update the profile picture path in the hrinfo table
            // ...

// Update the profile picture path in the hrinfo table
$query = "UPDATE userinfo SET profile_pic = '$targetFilePath' WHERE userid = '$userid'";
$result = mysqli_query($connection, $query);

// Update the session variable with the new profile picture path
$_SESSION['profile_pic'] = $targetFilePath;

// Close the database connection
mysqli_close($connection);

// Redirect or display success message
header("Location: i4.php");
exit();

// ...

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}
?>
