<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="approve.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Page</title>
  <style>
    header {
            background:linear-gradient(45deg, #a3acf8, #c9cef5);
            color: black;
            padding: 20px 0;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
    
        nav .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        
        nav ul {
            list-style: none;
            display: flex;
        }
        
        nav ul li {
            margin-right: 20px;
        }
        
        nav ul li a {
            text-decoration: none;
            color: black;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: blue;
        }

        img {
    max-width: 100%;
    width: 100px;
    height: auto;
    position: absolute;
    top: -10px;
    left: 40px;
}
.logo-1 {
    position: relative;
    
}

.logo-1 img {
    position: absolute; 
    top: 0; 
    left: 28%; 
    max-width: 100%; 
    width:600px;
    height: auto;
    opacity: 0.2;
    
} 
</style>
</head>
<body>
<header style="position: relative;top: 0px;width:100%;left: 0px;height: 78px">
        <nav style="position: relative;width: 1200px">
            <div class="logo" style="position: relative;top: 2px;left: 128px">
                
                <i class="fas fa-home"></i>Project status</div>
                
            <ul>
                <li><a href="../36 hr home/i36.php" style="position: relative;left: 110px;top:2px;">Home</a></li>
            </ul>
        </nav>
    </header>
    <img src="EMP.png">

    <div style="margin-top: 20px;"></div>

    <div class="logo-1">
    <img src="logo.png">
    </div>
    <?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['hrid'])) {
    header("Location: ../36 hr home/i36.php");
    exit();
}
$hrid = $_SESSION['hrid'];

$servername = "localhost";
$username = "root"; // Replace with your actual database username
$password = ""; // Replace with your actual database password
$database = "adminhr";

$connection = mysqli_connect($servername, $username, $password, $database);


    
$queryTotalRevenue = "SELECT SUM(totalcost) AS totalRevenue FROM hrproduct";
$resultTotalRevenue = mysqli_query($connection, $queryTotalRevenue);

if ($resultTotalRevenue === false) {
    die("Error in SQL query: " . mysqli_error($connection));
}

if (mysqli_num_rows($resultTotalRevenue) > 0) {
    $rowTotalRevenue = mysqli_fetch_assoc($resultTotalRevenue);
    $totalRevenue = $rowTotalRevenue['totalRevenue'];
} else {
    $totalRevenue = 0; // Default value if no records are found
}
?>


    

<div style="margin-top: 20px;"></div>
<div class="revenue"><strong>Total Revenue:<?php echo number_format($totalRevenue, 2); ?></strong></div>

<div style="margin-top: 20px;"></div>

<table id="data-table">
    <thead>
    <tr>
        <!-- Add this line in the table header -->


        <th>S.no</th>
        <th>Product id</th>
        <th>Advance Paid</th>
        <th>Amount Remaining</th>
        <th>Total Cost</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>

    
    <?php
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

// Establish a connection to the database
$conn = new mysqli("localhost", "root", "", "adminhr");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data with pagination
$sql = "SELECT * FROM hrproduct LIMIT $offset, $itemsPerPage";
$result = $conn->query($sql);

// Display data in the table
if ($result->num_rows > 0) {
    $serialNumber = $offset + 1; // Initialize serial number

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $serialNumber . "</td>"; // Display serial number
        echo "<td>" . $row["product_id"] . "</td>";
        echo "<td>" . $row["advance_paid"] . "</td>";
        echo "<td>" . $row["amount_remaining"] . "</td>";
        echo "<td style=\"color: green;\">" . $row["totalcost"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "</tr>";

        // Increment the serial number for the next row
        $serialNumber++;
    }
} else {
  echo "<tr><td colspan='11' style='text-align: center;'>No data found</td></tr>";

}

// Close the connection
$conn->close();
?>
    </tbody>
  </table>

  
  <script>
  function searchUser() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("data-table");
  tr = table.getElementsByTagName("tr");
  var noUsersMessage = document.getElementById("no-users-message");

  // Reset the message
  noUsersMessage.style.display = "none";

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3]; // Use index 2 for the "Email" column
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
  // Check if any rows are visible
  var visibleRows = Array.from(tr).filter(row => row.style.display !== "none");

  // Display "No users found" message if no matching rows are found
  if (visibleRows.length === 0) {
    noUsersMessage.style.display = "block";
    console.log("No client found");
  } else {
    console.log("Client found");
  }
}

</script>


</body>
</html>
