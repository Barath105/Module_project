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

$conn = mysqli_connect("localhost", "root", "", "adminhr");

// Check if userid is set and is a valid number
if (isset($_GET['userid']) && is_numeric($_GET['userid'])) {
    $userid = $_GET['userid'];

    // Construct the SQL DELETE statement
    $sql = "DELETE FROM userinfo WHERE userid = $userid";

    // Execute the SQL statement
    $result = mysqli_query($conn, $sql);

    // Check if the deletion was successful
    if ($result) {
        // User terminated successfully, show success message
        echo "<script>
                Swal.fire({
                    title: 'Success',
                    text: 'User terminated successfully.',
                    icon: 'success'
                }).then(() => {
                    // Redirect to a different page after deletion
                    window.location.href = 'i51.php';
                });
            </script>";
    } else {
        // Error executing the statement
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Error terminating user. Please try again later.',
                    icon: 'error'
                });
            </script>";
    }
} else {
    // Invalid user ID, show error message
    echo '<div style="background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;">
        Invalid user ID. Please provide a valid user ID. Redirecting...
    </div>';
    // Redirect to a different page (optional)
    header("Refresh: 2; URL=i51.php");
}

// Close the database connection
mysqli_close($conn);
?>
</body>
</html>
