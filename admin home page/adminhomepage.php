<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="g.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta charset="UTF-8">
  </head>
  
  <body>
    <style>
            body,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            p,
            a,
            span {
              font-family: 'Inter', sans-serif;
            }

            .frame-3 {
                transition: transform 0.3s ease; /* Add a transition effect for the transform property */
              }
              
              .frame-3:hover {
                transform: scale(1.1); /* Apply a scale transformation on hover */
              }

              /* CSS for the dropdown */
              body {
                font-family: "Lato", sans-serif;
              }
              
              .sidepanel  {
                width: 0;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #111;
                overflow-x: hidden;
                transition: 0.5s;
                padding-top: 60px;
              }
              
              .sidepanel a {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 20px;
                color: #818181;
                display: block;
                transition: 0.3s;
              }
              
              .sidepanel a:hover {
                color: #f1f1f1;
              }
              
              .sidepanel .closebtn {
                position: absolute;
                top: 0;
                right: 25px;
                font-size: 36px;
              }
              
              .openbtn {
                font-size: 20px;
                cursor: pointer;
                background-color: #a3acf8;
                color: black;
                padding: 10px 15px;
                border: none;
                position:relative;
                top:20px; 
              }
              body{
                overflow-x: hidden;
              }


          
    </style>

<?php
// Database connection parameters
$host = 'localhost'; // Change this if your database is hosted elsewhere
$username = 'root'; // Change this to your database username
$password = ''; // Change this to your database password
$database = 'adminhr'; // Change this to your database name

// Create connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Perform a query to count the number of users in the 'userinfo' table
$query = "SELECT COUNT(*) as user_count FROM userinfo";
$result = mysqli_query($connection, $query);

if ($result) {
    // Fetch the result as an associative array
    $row = mysqli_fetch_assoc($result);
    
    // Extract the user count from the result
    $userCount = $row['user_count'];
    
    // Output the user count within the div
} else {
    // Error handling if the query fails
    echo "Error: " . mysqli_error($connection);
}


// Perform a query to count the number of rows in hrproduct where status is "Pending"
$query = "SELECT COUNT(*) as pending_count FROM hrproduct WHERE status = 'Pending'";
$result = mysqli_query($connection, $query);

if ($result) {
    // Fetch the result as an associative array
    $row = mysqli_fetch_assoc($result);
    
    // Extract the pending count from the result
    $pendingCount = $row['pending_count'];
} else {
    // Error handling if the query fails
    echo "Error: " . mysqli_error($connection);
}


// Perform a query to count the number of rows in hrproduct where status is "Pending"
$query = "SELECT COUNT(*) as complete_count FROM hrproduct";
$result = mysqli_query($connection, $query);

if ($result) {
    // Fetch the result as an associative array
    $row = mysqli_fetch_assoc($result);
    
    // Extract the pending count from the result
    $completeCount = $row['complete_count'];
} else {
    // Error handling if the query fails
    echo "Error: " . mysqli_error($connection);
}

// Perform a query to calculate the sum of totalcost column from hrproduct
$query = "SELECT SUM(totalcost) as total_cost_sum FROM hrproduct";
$result = mysqli_query($connection, $query);

if ($result) {
    // Fetch the result as an associative array
    $row = mysqli_fetch_assoc($result);
    
    // Extract the total cost sum from the result
    $totalCostSum = $row['total_cost_sum'];
} else {
    // Error handling if the query fails
    echo "Error: " . mysqli_error($connection);
}



// Close the database connection
mysqli_close($connection);
?>

    <div class="emp-home-page">
      <div class="menu-wrapper">
        <div class="menu">
          <div class="frame">
            <!-- <img class="vector" style="cursor:pointer;" src="https://c.animaapp.com/lYNsExDT/img/vector.svg" /> -->

            <button class="openbtn" onclick="openNav()">☰</button> 

            <div class="view" style="
    position: relative;
    left: 80px;
    font-size: 22px;
    top: -12px;
">Profile</div>
            <div class="hr" style="<
    div class=&quot;view&quot; style=&quot;
    position: relative;
    ;;;;
    font-size: 22px;
    ;;;;
&quot;>Profile</div>;
    position: relative;
    position: relative;
    left: 204px;
    top: -33px;
