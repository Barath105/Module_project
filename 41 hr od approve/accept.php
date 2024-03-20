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

// Database connection
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'adminhr';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user ID is provided in the query parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to fetch user details by ID
    $sql = "SELECT * FROM hrod WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $status = $row['status'];
        $update_query = "UPDATE hrod SET status = 'Approved' WHERE id = $id";
        $result = $conn->query($update_query);
        
        echo "<script>
        Swal.fire({
            title: 'success!',
            text: 'Approved Successfully',
            icon: 'Success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'i41.php';
        });
    </script>";

    
    } else {
        echo "<script>
        Swal.fire({
            title: 'Error!',
            text: 'User not found.',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'i41.php';
        });
    </script>";

    }
} 

$conn->close();
?>
</html>
</body>