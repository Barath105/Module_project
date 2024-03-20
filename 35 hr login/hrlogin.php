<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <?php
session_start();
// Initialize the error message
$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $hrname = $_POST["hrid"];
    $password = $_POST["password"];

	$servername = "localhost";
    $db_username = "root";
    $db_password = "";
    // Change DB name 
    $dbname = "adminhr"; 
	
    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * from hrinfo where hrid = '$hrname' AND password = '$password'";  

    // Execute the query
    $result = $conn->query($sql);

    // Check if a user with the given credentials exists
    if ($result->num_rows == 1) {
        // User is authenticated, set session variable to indicate login
        $_SESSION["logged_in"] = true;
        $userInfo = $result->fetch_assoc();
        $_SESSION["hrid"] = $userInfo["hrid"];
        $_SESSION["hrname"] = $userInfo["hrname"];
        // Redirect to a protected page (e.g., home.php)
        echo "<script>
            Swal.fire({
                title: 'Login Successful!',
                text: 'Redirecting to home page...',
                icon: 'success',
                timer: 2000,  // time in milliseconds (2 seconds in this example)
                showConfirmButton: false
            }).then(function() {
                window.location.href = '../36 hr home/i36.php';
            });
        </script>";
        exit();
    } else {
        // Invalid credentials, set the error message
        $_SESSION["hrid"] = "Unknown";
        $_SESSION["hrname"] = "Unknown";
        $error_message = "Invalid username or password.";
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Invalid data, Please try again",
                text: "Please check your input",
                }).then(function() {
                    window.location.href = "../2 login hr emp/i2.php";
                });
            </script>';
    }

    // Close the database connection
    $conn->close();
}
?>

