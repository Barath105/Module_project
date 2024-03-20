<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    
</body>
</html><?php
session_start(); // Start the session

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminhr";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cpassword = $_POST["cpassword"];
$npassword = $_POST["npassword"];
$rpassword = $_POST["rpassword"];

// Check if the input username matches the logged-in user's information
if (isset($_SESSION['username'])) {
    $loggedUsername = $_SESSION['username'];

    // Check the current password with the database
    $checkSQL = "SELECT password FROM userinfo WHERE username = ?";
    $stmt = $conn->prepare($checkSQL);
    $stmt->bind_param("s", $loggedUsername);
    $stmt->execute();
    $stmt->bind_result($dbPassword);
    $stmt->fetch();
    $stmt->close();

    if ($cpassword === $dbPassword) {
        // Current password is correct, proceed to update the password
        if ($npassword === $rpassword) {
            // Update the password in the userinfo table
            $updateSQL = "UPDATE userinfo SET password = ? WHERE username = ?";
            $stmt = $conn->prepare($updateSQL);
            $stmt->bind_param("ss", $npassword, $loggedUsername);
            if ($stmt->execute()) {
                echo "<script>
            Swal.fire({
                title: 'Password Changed Successfully!',
                text: 'Redirecting...',
                icon: 'success',
                timer: 2000,  // time in milliseconds (2 seconds in this example)
                showConfirmButton: false
            }).then(function() {
                window.location.href = '../4 emp home/i4.php';
            });
        </script>";
            } else {
                echo "Error updating password: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "New password and re-entered password do not match.";
        }
    } else {
        echo "Current password is incorrect.";
    }
} else {
    echo "User is not logged in. Please log in to change your password.";
}

// Close the database connection
$conn->close();
?>
</body>
</html>