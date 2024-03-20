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

// Check for connection error
if (!$connection) {
    die("Error in DB connection: " . mysqli_connect_errno() . " : " . mysqli_connect_error());
}

// Fetch the user's current details
$query = "SELECT role, organization, profile_pic FROM hrinfo WHERE hrid = '$hrid'";
$result = mysqli_query($connection, $query);

if ($result === false) {
    die("Error in SQL query: " . mysqli_error($connection));
}

// Check if a row was returned
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION["role"] = $row['role']; // Set the role in the session
} else {
    // Handle the case where role and organization are not found
    $_SESSION["role"] = "Role not found";
}


$queryCountUsers = "SELECT COUNT(userid) AS userCount FROM userinfo";
$resultCountUsers = mysqli_query($connection, $queryCountUsers);

if ($resultCountUsers === false) {
    die("Error in SQL query: " . mysqli_error($connection));
}

if (mysqli_num_rows($resultCountUsers) > 0) {
    $rowCountUsers = mysqli_fetch_assoc($resultCountUsers);
    $userCount = $rowCountUsers['userCount'];
} else {
    $userCount = 0; // Default value if no users are found
}

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


$queryCountProducts = "SELECT COUNT(product_id) AS productCount FROM hrproduct";
$resultCountProducts = mysqli_query($connection, $queryCountProducts);

if ($resultCountProducts === false) {
    die("Error in SQL query: " . mysqli_error($connection));
}

if (mysqli_num_rows($resultCountProducts) > 0) {
    $rowCountProducts = mysqli_fetch_assoc($resultCountProducts);
    $productCount = $rowCountProducts['productCount'];
} else {
    $productCount = 0; // Default value if no products are found
}

// Format the user count to always have two digits (with leading zeros)
$formattedUserCount = sprintf("%02d", $userCount);



// pending count
// Replace these variables with your actual database credentials
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'adminhr';

// Establish a connection to the database
$adminhr = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$adminhr) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Your SQL query to count pending items
$sql = "SELECT COUNT(*) AS pending_count FROM hrproduct WHERE status = 'pending'";
$result = mysqli_query($adminhr, $sql);

// Check if the query was successful
if ($result) {
    // Fetch the count value
    $row = mysqli_fetch_assoc($result);
    $pendingCount = $row['pending_count'];
} else {
    // Handle the case where the query fails
    echo 'Error executing query: ' . mysqli_error($adminhr);
}

// Close the database connection
mysqli_close($adminhr);




$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'adminhr';

// Establish a connection to the database
$adminhr = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$adminhr) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Your SQL query to count pending items
$sql = "SELECT COUNT(*) AS complete_count FROM hrproduct WHERE status = 'completed'";
$result = mysqli_query($adminhr, $sql);

// Check if the query was successful
if ($result) {
    // Fetch the count value
    $row = mysqli_fetch_assoc($result);
    $completecount = $row['complete_count'];
} else {
    // Handle the case where the query fails
    echo 'Error executing query: ' . mysqli_error($adminhr);
}

// Close the database connection
mysqli_close($adminhr);



// LEAVE COUNT

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminhr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get count of pending leave requests
$sql = "SELECT COUNT(*) AS pending_count FROM hrleave WHERE status = 'pending'";
$result = $conn->query($sql);

$pending_count = 0;
if ($result->num_rows > 0) {
    // Fetching result
    $row = $result->fetch_assoc();
    $pending_count = $row["pending_count"];
}

// Close connection
$conn->close();

// OD COUNT

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminhr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get count of pending leave requests
$sql = "SELECT COUNT(*) AS pending_od_count FROM hrod WHERE status = 'pending'";
$result = $conn->query($sql);

$pending_od_count = 0;
if ($result->num_rows > 0) {
    // Fetching result
    $row = $result->fetch_assoc();
    $pending_od_count = $row["pending_od_count"];
}

// Close connection
$conn->close();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminhr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get count of pending leave requests
$sql = "SELECT COUNT(*) AS pending_payslip_count FROM hrpayslip WHERE status = 'pending'";
$result = $conn->query($sql);

