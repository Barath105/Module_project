<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="approve.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Page</title>
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

    .pagination {
  position: fixed;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  margin-bottom:10px;
}

.pagination a {
  padding: 8px 16px;
  text-decoration: none;
  background-color: #f2f2f2;
  color: #333;
  border: 1px solid #ddd;
  margin: 0 4px;
  border-radius: 20px; /* You can adjust the value to control the oval shape */
}

.pagination a:hover {
  background-color: #ddd;
}


    .pagination a.active {
      background-color: #4CAF50;
      color: white;
    }
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
</head>
<body>
<header style="position: relative;top: 0px;width:100%;left: 0px;height: 78px">
        <nav style="position: relative;width: 1200px">
            <div class="logo" style="position: relative;top: 2px;left: 128px">
                
                <i class="fas fa-home"></i>Total client</div>
                
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

  <!-- Search Box -->
  <label style="margin:0 20px;" for="search">Search by client mail:</label>
<input type="text" id="search" placeholder="Enter mail">
<button onclick="searchUser()">Search</button>
<div id="no-users-message" style="display: none; margin-top: 10px;">No client found.</div>


  <div style="margin-top: 20px;"></div>

  <table id="data-table">
    <thead>
      <tr>
        <!-- Add this line in the table header -->


        <th>S.no</th>
        <th>Client Name</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Project</th>
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
        echo "<td>" . $row["client_name"] . "</td>";
        echo "<td>" . $row["gender"] . "</td>";
        echo "<td>" . $row["client_mail"] . "</td>";
        echo "<td>" . $row["client_contact"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["product_name"] . "</td>";
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
