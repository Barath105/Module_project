<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add user</title>
    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

    


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input as needed
    $name = $_POST["name"];
    $userid = $_POST["userid"];
    $password = $_POST["password"];
    // $age = $_POST["age"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];
    $mail = $_POST["mail"];
    $contact = $_POST["phone"];
    $address = $_POST["address"];
    $role = $_POST["role"];
    $organization = $_POST["organization"];
    $salary = $_POST["salary"];
    $houserent = $_POST["house_rent"];  

    // Database connection
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'adminhr'; // Replace 'your_database_name' with your actual database name

// Create connection
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if userid already exists
    $checkSql = "SELECT * FROM userinfo WHERE userid = '$userid'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Error adding user: User ID already exists.',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'i52.html';
            });
        </script>";
    } else {
        // Prepare and execute the SQL statement to insert data into the userinfo table
        $sql = "INSERT INTO userinfo (username, userid, password, gender, dob, mail, phone, address, role, organization, basic_salary, house_rent) 
                VALUES ('$name', '$userid', '$password', '$gender', '$dob', '$mail', '$contact', '$address', '$role', '$organization','$salary','$houserent')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'User Added Successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'i52.html';
            });
        </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Error adding user',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
        }
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
            });
        </script>";
}
?>


</body>
</html>