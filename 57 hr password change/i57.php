
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="approve.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Pending</title>
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
<?php
        // Start the session
        session_start();

        // Database connection
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPass = '';
        $dbName = 'adminhr';

        $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        // Fetch data with pagination
        $sql = "SELECT * FROM hrpassword WHERE status = 'Pending'";
        $result = $conn->query($sql);
        $serialNumber = 1; // Initialize serial number

        ?>
        <header style="position: relative;top:0%;width: 100%;left: 0%;height: 75px;">
        <nav style="position: relative;width: 1200px">
            <div class="logo"style="position: relative;top: 2px;left:122px">
                <i class=""></i> Password status</div>
            <ul>
                <li><a href="../36 hr home/i36.php"style="position: relative;left: 136px;top:0px">Home</a></li>
            </ul>
        </nav>
    </header>
    <img src="EMP.png">
        


    <div class="logo-1">
    <img src="logo.png">
    </div>
    
        <!-- Apply form within a single frame -->
        <table id="data-table">
            <thead>
            <tr>
            <tr>
            <th>S.no</th>
        <th>User ID</th>
        <th>New Password</th>
        <th>Status</th>
        <th>Action</th>
                </tr>


                </tr>
            </thead>
            <tbody>
                <?php
                // Display data in the table
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $serialNumber . "</td>"; // Display serial number
                      echo "<td>" . $row["userid"] . "</td>";
                      echo "<td>" . $row["new_password"] . "</td>";
                      echo "<td>" . $row["status"] . "</td>";
                      echo "<td><button class='approve-button' onclick='approveFunction(" . $row["userid"] . ")'>Approve</button></td>";
              
                      
                      echo "</tr>";
                        // Increment the serial number for the next row
                        $serialNumber++;
                    }
                } else {
                    echo "<tr><td colspan='10' style='text-align: center;'>No data found</td></tr>";

                }

                // Close the connection
                $conn->close();
                ?>
            </tbody>
        </table>
        

    </body>
</html>
<script>
    function approveFunction(userid) {
        $.ajax({
            type: 'POST',
            url: 'password.php',
            data: { userid: userid },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Password Updated',
                        text: 'Password has been updated successfully.'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update password. Please try again.'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to communicate with the server.'
                });
            }
        });
    }
</script>


  </div>
</body>
</html>
