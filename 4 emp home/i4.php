<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: ../3 emp login/login.php");
    exit();
}

$userid = $_SESSION['userid'];

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
$query = "SELECT role, organization FROM userinfo WHERE userid = '$userid'";
$result = mysqli_query($connection, $query);

if ($result === false) {
    die("Error in SQL query: " . mysqli_error($connection));
}

// Check if a row was returned
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION["role"] = $row['role']; // Set the role in the session
    $_SESSION["organization"] = $row['organization']; // Set the organization in the session
} else {
    // Handle the case where role and organization are not found
    $_SESSION["role"] = "Role not found";
    $_SESSION["organization"] = "Organization not found";
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="g4.css" />
    <link rel="stylesheet" href="s4.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>


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
                background-color: #b8bdeb;
                overflow-x: hidden;
                transition: 0.5s;
                padding-top: 60px;
            }
            
            .sidepanel a {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 20px;
                color: black;
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
                color:black;
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
            .openbtn:hover{
                background-color:#a3acf8;
            }
            body{
                overflow-x: hidden;
            
            }


            .profile-container {
            position: relative;
            display: inline-block;
        }

        .profile {
            width: 100px; /* Set your desired width */
            height: 100px; /* Set your desired height */
            border-radius: 50%;

        }

        #fileInput {
            display: none;
        }
        .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        padding: 10px;
        z-index: 1;
        width:150px;
        top:7px;
    }

    .dropdown-content p {
        margin: 0;
    }

    .dropdown-content button {
        margin-top: 10px;
    }

    .show {
        display: block;
    }

    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@100;200;300;400;500;600;700&display=swap');

