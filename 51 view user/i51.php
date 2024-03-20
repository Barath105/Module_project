<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="approve.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Page</title>
  <style>
    header {
            background: linear-gradient(45deg, #a3acf8, #c9cef5);
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
<header style="position: relative;top:0%;width: 100%;left: 0%;height: 75px;">
        <nav style="position: relative;width: 1200px">
            <div class="logo"style="position: relative;top: 2px;left:122px">
                <i class=""></i> Employee data</div>
            <ul>
                <li><a href="../36 hr home/i36.php"style="position: relative;left: 136px;top:0px">Home</a></li>
            </ul>
        </nav>
    </header>
    <img src="EMP.png">
        


    <div class="logo-1">
    <img src="logo.png">
    </div>

    <div style="margin-top: 20px;"></div>

  <!-- Search Box -->
  <label style=" margin:0 20px;" for="search">Search by User ID:</label>
  <input type="text" id="search" placeholder="Enter User ID">
  <button onclick="searchUser()">Search</button>
  <div id="no-users-message" style="display: none; margin-top: 10px;">No users found.</div>



  <table id="data-table">
    <thead>
      <tr>
        <!-- Add this line in the table header -->


        <th>S.no</th>
        <th>Name</th>
        <th>User ID</th>
        <th>Gender</th>
        <th>Email</th>
        <th>DOB</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Role</th>
        <th>Organization</th>
        <th>Update</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
$itemsPerPage = 15;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

// Establish a connection to the database
$conn = new mysqli("localhost", "root", "", "adminhr");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data with pagination
$sql = "SELECT * FROM userinfo LIMIT $offset, $itemsPerPage";
$result = $conn->query($sql);

// Display data in the table
if ($result->num_rows > 0) {
    $serialNumber = $offset + 1; // Initialize serial number

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $serialNumber . "</td>"; // Display serial number
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["userid"] . "</td>";
        echo "<td>" . $row["gender"] . "</td>";
        echo "<td>" . $row["mail"] . "</td>";
        echo "<td>" . $row["DOB"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["role"] . "</td>";
        echo "<td>" . $row["organization"] . "</td>";
        echo "<td><a href='edit.php?userid=" . $row["userid"] . "' style='text-decoration: none;'>Edit</a></td>";

        echo "<td><a href='terminate.php?userid=" . $row["userid"] . "' style='text-decoration: none;color:red'>Terminate</a></td>"; // Edit button
        echo "</tr>";

        // Increment the serial number for the next row
        $serialNumber++;
    }
} else {
    echo "<tr><td colspan='11'>No users found</td></tr>";
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
    td = tr[i].getElementsByTagName("td")[2]; // Use index 2 for User ID column
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
    console.log("No users found");
  } else {
    console.log("Users found");
  }
}

</script>


</body>
</html>
