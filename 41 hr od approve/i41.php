
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="approve.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
        $sql = "SELECT * FROM hrod WHERE status = 'Pending'";
        $result = $conn->query($sql);
        $serialNumber = 1; // Initialize serial number

        ?>
        <header style="position: relative;top:0%;width: 100%;left: 0%;height: 75px;">
        <nav style="position: relative;width: 1200px">
            <div class="logo"style="position: relative;top: 2px;left:122px">
                <i class=""></i> OD Pending</div>
            <ul>
                <li><a href="../36 hr home/i36.php"style="position: relative;left: 136px;top:0px">Home</a></li>
            </ul>
        </nav>
    </header>
    <img src="EMP.png">
        

    <div class="button-group">
    
        <button id="pendingBtn" style="width: 106px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);" fdprocessedid="edr5qqp">Pending</button>
    <a href="approvepage.php">
        <button id="approvedBtn" style="width: 106px;" fdprocessedid="3ngugx">Approved</button>
        </a>

        <a href="rejectpage.php">
        <button id="historyBtn" style="width: 106px;" fdprocessedid="7nfh6h">History</button>
        </a>
    </div>

    <div class="logo-1">
    <img src="logo.png">
    </div>
    
        <!-- Apply form within a single frame -->
        <table id="data-table">
            <thead>
            <tr>
            <tr>
                <th>S.no</th>
                <th>Userid</th>
                <th>Title</th>
                <th>Req_date</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>File</th>
                <th>Status</th>
                </tr>


                </tr>
            </thead>
            <tbody>
                <?php
                // Display data in the table
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Retrieve the data as before
                        $id = $row['id'];
                $title = $row['title'];
                $userid = $row['employeeId'];
                $req_date = $row['req_date'];
                $startDate = $row['startDate'];
                $endDate = $row['endDate'];
                $reason = $row['reason'];
                $status = $row['status'];
                $file = $row['pdf_name'];
        
                echo '<tr>';
                echo '<td>' . $serialNumber . '</td>';
                echo '<td>' . $userid . '</td>';
                echo '<td>' . $title . '</td>';
                echo '<td>' . $req_date . '</td>';
                echo '<td>' . $startDate . '</td>';
                echo '<td>' . $endDate . '</td>';
                echo '<td>' . $reason . '</td>';
                echo '<td><a href="download.php?file=' . $file . '">' . $file . '</a></td>';
                echo '<td>';
                echo '<a href="accept.php?id=' . $id . '"><i class="fas fa-check" style="color: green; cursor: pointer; margin-right: 15px;"></i> </a>';
                echo '<a href="reject.php?id=' . $id . '"><i class="fas fa-times" style="color: red; cursor: pointer;"></i> </a>';
                echo '</td>';
                echo '</tr>';

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
        

        <script>
            document.getElementById("pendingBtn").addEventListener("click", function () {
            updateButtonColors(this);
            
        });
        
        document.getElementById("approvedBtn").addEventListener("click", function () {
            updateButtonColors(this);
            
        });
        
        document.getElementById("historyBtn").addEventListener("click", function () {
            updateButtonColors(this);
            
        });

        window.addEventListener("load", function () {
            var applyBtn = document.getElementById("pendingBtn");
            applyBtn.style.backgroundColor = "skyblue";
        });
        
        function updateButtonColors(clickedButton) {
            const buttons = document.querySelectorAll(".button-group button");
        
            buttons.forEach(function (button) {
                if (button === clickedButton) {
                    button.style.backgroundColor = "skyblue"; 
                } else {
                    button.style.backgroundColor = "";
                }
            });
        }
            </script>
    </body>
</html>