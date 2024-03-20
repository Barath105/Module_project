<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <?php
// Database connection parameters
$hostname = "localhost"; // Change to your database server hostname
$userid = "root"; // Change to your database username
$password = ""; // Change to your database password
$database = "adminhr"; // Change to your database name

// Create a connection to the database using the defined variables
$mysqli = new mysqli($hostname, $userid, $password, $database);

// Check if the connection was successful
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Initialize variables to store form data
$userid = $newPassword = $reenterPassword = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userid = $_POST["user_id"];
    $newPassword = $_POST["new_password"];
    $reenterPassword = $_POST["reenter_password"];

    // Perform validation
    if (empty($userid) || empty($newPassword) || empty($reenterPassword)) {
        echo "All fields are required. Please fill out the form completely.";
    } elseif ($newPassword !== $reenterPassword) {
        echo "New Password and Re-enter Password do not match. Please try again.";
    } else {
        // Check if the user exists in the userinfo table
        $checkQuery = "SELECT userid FROM userinfo WHERE userid = ?";
        $checkStmt = $mysqli->prepare($checkQuery);
        $checkStmt->bind_param("s", $userid);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            // User exists, insert a request into the hrpass table
            $insertQuery = "INSERT INTO hrpassword (userid, new_password,reenter_password) VALUES (?, ?,?)";
            $insertStmt = $mysqli->prepare($insertQuery);
            $insertStmt->bind_param("sss", $userid, $newPassword, $reenterPassword);
            
            if ($insertStmt->execute()) {

                echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Password change request sent successful',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'i5.php';
            });
        </script>";
            } else {

                echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Error sending password change request',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'i5.php';
            });
        </script>";
            }

            $insertStmt->close();
        } else {

            echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'User not found. Please check the User ID',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'i5.php';
            });
        </script>";
        }

        $checkStmt->close();
    }
}

// Close the database connection when you're done
$mysqli->close();
?>
