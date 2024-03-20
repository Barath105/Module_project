<?php
// update_amount_remaining.php

// Establish a connection to the database
$conn = new mysqli("localhost", "root", "", "adminhr");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the AJAX request
$productId = $_POST['productId'];
$updatedValue = $_POST['updatedValue'];

// Update the value in the hrproduct table
$sql = "UPDATE hrproduct SET amount_remaining = ? WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $updatedValue, $productId);
$stmt->execute();
$stmt->close();

// Close the connection
$conn->close();

echo "Update successful";
?>
