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
if (isset($_SESSION['hrname'])) {
    $loggedUsername = $_SESSION['hrname'];

    // Check the current password with the database
    $checkSQL = "SELECT password FROM hrinfo WHERE hrname = ?";
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
            $updateSQL = "UPDATE hrinfo SET password = ? WHERE hrname = ?";
            $stmt = $conn->prepare($updateSQL);
            $stmt->bind_param("ss", $npassword, $loggedUsername);
            if ($stmt->execute()) {
                echo "<script>
        Swal.fire({
            title: 'Success!',
            text: 'Password updated successfully!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'i45.html';
        });
    </script>";

            } else {
                echo "<script>
        Swal.fire({
            title: 'Error!',
            text: 'Error updating password',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'i45.html';
        });
    </script>";


            }
            $stmt->close();
        } else {

            echo "<script>
        Swal.fire({
            title: 'Error!',
            text: 'New password and re-entered password do not match.',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'i45.html';
        });
    </script>";
        }
    } else {
        echo "<script>
        Swal.fire({
            title: 'Error!',
            text: 'Current password is incorrect.',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'i45.html';
        });
    </script>";
    }
} else {

    echo "<script>
        Swal.fire({
            title: 'Error!',
            text: 'User is not logged in. Please log in to change your password.',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'i45.html';
        });
    </script>";


}

// Close the database connection
$conn->close();
?>

</html>
</body>
