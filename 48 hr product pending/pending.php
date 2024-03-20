<?php
// Example PHP code to retrieve product information from the database

$conn = new mysqli("localhost", "root", "", "adminhr");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `product_id`, `client_name`, `client_contact`, `totalcost`, `advance_paid`,'amount_remaining' FROM `hrproduct`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='item'>";
        echo "<p>Product Name: " . $row["product_name"] . "</p>";
        echo "<p>Product ID: " . $row["product_id"] . "</p>";
        echo "<p><strong>Client:</strong> " . $row["client_name"] . "</p>";
        echo "<p><strong>Contact:</strong> " . $row["client_contact"] . "</p>";
        echo "<p><strong>Total Amount:</strong> $" . $row["totalcost"] . "</p>";
        echo "<p><strong>Advanced Paid:</strong> $" . $row["advance_paid"] . "</p>";
        echo "<p><strong>Pending Amount</strong> $" . $row["amount_pending"] . "</p>";
        echo "<button type='submit' style='position: relative;left: 0px;top: 10px;'>View Status</button>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
