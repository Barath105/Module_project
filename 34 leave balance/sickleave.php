<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending</title>
    <link rel="stylesheet" href="s30.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awesome.min.css">
    <script src="https://kit.fontawesome.com/523c1d8307.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/pikaday.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/css/pikaday.min.css">
</head>
<style>
  @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
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




#data-table {
    font-family: Arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    position:relative;
    top:50px;
}

#data-table th,
#data-table td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

#data-table th {
    background-color: #f2f2f2;
}

/* Alternating row colors */
#data-table tbody tr:nth-child(even) {
    background-color: #faf3f3;
}


/* Status styles */
#data-table tbody td.status {
    color: #1f10e7;
    font-weight: bold;
}

/* No data found styling */
#data-table tbody td.colspan {
    text-align: center;
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
    <body>
    <header style="position: relative;top:0%;width: 100%;left: 0%;height: 75px;">
        <nav style="position: relative;width: 1200px">
            <div class="logo"style="position: relative;top: 2px;left:122px">
                <i class=""></i> Sick leave</div>
            <ul>
                <li><a href="../4 emp home/i4.php"style="position: relative;left: 136px;top:0px">Home</a></li>
            </ul>
        </nav>
    </header>
    <img src="EMP.png">
    <div class="logo-1">
    <img src="logo.png">
    </div>
    
    <?php
session_start();


if (!isset($_SESSION['userid'])) {
    header("Location: ../4 emp home/i4.php"); 
    exit();
}

$userID = $_SESSION['userid'];

$conn = new mysqli("localhost", "root", "", "adminhr");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM hrleave WHERE employeeId = $userID AND leaveType = 'Sick leave'";
$result = $conn->query($sql);
?>


        
    <table id="data-table">
            <thead>
            <tr>
      
            <th>S.no</th>
        <th>Requested on</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>No.of days</th>
      </tr>

            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        
                      $serialNumber =1;
                

                      echo "<tr>";
                      echo "<td>" . $serialNumber . "</td>"; // Display serial number
                      echo "<td>" . $row["req_date"] . "</td>";
                      echo "<td>" . $row["startDate"] . "</td>";
                      echo "<td>" . $row["endDate"] . "</td>";
                      echo "<td>" . $row["no-of-days"] . "</td>";
                      echo "</tr>";
      
                        $serialNumber++;
                    }
                } else {
                    echo "<tr><td colspan='9' style='text-align: center;'>No data found</td></tr>";

                }
                $conn->close();
                ?>
            </tbody>
        </table>



    </body>
</html>