:root {
    --calendar-bg-color: black;
    --calendar-font-color: #FFF;
    --weekdays-border-bottom-color: #404040;
    --calendar-date-hover-color: #505050;
    --calendar-current-date-color: #1b1f21;
    --calendar-today-color: linear-gradient(to bottom, #03a9f4, #2196f3);
    --calendar-today-innerborder-color: transparent;
    --calendar-nextprev-bg-color: transparent;
    --next-prev-arrow-color : #FFF;
    --calendar-border-radius: 16px;
    --calendar-prevnext-date-color: #484848
}

* {
    padding: 0;
    margin: 0;
}

.calendar {
    font-family: 'IBM Plex Sans', sans-serif;
    position: relative;
    max-width: 400px;
    min-width: 320px;
    background: var(--calendar-bg-color);
    color: var(--calendar-font-color);
    margin: 20px auto;
    box-sizing: border-box;
    overflow: hidden;
    font-weight: normal;
    border-radius: var(--calendar-border-radius);
}

.calendar-inner {
    padding: 10px 10px;
}

.calendar .calendar-inner .calendar-body {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    text-align: center;
}

.calendar .calendar-inner .calendar-body div {
    padding: 4px;
    min-height: 30px;
    line-height: 30px;
    border: 1px solid transparent;
    margin: 10px 2px 0px;
}

.calendar .calendar-inner .calendar-body div:nth-child(-n+7) {
    border: 1px solid transparent;
    border-bottom: 1px solid var(--weekdays-border-bottom-color);
}

.calendar .calendar-inner .calendar-body div:nth-child(-n+7):hover {
    border: 1px solid transparent;
    border-bottom: 1px solid var(--weekdays-border-bottom-color);
}

.calendar .calendar-inner .calendar-body div>a {
    color: var(--calendar-font-color);
    text-decoration: none;
    display: flex;
    justify-content: center;
}

.calendar .calendar-inner .calendar-body div:hover {
    border: 1px solid var(--calendar-date-hover-color);
    border-radius: 4px;
}

.calendar .calendar-inner .calendar-body div.empty-dates:hover {
    border: 1px solid transparent;
}

.calendar .calendar-inner .calendar-controls {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
}

.calendar .calendar-inner .calendar-today-date {
    display: grid;
    text-align: center;
    cursor: pointer;
    margin: 3px 0px;
    background: var(--calendar-current-date-color);
    padding: 8px 0px;
    border-radius: 10px;
    width: 80%;
    margin: auto;
}

.calendar .calendar-inner .calendar-controls .calendar-year-month {
    display: flex;
    min-width: 100px;
    justify-content: space-evenly;
    align-items: center;
}

.calendar .calendar-inner .calendar-controls .calendar-next {
    text-align: right;
}

.calendar .calendar-inner .calendar-controls .calendar-year-month .calendar-year-label,
.calendar .calendar-inner .calendar-controls .calendar-year-month .calendar-month-label {
    font-weight: 500;
    font-size: 20px;
}

.calendar .calendar-inner .calendar-body .calendar-today {
    background: var(--calendar-today-color);
    border-radius: 4px;
}

.calendar .calendar-inner .calendar-body .calendar-today:hover {
    border: 1px solid transparent;
}

.calendar .calendar-inner .calendar-body .calendar-today a {
    outline: 2px solid var(--calendar-today-innerborder-color);
}

.calendar .calendar-inner .calendar-controls .calendar-next a,
.calendar .calendar-inner .calendar-controls .calendar-prev a {
    color: var(--calendar-font-color);
    font-family: arial, consolas, sans-serif;
    font-size: 26px;
    text-decoration: none;
    padding: 4px 12px;
    display: inline-block;
    background: var(--calendar-nextprev-bg-color);
    margin: 10px 0 10px 0;
}

.calendar .calendar-inner .calendar-controls .calendar-next a svg,
.calendar .calendar-inner .calendar-controls .calendar-prev a svg {
    height: 20px;
    width: 20px;
}

.calendar .calendar-inner .calendar-controls .calendar-next a svg path,
.calendar .calendar-inner .calendar-controls .calendar-prev a svg path{
    fill: var(--next-prev-arrow-color);
}

.calendar .calendar-inner .calendar-body .prev-dates,
.calendar .calendar-inner .calendar-body .next-dates {
    color: var(--calendar-prevnext-date-color);
}

.calendar .calendar-inner .calendar-body .prev-dates:hover,
.calendar .calendar-inner .calendar-body .next-dates:hover {
border: 1px solid transparent;
pointer-events: none;
}

hr {
width: 235%;
height: 0px;
background-color: red;
margin-right: auto;
margin-left: auto;
margin-top: 5px;
margin-bottom: 5px;
border-width: 2px;
border-color: #a3acf8;
position:relative;
left:-126%;
top:100px;
}

table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ddd;
    position:relative;
    top:122%;
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

button {
    padding: 6px 10px;
    border: none;
    background-color: green;
    color: white;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}



.loading-spinner {
        border: 5px solid rgba(255, 255, 255, 0.3);
        border-top: 5px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: transparent;
        z-index: 9999;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    
    <div class="emp-home-page">
    <div class="menu-wrapper">
        <div class="menu">
        <div class="frame">
            <!-- <img class="vector" style="cursor:pointer;" src="https://c.animaapp.com/lYNsExDT/img/vector.svg" /> -->

            <div id="mySidepanel" class="sidepanel">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">x</a>

        <a href="../7 emp view/i7.php">
            <i class="fas fa-user"></i> View Profile
        </a>

            <div style="margin-top: 12px;"></div>

        <a href="../10 pick loc/i10.php">
            <i class="fas fa-calendar-alt"></i> Mark Attendance
        </a>

            <div style="margin-top: 12px;"></div>

        <a href="../8 view att/i8.php">
            <i class="fas fa-clipboard-list"></i> View Attendance
        </a>

        <div style="margin-top: 12px;"></div>

        <div class="dropdown-submenu">
        <a href="javascript:void(0)" class="leaveDropdownToggle">
            <i class="far fa-calendar-check"></i> Leave &#9660;
        </a>

        <div class="submenu-content leaveDropdownContent">

            <a href="../15 leave/i15.php" style="position: relative;font-size: 18px;">Apply Leave</a>
            <a href="../24 od/i24.php"style="position: relative;font-size: 18px;">Apply OD</a>
            <a href="../34 leave balance/i34.php"style="position: relative;font-size: 18px;">Leave Balance</a>
            </div>
            </div>                           
            
            <div style="margin-top: 12px;"></div>

            <a href="../16 payslip/i16.php">
                <i class="fas fa-file-invoice-dollar"></i> Pay Slip
            </a>

            <div style="margin-top: 12px;"></div>

            <a href="../25 over time/i25.php" style="position: relative;left: -1px">
                <i class="fas fa-clock"></i> Over Time
            </a>

            <div style="margin-top: 12px;"></div>

            <a href="../18 permission/i18.php" style="position: relative;left: -1px">
                <i class="fas fa-lock"></i> Permission
            </a>

            <div style="margin-top: 12px;"></div>

            <a href="../13 sett/i13.php" style="position: relative;left: -1px">
                <i class="fas fa-cog"></i> Settings
            </a>

            <div style="margin-top: 20px;"></div>

            
                                

            <hr style="position: relative;top: 22px;width: 168%;color: black;border-color: black;border-width: 1px;background-color: black;">

            <div style="margin-top: 28px;"></div>

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
        <div class="text-wrapper" id="greetText">UID:<?php echo $_SESSION["userid"]; ?></div>
        <div class="dropdown-content" id="dropdownContent">
            <p id="updateProfileButton" style="cursor: pointer;" onclick="triggerFileInput();">Update Profile</p>
        </div>
    </div>

    <img class="img" src="https://c.animaapp.com/lYNsExDT/img/vector-1.svg" onclick="toggleDropdown();" />
</div>



        
        <div class="frame-9">
            <div class="group">
                <div class="overlap">
                    <div class="text-wrapper-28"></div>
                        <canvas id="myChartbar" style="width:100%;max-width:600px;position:relative;top:58px;"></canvas>
                    </div>
                    <img src="./image.png" style="position: relative;top: -125%;left: 22px;">
                </div>
                
                
                            <div style="font-size:30px;font-weight:500;position:relative;width:500px;left:68%;top:20%; " id=greeting class="greet"></div>
                                <div style="font-size:18px;text-align: center;font-family: monospace;position:relative;width:50%;left: 52%;top: 28%;" class="quotes">
                                    Your work is going to fill a large part of your life, and the only way 
                                    to be truly satisfied is to do what you believe is great work.
                                </div>
                            






<div class="calendar" style="position: relative;top: 100%;left:-24%;background-color:#a3acf8"></div>

<div class="overlap-wrapper">
                    <div class="overlap-2">
                        <div class="overlap-group-wrapper">
                        <div class="overlap-group-2" style="position: relative;top: 138%;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <div class="text-wrapper-29">Attendance</div>
                                    <canvas id="myChart" style="width: 570px; max-width: 600px; display: block; position: relative; top: 68px; left: 8px; height: 285px;" width="570" height="285" class="chartjs-render-monitor"></canvas>
                                </div>
                                <!-- <div class="text-wrapper-29">Attendance</div> -->
                                    <!-- <canvas id="myChart" style="width: 122%;max-width: 600px;display: block;position: relative;top: 68px;left:8px"></canvas> -->
                                </div>
                                    <div class="calendar" style="position: relative;left: -668px;top: -500px;background-color:#a3acf8"></div>
                            </div>    
                        </div>

<?php
try {
    // Assuming you have already established a database connection

    // Fetch data from the userinfo table
    $query = "SELECT userinfo.*, hrproduct.product_name as productname FROM userinfo INNER JOIN hrproduct ON userinfo.product_id_1 = hrproduct.product_id 
    WHERE userid = '$userid' AND userinfo.product_status_1='Pending' ";
    $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if ($result) {
        // Output table headers
        echo "<table>";
        echo "<tr><th>ID</th><th>Prject ID</th><th>Task Name</th><th>Assigned To</th><th>Status</th><th>Action</th></tr>";

        // Check if there are rows returned
        if (mysqli_num_rows($result) > 0) {
            // Loop through the result set
            while ($row = mysqli_fetch_assoc($result)) {
                // Output table rows
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['product_id_1'] . "</td>";
                echo "<td>" . $row['productname'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td style='color:#FF7F74;'>" . $row['product_status_1'] . "</td>";
                echo "<td><a href='user_completed.php?id=$userid'><button>Mark completed</button></a></td>";
                echo "</tr>";
            }
        } else {
            // No data found within the table structure
            echo "<tr><td colspan='6' style='text-align:center;'>No data found.</td></tr>";
        }

        // Close the table
        echo "</table>";

        // Free result set
        mysqli_free_result($result);
    } else {
        // Throw an exception if the query failed
        throw new Exception("Query execution failed.");
    }
} catch (Exception $e) {
    // Display the error message in a table row
    echo "<table><tr><td colspan='6' style='text-align:center;color:red;'></td></tr></table>";
}

// Close the database connection
mysqli_close($connection);
?>




                    </div>
                    <hr class="line" style="top: 620%;width: 100%;left: 0%;background-color: blue;border-width: 1px;">
                </div>  
                <footer class="footer">
<div class="footer-content">
    <p>&copy; 2024 HR Employee. All rights reserved.</p>
</div>
</footer> 
            </div>
            
        </div>
    


    


    <script>
    document.addEventListener("DOMContentLoaded", function () {
            const fileInput = document.getElementById("fileInput");

            const updateProfileButton = document.getElementById("updateProfileButton");

            updateProfileButton.addEventListener("click", function () {
                fileInput.click();
            });

            fileInput.addEventListener("change", function () {
                this.form.submit();
            });
        });
    </script>

<script>
    function toggleDropdown() {
        const dropdownContent = document.getElementById("dropdownContent");
        dropdownContent.classList.toggle("show");
    }

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
    // Fetch data from PHP script
    fetch('fetch_att.php')
        .then(response => response.json())
        .then(data => {
            // Pie chart code
            var xValuesPie = ["Present", "Absent", "Late"];
            var yValuesPie = data.values;
            var barColorsPie = data.colors;

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
                        display: true
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
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
        text: "Category by Gender"
    }
    }
});
}

// Fetch data when the page loads
fetchData();
</script>

<script>
    // Get the current time
    var currentTime = new Date();
    var currentHour = currentTime.getHours();

    // Define the greetings based on time ranges
    var greeting = "";
    if (currentHour >= 0 && currentHour < 12) {
        greeting = "Good morning!";
    } else if (currentHour >= 12 && currentHour < 15) {
        greeting = "Good afternoon!";
    } else if (currentHour >= 15 && currentHour < 18) {
        greeting = "Good evening!";
    } else {
        greeting = "Good night!";
    }

    // Display the greeting in the HTML element
    document.getElementById("greeting").innerText = greeting;
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