">Add HR</div>
          
            <img class="profile" src="https://c.animaapp.com/lYNsExDT/img/profile-1@2x.png" />
            <div class="div" style="cursor:pointer;">
              <div class="text-wrapper">AID: 1001</div>
              
              <img class="img" src="https://c.animaapp.com/lYNsExDT/img/vector-1.svg" />
            </div>
          </div>
          <div class="frame-2">
            <div class="frame-wrapper">
              <div class="frame-3">
                <div class="text-wrapper-2">Total Employees</div>
                <div class="text-wrapper-3"><?php echo $userCount; ?></div>
                <div class="div-wrapper"><div class="text-wrapper-4" style="cursor:pointer;">More info</div></div>
              </div>
            </div>
            <div class="frame-wrapper">
              <div class="frame-3">
                <div class="text-wrapper-5">Total Project</div>
                <div class="div-wrapper"><div class="text-wrapper-4" style="cursor:pointer;">More info</div></div>
                <div class="frame-4">

                  <div class="text-wrapper-7"><?php echo $pendingCount; ?></div>
                </div>
              </div>
            </div>
            <div class="frame-wrapper">
              <div class="frame-3">
                <div class="text-wrapper-9">Total Revenue</div>
                <div class="div-wrapper"><div class="text-wrapper-4" style="cursor:pointer;">More info</div></div>
                <div class="frame-7">
                  <div class="frame-8">
                    <div class="text-wrapper-10"><?php echo number_format($totalCostSum); ?></div>
                    <img class="rupee" src="https://c.animaapp.com/lYNsExDT/img/rupee-1@2x.png" />
                  </div>
                </div>
              </div>
            </div>
            <div class="frame-wrapper">
              <div class="frame-3">
              <div class="text-wrapper-2" style="
    position: relative;
    left: 88px;
">Queries</div>
                <div class="text-wrapper-11">10</div>
                <div class="div-wrapper"><div class="text-wrapper-4" style="cursor:pointer;">More info</div></div>
              </div>
            </div>
          </div>
          <div class="text-wrapper-12">Dashboard</div>
          <div class="frame-9">
            <div class="group">
              <div class="overlap">
                
                <div class="text-wrapper-28">Department</div>
                <canvas id="myChartbar" style="width:100%;max-width:600px;position:relative;top:58px;"></canvas>
              </div>
            </div>
            <div class="overlap-wrapper">
              <div class="overlap-2">
                <div class="overlap-group-wrapper">
                  
                    
                  <div class="overlap-group-2"><div class="text-wrapper-29">Attendance</div>
                  <canvas id="myChart" style="width: 100%;max-width: 600px;display: block;position: relative;top: 68px;"></canvas>
                </div>
                  
                
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      function openNav() {
        document.getElementById("mySidepanel").style.width = "250px";
      }
      
      function closeNav() {
        document.getElementById("mySidepanel").style.width = "0";
      }
      var leaveDropdownToggle = document.querySelector(".leaveDropdownToggle");
      var leaveDropdownContent = document.querySelector(".leaveDropdownContent");
      leaveDropdownToggle.addEventListener("click", function(event){
          event.stopPropagation();
          if (leaveDropdownContent.style.display === "block") {
              leaveDropdownContent.style.display = "none";
          } else {
              leaveDropdownContent.style.display = "block";
          }
      });
      document.addEventListener("click", function(event) {
          if (event.target !== leaveDropdownToggle && event.target !== leaveDropdownContent) {
              leaveDropdownContent.style.display = "none";
          }
      });
      </script>
    
    
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const xValues = ["Present", "Absent", "Late"];
        const yValues = [28, 1, 2];
        const barColors = ["#30BEB6", "#FF7F74", "#FFCB67"];

        new Chart("myChart", {
          type: "pie",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues,
              borderWidth: 0,
              borderColor: 'transparent'
            }]
          },
          options: {
            legend: {
              labels: {
                fontColor: 'black',
                fontSize: 14,
                fontStyle: 'bold',
              }
            },
            title: {
              display: true
            }
          }
        });

        const xValuess = ["Web Developer", "UI/UX", "Backend", "Software Testing"];
        const yValuess = [10, 20, 40, 60, 80, 100, 120];
        const barColorss = ["green", "blue", "lightblue", "orange"];

        new Chart("myChartbar", {
          type: "bar",
          data: {
            labels: xValuess,
            datasets: [{
              backgroundColor: barColorss,
              data: yValuess
            }]
          },
          options: {
            legend: {
              display: false
            },
            title: {
              display: true
            }
          }
        });
      });
    </script>
  </body>
</html>