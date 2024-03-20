<?php
// rolecount.php

$servername = "localhost";
$username = "root"; // Replace with your actual database username
$password = ""; // Replace with your actual database password
$database = "adminhr";

$connection = mysqli_connect($servername, $username, $password, $database);

// Check for connection error
if (!$connection) {
    die("Error in DB connection: " . mysqli_connect_errno() . " : " . mysqli_connect_error());
}

// Fetch distinct roles from the database
$queryDistinctRoles = "SELECT DISTINCT role FROM userinfo";
$resultDistinctRoles = mysqli_query($connection, $queryDistinctRoles);

if ($resultDistinctRoles === false) {
    die("Error in SQL query: " . mysqli_error($connection));
}

// Initialize counts array with default values of 0
$roleCounts = [];

while ($row = mysqli_fetch_assoc($resultDistinctRoles)) {
    $role = $row['role'];
    $queryRoleCount = "SELECT COUNT(*) as count FROM userinfo WHERE role = '$role'";
    $resultRoleCount = mysqli_query($connection, $queryRoleCount);

    if ($resultRoleCount === false) {
        die("Error in SQL query: " . mysqli_error($connection));
    }

    $count = mysqli_fetch_assoc($resultRoleCount)['count'];
    $roleCounts[$role] = $count;
}

header('Content-Type: application/json');
echo json_encode(array_values($roleCounts)); // Convert associative array to indexed array

mysqli_close($connection);
?>
