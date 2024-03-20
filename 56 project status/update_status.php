<?php
// update_status.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the product ID from the POST data
    $productId = $_POST['productId'];

    // Perform the update in your database
    $conn = new mysqli("localhost", "root", "", "adminhr");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the "Amount Remaining" is 0
    $checkSql = "SELECT amount_remaining FROM hrproduct WHERE product_id = '$productId'";
    $result = $conn->query($checkSql);

    if ($result) {
        $row = $result->fetch_assoc();
        $amountRemaining = $row['amount_remaining'];

        if ($amountRemaining == 0) {
            // Update the status
            $updateSql = "UPDATE hrproduct SET status='Completed', current_status='Completed' WHERE product_id = '$productId'";

    
            if ($conn->query($updateSql) === TRUE) {
                echo 'success';
            } else {
                echo 'Error updating status: ' . $conn->error;
            }
        } else {
            echo 'Attention! Pending Amount. Cannot mark as complete.';
        }
    } else {
        echo 'Error checking amount remaining: ' . $conn->error;
    }

    $conn->close();
} else {
    echo 'Invalid request';
}
?>
