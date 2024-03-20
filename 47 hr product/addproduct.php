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
$mysqli = new mysqli("localhost", "root", "", "adminhr");

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve form data
$fullName = $_POST['name'];
$dateOfBirth = $_POST['dob'];
$email = $_POST['mail'];
$mobileNumber = $_POST['number'];
$gender = isset($_POST['gender']) ? $_POST['gender'] : null;
$address = $_POST['address'];
$projectName = $_POST['projectName'];
$projectId = $_POST['projectId'];
$totalCost = $_POST['totalCost'];
$advancePaid = $_POST['advancePaid'];
$remamount = $_POST['remamount'];
$startDate = $_POST['startDate'];
$dueDate = isset($_POST['dueDate']) ? $_POST['dueDate'] : null;

// Check if 'gender' is null
if ($gender === null) {
    die("Gender cannot be null");
}

// Perform database insertion
$sql = "INSERT INTO hrproduct (client_name, dob, client_mail, client_contact, gender, address, product_name, product_id, totalCost, advance_paid, amount_remaining, startDate, endDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('sssssssssssss', $fullName, $dateOfBirth, $email, $mobileNumber, $gender, $address, $projectName, $projectId, $totalCost, $advancePaid, $remamount, $startDate, $dueDate);

// Execute the statement
if ($stmt->execute()) {
    // Display a JavaScript alert
    echo "<script>
    Swal.fire({
        title: 'success!',
        text: 'Data stored successfully',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'i47.html';
    });
</script>";
    // Delay the redirect for a few seconds
    echo '<meta http-equiv="refresh" content="3;url=i47.html">';
} else {

    echo "<script>
    Swal.fire({
        title: 'Error!',
        text: 'Error adding product',
        icon: 'error',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'i47.html';
    });
</script>";
}

// Close the statement
$stmt->close();

// Close the database connection
$mysqli->close();
?>
</html>
</body>
