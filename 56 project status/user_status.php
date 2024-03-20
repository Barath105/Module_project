<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


  <title>Project's</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align:center;
    }

    th {
      background-color: #f2f2f2;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    input[type="text"] {
      padding: 5px;
    }

    header {
            background-color: #a3acf8;
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
            color: #f7ce68;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
</style>
<style>
  input.no-border {
    border: none;
    outline: none;
  }
</style>

</head>
<body>
<header style="position: relative;height: 28px;top: -8px;width: 1366px;left: -8px;">
        <nav>
            <div class="logo" style="position: relative;top: -9px;left: 8px">
                <i class="fas fa-home"></i> Project Status
            </div>
            <ul>
                <li><a href="../36 hr home/i36.php" style="position: relative;top: -9px;left:16px;">Home</a></li>
            </ul>
        </nav>
    </header>


  <div style="margin-top: 20px;"></div>

  <table id="data-table">
    <thead>
      <tr>
        <!-- Add this line in the table header -->
        <th>S.no</th>
        <th>Employee Name</th>
        <th>Employee ID</th>
        <th>Project ID</th> 
        <th>Status</th>
    </tr>
    </thead>
    <tbody>



    <?php
$currentPage = $_GET['id'];
$product_id = (int)$_GET['pro_id'];

// Establish a connection to the database
$conn = new mysqli("localhost", "root", "", "adminhr");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data with pagination
$sql = "SELECT * FROM userinfo WHERE product_id_1 = $product_id  ";
$result = $conn->query($sql);

// Display data in the table
if ($result->num_rows > 0) {
    $serialNumber = 1; // Initialize serial number

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $serialNumber . "</td>"; // Display serial number
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["userid"] . "</td>";
        echo "<td>" . $row["product_id_1"] . "</td>";
        
        if ($row["product_status_1"] == "Completed") {
          echo "<td style='color: green;'>" . $row["product_status_1"] . "</td>";
      } elseif ($row["product_status_1"] == "Pending") {
          echo "<td style='color: red;'>" . $row["product_status_1"] . "</td>";
      } else {
          echo "<td>" . $row["product_status_1"] . "</td>";
      }
      

        
        echo "</tr>";
    
        // Increment the serial number for the next row
        $serialNumber++;
    }
    
} else {
    echo "<tr><td colspan='5'>No data found</td></tr>";
}

// Close the connection
$conn->close();
?>



    </tbody>
  </table>


</body>
</html>