$pending_payslip_count = 0;
if ($result->num_rows > 0) {
    // Fetching result
    $row = $result->fetch_assoc();
    $pending_payslip_count = $row["pending_payslip_count"];
}

// Close connection
$conn->close();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminhr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get count of pending leave requests
$sql = "SELECT COUNT(*) AS pending_permission_count FROM hrpermission WHERE status = 'pending'";
$result = $conn->query($sql);

$pending_permission_count = 0;
if ($result->num_rows > 0) {
    // Fetching result
    $row = $result->fetch_assoc();
    $pending_permission_count = $row["pending_permission_count"];
}

// Close connection
$conn->close();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminhr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get count of pending leave requests
$sql = "SELECT COUNT(*) AS pending_ot_count FROM hrovertime WHERE status = 'pending'";
$result = $conn->query($sql);

$pending_ot_count = 0;
if ($result->num_rows > 0) {
    // Fetching result
    $row = $result->fetch_assoc();
    $pending_ot_count = $row["pending_ot_count"];
}

// Close connection
$conn->close();



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminhr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get count of pending leave requests
$sql = "SELECT COUNT(*) AS pending_password_count FROM hrpassword WHERE status = 'pending'";
$result = $conn->query($sql);

$pending_password_count = 0;
if ($result->num_rows > 0) {
    // Fetching result
    $row = $result->fetch_assoc();
    $pending_password_count = $row["pending_password_count"];
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="g36.css" />
    <link rel="stylesheet" href="s36.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    



  </head>
  
  <body>

    <div class="emp-home-page">
      <div class="menu-wrapper">
        
        <div class="menu">


          <div class="frame">
            

            <div id="mySidepanel" class="sidepanel">
              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">x</a>

              
              <a href="../37 hr view/i37.php">
                <i class="fas fa-user"></i> View Profile
            </a>
            <div style="margin-top: 12px;"></div>
              <a href="../52 add user/i52.html">
                  <i class="fas fa-user-plus"></i> Add User
              </a>
              <div style="margin-top: 12px;"></div>

              <div class="dropdown-submenu">
                <a href="javascript:void(0)" class="leaveDropdownToggle">
                    <i class="far fa-calendar-check"></i> Status &#9660;
                </a>
                        <div class="submenu-content leaveDropdownContent">

                        <a href="../40 hr leave approve/i40.php" id="leaveStatusLink" style="position: relative; font-size: 18px;">Leave Status
                          <?php if ($pending_count > 0) : ?>
                          <span id="notificationCount" class="notification"><?php echo $pending_count; ?></span>
                          <?php endif; ?>
                        </a>


                        <a href="../41 hr od approve/i41.php" style="position: relative; font-size: 18px;">OD Status
                        <?php if ($pending_od_count > 0) : ?>
                          <span id="notificationCount" class="notification"><?php echo $pending_od_count; ?></span>
                          <?php endif; ?>
                        </a>

                        <a href="../42 hr payslip approve/i42.php" style="position: relative;font-size: 18px;">Pay Slip Status
                        <?php if ($pending_payslip_count > 0) : ?>
                          <span id="notificationCount" class="notification"><?php echo $pending_payslip_count; ?></span>
                          <?php endif; ?>
                      </a>

                        <a href="../49 hr permission/i49.php"style="position: relative;font-size: 18px;">Permission Status
                        <?php if ($pending_permission_count > 0) : ?>
                          <span id="notificationCount" class="notification"><?php echo $pending_permission_count; ?></span>
                          <?php endif; ?>
                      </a>
                      
                        <a href="../43 hr overtime approve/i43.php"style="position: relative;font-size: 18px;">Over Time Status
                        <?php if ($pending_ot_count > 0) : ?>
                          <span id="notificationCount" class="notification"><?php echo $pending_ot_count; ?></span>
                          <?php endif; ?>
                      </a>
                      
                      </div>
                    </div>
                    <div style="margin-top: 12px;"></div>

                    <a href="../57 hr password change/i57.php">
                    <i class="fas fa-lock"></i> Password Status

                    <?php if ($pending_password_count > 0) : ?>
                          <span style="position:relative;left:6px;top:-2px;" id="notificationCount" class="notification"><?php echo $pending_password_count; ?></span>
                          <?php endif; ?>
              </a>
              <div style="margin-top: 12px;"></div>


              <a href="../47 hr product/i47.html">
                <i class="fas fa-box"></i> Project
              </a>
              <div style="margin-top: 12px;"></div>

              <a href="../44 hr sett/i44.html" style="position: relative;left: -1px">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div style="margin-top: 50px;"></div>
              

              <hr style="position: relative;top: 8px;width: 168%;color: black;border-color: black;border-width: 1px;background-color: black;">
              
              <div style="margin-top: 20px;"></div>
              <a href="../1 get start/i1.php" id="logout-link" style="position: relative;left: -1px">
              <i class="fas fa-sign-out-alt"></i> Logout
              </a>

              <div style="margin-top: 12px;"></div>

            </div>
            <button class="openbtn" onclick="openNav()">☰</button> 
          
            <div class="profile-container">
        <!-- Display the profile image -->
        <img class="profile" id="profileImage" src="<?php echo $_SESSION['profile_pic'] ?? 'default_profile_pic.jpg'; ?>" alt="Profile Picture" >
        
        <!-- Hidden file input -->
        <form action="upload_profile.php" method="post" enctype="multipart/form-data" style="display: none;">
            <input type="file" name="profile_picture" id="fileInput" accept="image/*" onchange="this.form.submit();">
        </form>
    </div>

    <div class="div" style="cursor: default;">
    <div class="dropdown" id="userDropdown">
        <div class="text-wrapper" id="greetText">UID:<?php echo $_SESSION["hrid"]; ?></div>
        <div class="dropdown-content" id="dropdownContent">
            <p id="updateProfileButton" style="cursor: pointer;" onclick="triggerFileInput();">Update Profile</p>
        </div>
    </div>

    <img class="img" src="https://c.animaapp.com/lYNsExDT/img/vector-1.svg" onclick="toggleDropdown();" />
</div>



          <div class="frame-2">
            <div class="frame-wrapper">
              <div class="frame-3">
                <div class="text-wrapper-2">Total Employees</div>
                <div class="text-wrapper-3" style="left:110px;"><?php echo $userCount; ?></div>
                <a href="../51 view user/i51.php">
                <div class="div-wrapper"><div class="text-wrapper-4" style="cursor:pointer;">More info</div></div>
    </a>
              </div>
            </div>
            <div class="frame-wrapper">
              <div class="frame-3">
                <div class="text-wrapper-5">Total Project</div>
                <a href="../56 project status/i56.php">
                <div class="div-wrapper"><div class="text-wrapper-4" style="cursor:pointer;">More info</div></div>
</a>
                <div class="frame-4">
                  <div class="frame-5">
                    <div class="text-wrapper-6">Active</div>
                    <div class="ellipse"></div>
                  </div>
                  <div class="text-wrapper-7"><?php echo $pendingCount;?></div>
                  <div class="frame-6">
                    <div class="ellipse-2"></div>
                    <div class="text-wrapper-6">Completed</div>
                  </div>
                  <div class="text-wrapper-8"><?php echo $completecount;?></div>
                </div>
              </div>
            </div>
            <div class="frame-wrapper">
              <div class="frame-3">
                <div class="text-wrapper-9">Total Revenue</div>
                <div class="div-wrapper">
                  <a href="../58 revenue/revenue.php">
                  <div class="text-wrapper-4" style="cursor:pointer;">More info</div></div>
</a>
                <div class="frame-7">
                  <div class="frame-8">
                  <div class="text-wrapper-10"><?php echo number_format($totalRevenue, 2); ?></div>

                    <img class="rupee" src="https://c.animaapp.com/lYNsExDT/img/rupee-1@2x.png" />
                  </div>
                </div>
              </div>
            </div>
            <div class="frame-wrapper">
              <div class="frame-3">
                <div class="text-wrapper-2" style="position: relative;left: 68px">Total Client</div>
                <div class="text-wrapper-11" style="position: relative; left: 120px; top: 40px;"><?php echo $productCount; ?></div>
                <a href="../55 client/i55.php">
                <div class="div-wrapper"><div class="text-wrapper-4" style="cursor:pointer;">More info</div></div>
  </a>
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
                  
                    
                  <div class="overlap-group-2">
                    <div class="text-wrapper-29">Category by Gender</div>
                  <canvas id="myChartgender" style="width: 100%;max-width: 600px;display: block;position: relative;top: 68px;"></canvas>
                </div>
                <hr>
                <!-- weather start -->
                <!-- <div class="calendar" style="position: relative;left: -326px;top: 60px ;background-color:#a3acf8"></div> -->
                
          
        
                
            </div>
            <div class="footer"></div>
            
          </div>
          
        </div>
        
      </div>

    
    </div>
    


    <script>
    document.addEventListener("DOMContentLoaded", function () {
            // Your existing script...
            // ...

            // Get a reference to the file input
            const fileInput = document.getElementById("fileInput");

            // Trigger file input when clicking "Update Profile"
            const updateProfileButton = document.getElementById("updateProfileButton");

            updateProfileButton.addEventListener("click", function () {
                // Trigger the file input click event
                fileInput.click();
            });

            // Handle file input change
            fileInput.addEventListener("change", function () {
                // Submit the form when a file is selected
                this.form.submit();
            });
        });
    </script>

<script>
    function toggleDropdown() {
        const dropdownContent = document.getElementById("dropdownContent");
        dropdownContent.classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.addEventListener("click", function (event) {
        if (!event.target.matches('.text-wrapper') && !event.target.matches('.img')) {
            const dropdownContent = document.getElementById("dropdownContent");
            if (dropdownContent.classList.contains('show')) {
                dropdownContent.classList.remove('show');
            }
        }
    });
</script>


<script>

      //dropdown


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

      //bar graph


    document.addEventListener("DOMContentLoaded", function () {
    // Fetch role counts from the server using AJAX
    fetch('rolecount.php')
        .then(response => response.json())
        .then(data => {
          // const xValues = Object.values(data);
            const xValues = ["Backend", "Web Developer", "Software Testing", "UI/UX" ];
            const yValues = Object.values(data);
            const barColors = ["#30BEB6", "#FF7F74", "#FFCB67", "#7E57C2"]; // Add more colors if needed

            // Create the bar chart with the fetched data
            new Chart("myChartbar", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Role Counts'
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Roles'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Counts'
                            }
                        }]
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching role counts:', error));

    // Pie chart code
    const xValuesPie = ["Present", "Absent", "Late"];
    const yValuesPie = [4, 2, 1];
    const barColorsPie = ["#30BEB6", "#FF7F74", "#FFCB67"];

    new Chart("myChart", {
        type: "pie",
        data: {
            labels: xValuesPie,
            datasets: [{
                backgroundColor: barColorsPie,
                data: yValuesPie,
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
                display: true,
                text:""
            }
        }
    });
});
</script>
<script>
  function CalendarControl() {
    const calendar = new Date();
    const calendarControl = {
      localDate: new Date(),
      prevMonthLastDate: null,
      calWeekDays: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      calMonthName: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec"
      ],
      daysInMonth: function (month, year) {
        return new Date(year, month, 0).getDate();
      },
      firstDay: function () {
        return new Date(calendar.getFullYear(), calendar.getMonth(), 1);
      },
      lastDay: function () {
        return new Date(calendar.getFullYear(), calendar.getMonth() + 1, 0);
      },
      firstDayNumber: function () {
        return calendarControl.firstDay().getDay() + 1;
      },
      lastDayNumber: function () {
        return calendarControl.lastDay().getDay() + 1;
      },
      getPreviousMonthLastDate: function () {
        let lastDate = new Date(
          calendar.getFullYear(),
          calendar.getMonth(),
          0
        ).getDate();
        return lastDate;
      },
      navigateToPreviousMonth: function () {
        calendar.setMonth(calendar.getMonth() - 1);
        calendarControl.attachEventsOnNextPrev();
      },
      navigateToNextMonth: function () {
        calendar.setMonth(calendar.getMonth() + 1);
        calendarControl.attachEventsOnNextPrev();
      },
      navigateToCurrentMonth: function () {
        let currentMonth = calendarControl.localDate.getMonth();
        let currentYear = calendarControl.localDate.getFullYear();
        calendar.setMonth(currentMonth);
        calendar.setYear(currentYear);
        calendarControl.attachEventsOnNextPrev();
      },
      displayYear: function () {
        let yearLabel = document.querySelector(".calendar .calendar-year-label");
        yearLabel.innerHTML = calendar.getFullYear();
      },
      displayMonth: function () {
        let monthLabel = document.querySelector(
          ".calendar .calendar-month-label"
        );
        monthLabel.innerHTML = calendarControl.calMonthName[calendar.getMonth()];
      },
      selectDate: function (e) {
        console.log(
          `${e.target.textContent} ${
            calendarControl.calMonthName[calendar.getMonth()]
          } ${calendar.getFullYear()}`
        );
      },
      plotSelectors: function () {
        document.querySelector(
          ".calendar"
        ).innerHTML += `<div class="calendar-inner"><div class="calendar-controls">
          <div class="calendar-prev"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 128 128"><path fill="#666" d="M88.2 3.8L35.8 56.23 28 64l7.8 7.78 52.4 52.4 9.78-7.76L45.58 64l52.4-52.4z"/></svg></a></div>
          <div class="calendar-year-month">
          <div class="calendar-month-label"></div>
          <div>-</div>
          <div class="calendar-year-label"></div>
          </div>
          <div class="calendar-next"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 128 128"><path fill="#666" d="M38.8 124.2l52.4-52.42L99 64l-7.77-7.78-52.4-52.4-9.8 7.77L81.44 64 29 116.42z"/></svg></a></div>
          </div>
          <div class="calendar-today-date">Today: 
            ${calendarControl.calWeekDays[calendarControl.localDate.getDay()]}, 
            ${calendarControl.localDate.getDate()}, 
            ${calendarControl.calMonthName[calendarControl.localDate.getMonth()]} 
            ${calendarControl.localDate.getFullYear()}
          </div>
          <div class="calendar-body"></div></div>`;
      },
      plotDayNames: function () {
        for (let i = 0; i < calendarControl.calWeekDays.length; i++) {
          document.querySelector(
            ".calendar .calendar-body"
          ).innerHTML += `<div>${calendarControl.calWeekDays[i]}</div>`;
        }
      },
      plotDates: function () {
        document.querySelector(".calendar .calendar-body").innerHTML = "";
        calendarControl.plotDayNames();
        calendarControl.displayMonth();
        calendarControl.displayYear();
        let count = 1;
        let prevDateCount = 0;
  
        calendarControl.prevMonthLastDate = calendarControl.getPreviousMonthLastDate();
        let prevMonthDatesArray = [];
        let calendarDays = calendarControl.daysInMonth(
          calendar.getMonth() + 1,
          calendar.getFullYear()
        );
        // dates of current month
        for (let i = 1; i < calendarDays; i++) {
          if (i < calendarControl.firstDayNumber()) {
            prevDateCount += 1;
            document.querySelector(
              ".calendar .calendar-body"
            ).innerHTML += `<div class="prev-dates"></div>`;
            prevMonthDatesArray.push(calendarControl.prevMonthLastDate--);
          } else {
            document.querySelector(
              ".calendar .calendar-body"
            ).innerHTML += `<div class="number-item" data-num=${count}><a class="dateNumber" href="#">${count++}</a></div>`;
          }
        }
        //remaining dates after month dates
        for (let j = 0; j < prevDateCount + 1; j++) {
          document.querySelector(
            ".calendar .calendar-body"
          ).innerHTML += `<div class="number-item" data-num=${count}><a class="dateNumber" href="#">${count++}</a></div>`;
        }
        calendarControl.highlightToday();
        calendarControl.plotPrevMonthDates(prevMonthDatesArray);
        calendarControl.plotNextMonthDates();
      },
      attachEvents: function () {
        let prevBtn = document.querySelector(".calendar .calendar-prev a");
        let nextBtn = document.querySelector(".calendar .calendar-next a");
        let todayDate = document.querySelector(".calendar .calendar-today-date");
        let dateNumber = document.querySelectorAll(".calendar .dateNumber");
        prevBtn.addEventListener(
          "click",
          calendarControl.navigateToPreviousMonth
        );
        nextBtn.addEventListener("click", calendarControl.navigateToNextMonth);
        todayDate.addEventListener(
          "click",
          calendarControl.navigateToCurrentMonth
        );
        for (var i = 0; i < dateNumber.length; i++) {
            dateNumber[i].addEventListener(
              "click",
              calendarControl.selectDate,
              false
            );
        }
      },
      highlightToday: function () {
        let currentMonth = calendarControl.localDate.getMonth() + 1;
        let changedMonth = calendar.getMonth() + 1;
        let currentYear = calendarControl.localDate.getFullYear();
        let changedYear = calendar.getFullYear();
        if (
          currentYear === changedYear &&
          currentMonth === changedMonth &&
          document.querySelectorAll(".number-item")
        ) {
          document
            .querySelectorAll(".number-item")
            [calendar.getDate() - 1].classList.add("calendar-today");
        }
      },
      plotPrevMonthDates: function(dates){
        dates.reverse();
        for(let i=0;i<dates.length;i++) {
            if(document.querySelectorAll(".prev-dates")) {
                document.querySelectorAll(".prev-dates")[i].textContent = dates[i];
            }
        }
      },
      plotNextMonthDates: function(){
       let childElemCount = document.querySelector('.calendar-body').childElementCount;
       //7 lines
       if(childElemCount > 42 ) {
           let diff = 49 - childElemCount;
           calendarControl.loopThroughNextDays(diff);
       }

       //6 lines
       if(childElemCount > 35 && childElemCount <= 42 ) {
        let diff = 42 - childElemCount;
        calendarControl.loopThroughNextDays(42 - childElemCount);
       }

      },
      loopThroughNextDays: function(count) {
        if(count > 0) {
            for(let i=1;i<=count;i++) {
                document.querySelector('.calendar-body').innerHTML += `<div class="next-dates">${i}</div>`;
            }
        }
      },
      attachEventsOnNextPrev: function () {
        calendarControl.plotDates();
        calendarControl.attachEvents();
      },
      init: function () {
        calendarControl.plotSelectors();
        calendarControl.plotDates();
        calendarControl.attachEvents();
      }
    };
    calendarControl.init();
  }
  
  const calendarControl = new CalendarControl();
  </script>



<script>
// Function to fetch data from the server
function fetchData() {
  // Use Fetch API or XMLHttpRequest to send a request to the server
  fetch('countgender.php')
    .then(response => response.json())
    .then(data => {
      // Call createChart function with the fetched data
      createChart(data);
    })
    .catch(error => console.error('Error fetching data:', error));
}

// Function to create the doughnut chart
function createChart(data) {
  const xValues = data.labels;
  const yValues = data.values;
  const barColors = data.colors;

  new Chart("myChartgender", {
    type: "doughnut",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      title: {
        display: true,
        text: ""
      }
    }
  });
}

// Fetch data when the page loads
fetchData();
</script>



<script>
      document.getElementById('logout-link').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default link behavior
    
        // Ask for confirmation before logging out
        const confirmLogout = confirm('Are you sure you want to logout?');
        if (confirmLogout) {
          // Display the loading spinner
          const spinner = document.createElement('div');
          spinner.className = 'loading-spinner';
          document.body.appendChild(spinner);
    
          // Simulate the loading delay
          setTimeout(function () {
            // Remove the loading spinner
            spinner.style.display = 'none';
    
            // Display the logout success message
            const messageDiv = document.createElement('div');
            messageDiv.textContent = 'Logout successful';
            messageDiv.style.position = 'fixed';
            messageDiv.style.top = '50%';
            messageDiv.style.left = '50%';
            messageDiv.style.transform = 'translate(-50%, -50%)';
            messageDiv.style.backgroundColor = 'white';
            messageDiv.style.padding = '20px';
            messageDiv.style.border = '1px solid #ccc';
            messageDiv.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.5';
            document.body.appendChild(messageDiv);
    
            // Remove the message after 2 seconds
            setTimeout(function () {
              messageDiv.style.display = 'none';
            }, 3000);
    
            // Redirect to the logout page
            window.location.href = '../1 get start/i1.php';
          }, 3000);
        }
      });
    </script>






  </body>
</html>