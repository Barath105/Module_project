<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="approve.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


  <title>Project</title>
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

        button.mark-as-complete {
    background-color: #4CAF50; /* Green background color */
    color: white; /* White text color */
    padding: 8px 12px; /* Padding around the button text */
    border: none; /* No border */
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Cursor on hover */
}

button.mark-as-complete:hover {
    background-color: #45a049; /* Darker green background color on hover */
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
<style>
  input.no-border {
    border: none;
    outline: none;
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
  <!-- Search Box -->
  <label style="margin:0 20px;" for="search">Search by product id:</label>
<input type="text" id="search" placeholder="Enter Product id">
<button onclick="searchUser()">Search</button>
<div id="no-users-message" style="display: none; margin-top: 10px;">No product found.</div>


  <div style="margin-top: 20px;"></div>

  <table id="data-table">
    <thead>
      <tr>
        <!-- Add this line in the table header -->


        <th>S.no</th>
        <th>Client Name</th>
        <th>Project ID</th>
        <th>Project Name</th>
        <th>Current Status</th> 
        <th>Total Cost</th>
        <th>Amount Paid</th>
        <th>Remaining Amount</th>
        <th>Start Date</th>
        <th>Due Date</th>
        <th>Check Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php

// Establish a connection to the database
$conn = new mysqli("localhost", "root", "", "adminhr");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data with pagination
$sql = "SELECT * FROM hrproduct WHERE status = 'Pending'";
$result = $conn->query($sql);

// Display data in the table
if ($result->num_rows > 0) {
    $serialNumber = 1; // Initialize serial number

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $serialNumber . "</td>"; // Display serial number
        echo "<td>" . $row["client_name"] . "</td>";
        echo "<td>" . $row["product_id"] . "</td>";
        echo "<td>" . $row["product_name"] . "</td>";
        echo "<td>";
        if ($row["current_status"] === "Active") {
            $dotSize = '16px'; // Adjust the size of the green dot
            $dotColor = 'green'; // Adjust the color of the green dot
            echo "<span style='color: $dotColor; font-size: $dotSize;'>&#8226;</span> ";
        }
        echo $row["current_status"];
        echo "</td>";
        echo "<td>" . $row["totalcost"] . "</td>";
        echo "<td>" . $row["advance_paid"] . "</td>";
        echo "<td><input type='text' name='amount_remaining[]' value='" . $row["amount_remaining"] . "' data-product-id='" . $row["product_id"] . "' class='editable-field' style='border: none; outline: none;background-color:#f2f2f2;font-size:17px;'></td>";


        echo "<td>" . $row["startDate"] . "</td>";
        echo "<td>" . $row["endDate"] . "</td>";
      
        echo '<td><a href="user_status.php?id='. $row['id'] .'&pro_id='.$row['product_id'].'" style=text-decoration:none;color:green;height:30px; cursor: pointer;\">
              
              View Status
              </a>
              </td>';

        
        
        // Display a button for each row to mark as complete
        echo "<td><button class=\"mark-as-complete\" data-product-id=\"" . $row["product_id"] . "\">Mark as Complete</button></td>";


        
        echo "</tr>";
    
        // Increment the serial number for the next row
        $serialNumber++;
    }
    
} else {
  echo "<tr><td colspan='12' style='text-align: center;'>No data found</td></tr>";

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
        td = tr[i].getElementsByTagName("td")[2]; // Use index 2 for the "Email" column
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Add an event listener for each editable field
    var editableFields = document.querySelectorAll('.editable-field');

    editableFields.forEach(function (field) {
      field.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
          // Prevent the default Enter key behavior (e.g., form submission)
          event.preventDefault();

          // Get the updated value and product ID
          var updatedValue = field.value;
          var productId = field.getAttribute('data-product-id');

          // Perform AJAX request to update the value in the database
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'update_remamount.php', true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

          // Define the data to be sent
          var data = 'productId=' + encodeURIComponent(productId) + '&updatedValue=' + encodeURIComponent(updatedValue);

          xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
              if (xhr.status === 200) {
                // Handle the response (you may show a success message or handle errors)
                console.log(xhr.responseText);

                // Show a pop-up message using SweetAlert
                Swal.fire({
                  icon: 'success',
                  title: 'Data Updated',
                  text: 'The data has been updated successfully.',
                });
              } else {
                // Show an error pop-up message
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'Failed to update the data. Please try again.',
                });
              }
            }
          };

          // Send the request
          xhr.send(data);
        }
      });
    });
  });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
      // Add an event listener for each "Mark as Complete" button
      var markAsCompleteButtons = document.querySelectorAll('.mark-as-complete');

      markAsCompleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
          // Get the product ID from the data-product-id attribute
          var productId = button.getAttribute('data-product-id');

          // Call the function to mark as complete
          markAsComplete(productId);
        });
      });
    });

    function markAsComplete(productId) {
      // Send an AJAX request to update the status
      $.ajax({
        type: 'POST',
        url: 'update_status.php', // Change this to the appropriate server-side script
        data: { productId: productId },
        success: function(response) {
          // Check the response from the server
          if (response === 'success') {
            // Use SweetAlert2 to display a success message
            Swal.fire({
              icon: 'success',
              title: 'Marked as Complete',
              text: 'The project has been marked as complete successfully.',
            }).then(function () {
              // Optionally, you can reload the page or update the status dynamically
              // window.location.reload();
              // Update the status dynamically
              // $('#status_' + productId).text('Complete');
            });
          } else {
            // Show an error message (e.g., Pending amount)
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: response, // Display the error message from the server
            });
          }
        },
        error: function(error) {
          // Show an error message
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to update the status. Please try again.',
          });
        }
      });
    }
  </script>




</body>
</html>
