<?php
$userid = $_POST['userid'];

// Establish a connection to the database
$conn = new mysqli("localhost", "root", "", "adminhr");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the new_password from hrpassword for the specified user ID
$fetchSql = "SELECT new_password FROM hrpassword WHERE userid = $userid";
$result = $conn->query($fetchSql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $newPassword = $row['new_password'];

    // Update the password in the userinfo table
    $updateUserSql = "UPDATE userinfo SET password = '$newPassword' WHERE userid = $userid";
    $updateStatusSql = "UPDATE hrpassword SET status = 'Completed' WHERE userid = $userid";

    // Use a transaction to ensure both updates succeed or fail together
    $conn->begin_transaction();

    try {
        // Update password in the userinfo table
        $conn->query($updateUserSql);

        // Update status in the hrpassword table
        $conn->query($updateStatusSql);

        // Commit the transaction
        $conn->commit();

        echo json_encode(['success' => true, 'newPassword' => $newPassword]);
    } catch (Exception $e) {
        // Rollback the transaction in case of any error
        $conn->rollback();

        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No new_password found for the specified user ID.']);
}

// Close the connection
$conn->close();
?>
