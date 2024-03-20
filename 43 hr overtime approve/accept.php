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
    $update_query = "UPDATE hrovertime SET status = 'Approved' WHERE id = $id";
    $result = $conn->query($update_query);

    if ($result) {
        echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Approved Successfully',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'i43.php';
            });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Error!',
            text: 'Error updating status',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'i43.php';
        });
    </script>";
    }
}  else {
    echo "<script>
    Swal.fire({
        title: 'Error!',
        text: 'User not found',
        icon: 'error',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'i43.php';
    });
</script>";
    }


$conn->close();
?>
</html>
</body>