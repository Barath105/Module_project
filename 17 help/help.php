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

// Retrieve form data
$name = $_POST["name"];
$email = $_POST["email"];
$issue = $_POST["issue"];
$username = $_POST["name"]; // Retrieve the "username" value from the form data

// Sanitize and validate the data (you may need more thorough validation)
$name = mysqli_real_escape_string($conn, $name);
$email = mysqli_real_escape_string($conn, $email);
$issue = mysqli_real_escape_string($conn, $issue);
$username = mysqli_real_escape_string($conn, $username);

// File upload handling
$targetDirectory = "uploads/"; // Specify the directory where you want to store uploaded files
$targetFile = $targetDirectory . basename($_FILES["pdf"]["name"]);

// Allow specific file types (PDF, JPG, and PNG)
$allowedExtensions = array("pdf", "jpg", "png");
$fileExtension = pathinfo($targetFile, PATHINFO_EXTENSION);

// Check file size (you can adjust this limit)
if ($_FILES["pdf"]["size"] > 5000000) { // Adjust the size limit as needed
    echo "File is too large.";
} elseif (!in_array(strtolower($fileExtension), $allowedExtensions)) {
    echo "Invalid file type. Only PDF, JPG, and PNG files are allowed.";
} else {
    // File upload handling
    if (move_uploaded_file($_FILES["pdf"]["tmp_name"], $targetFile)) {
        echo "";

        // Insert data and file details into the admin table
        $sql = "INSERT INTO admin (username, mail, issue, file_name, file_data) VALUES ('$username', '$email', '$issue', '" . basename($_FILES["pdf"]["name"]) . "', '$targetFile')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
            Swal.fire({
                title: 'Request Successfull!',
                text: 'Redirecting...',
                icon: 'success',
                timer: 2000,  // time in milliseconds (2 seconds in this example)
                showConfirmButton: false
            }).then(function() {
                window.location.href = '../4 emp home/i4.php';
            });
        </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "File upload failed.";
    }
}

// Close the database connection
$conn->close();
?>
</body>
</html>
