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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input as needed
    $userId = $_POST["userid"];
    $newUsername = $_POST["username"];
    $newAge = $_POST["age"];
    $newGender = $_POST["gender"];
    $newMail = $_POST["mail"];
    $newDOB = $_POST["dob"];
    $newPhone = $_POST["phone"];
    $newAddress = $_POST["address"];
    $newRole = $_POST["role"];
    $newOrganization = $_POST["organization"];

    // Establish a connection to the database
    $conn = new mysqli("localhost", "root", "", "adminhr");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update user data
    $sql = "UPDATE userinfo SET 
            username='$newUsername',
            age='$newAge',
            gender='$newGender',
            mail='$newMail',
            DOB='$newDOB',
            phone='$newPhone',
            address='$newAddress',
            role='$newRole',
            organization='$newOrganization'
            WHERE userid=$userId";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'User data updated successfully',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'i51.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Error updating user data',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'i51.php';
            });
        </script>";
    }

    // Close the connection
    $conn->close();
} else {

    echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Invalid request',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'i51.php';
            });
        </script>";
}
?>

</body>
</head>