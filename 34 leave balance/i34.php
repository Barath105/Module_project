

<?php
// Start the session (assuming you haven't started it elsewhere)
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    // Redirect or handle the case where the user is not logged in
    header("Location: ../36 hr home/i36.php"); // Redirect to login page, adjust accordingly
    exit();
}

// Assuming you have a database connection
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

// Get the user ID from the session
$userID = $_SESSION['userid'];

// Fetch "Loss of pay" count for the logged-in user from hrleave table
// Fetch "Loss of pay" count for the logged-in user from hrleave table
$sql = "SELECT SUM(`no-of-days`) as lossOfPayCount FROM hrleave WHERE employeeId = $userID AND leaveType = 'Loss of pay'";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    // Get the count
    $LossOfPayCount = $row['lossOfPayCount'];

    // If $LossOfPayCount is null (no records found), set it to 0
    $LossOfPayCount = ($LossOfPayCount === null) ? 0 : $LossOfPayCount;
} else {
    // Query failed
    $LossOfPayCount = 0;
}








// Casual Leave
// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    // Redirect or handle the case where the user is not logged in
    header("Location: ../36 hr home/i36.php"); // Redirect to login page, adjust accordingly
    exit();
}

// Assuming you have a database connection
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

// Get the user ID from the session
$userID = $_SESSION['userid'];

// Fetch "Loss of pay" count for the logged-in user from hrleave table
$sql = "SELECT SUM(`no-of-days`) as totalCasualLeaveDays FROM hrleave WHERE employeeId = $userID AND leaveType = 'Casual Leave'";
$result = $conn->query($sql);

if ($result !== false && $result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    $usedCasualLeaveDays = $row['totalCasualLeaveDays'];

    // Calculate remaining casual leave days
    $remainingCasualLeaveDays = 4 - $usedCasualLeaveDays;
    
    // If remainingCasualLeaveDays is less than 0, update LossOfPayCount
    if ($remainingCasualLeaveDays < 0) {
        $LossOfPayCount += abs($remainingCasualLeaveDays);
        $remainingCasualLeaveDays = 0; // Set to 0 if negative
    }
} else {
    // No records found
    $remainingCasualLeaveDays = 0;
}

// Close the database connection
$conn->close();


// Sick Leave

if (!isset($_SESSION['userid'])) {
    // Redirect or handle the case where the user is not logged in
    header("Location: ../36 hr home/i36.php"); // Redirect to login page, adjust accordingly
    exit();
}

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

// Get the user ID from the session
$userID = $_SESSION['userid'];

// Fetch "Casual Leave" count for the logged-in user from hrleave table
$sql = "SELECT SUM(`no-of-days`) as totalsickleave FROM hrleave WHERE employeeId = $userID AND leaveType = 'Sick Leave'";
$result = $conn->query($sql);


if ($result !== false && $result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    $totalsickleave = 4 - $row['totalsickleave'];
    
    if ($totalsickleave < 0) {
        // Update LossOfPayCount based on $totalsickleave
        $LossOfPayCount += abs($totalsickleave);
    }

} else {
    // No records found
    $totalsickleave = 0;
}

// Close the database connection
$conn->close();

?>

<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awesome.min.css">
    <script src="https://kit.fontawesome.com/523c1d8307.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/pikaday.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/css/pikaday.min.css">

    <style>
        body,html {
            font-family: 'Arial', sans-serif;
            color: #333;
            text-align: center;
            background-color:#eaecfd;
            background: url('bg.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        header {
            background-color: #a3acf8;
            color: black;
            padding: 20px 0;
            width: 100%; 
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
        
    

.box1,
.box2,
.box3 {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    background: linear-gradient(210deg, #dcdffa, #a3acf8);
    max-width: 244px;
    height: 165px;
    border-radius: 25px;
    transition: transform 0.3s ease;
    position: relative;
    box-shadow:0 0 20px #a3acf8;

}

.text-wrapper-2 {
    left: 62px;
    position: absolute;
    top: 20px;
    font-family: "Inter", Helvetica;
    font-weight: 600;
    color: #000000;
    font-size: 20px;
    letter-spacing: 0;
    line-height: normal;
    white-space: nowrap;
}
.text-wrapper-3 {
    position: absolute;
    top: 80px;
    left: 110px;
    font-family: "Inter", Helvetica;
    font-weight: 600;
    color: #000000;
    font-size: 24.9px;
    letter-spacing: 0;
    line-height: normal;
    justify-content:center;
    text-align:center;
}
.frame-3 {
    position: relative;
    width: 244px;
    height: 165px;
    background-color: #a2abf7;
    border-radius: 24.93px;
    overflow: hidden;
    box-shadow: 0 0 20px #a3acf8;
    /* background:linear-gradient(210deg, #dcdffa, #a3acf8); */
}

.div-wrapper {
    position: absolute;
    width: 244px;
    height: 40px;
    top: 125px;
    left: 0;
    background-color: #ffffff;
}
.text-wrapper-4 {
    position: absolute;
    top: 5px;
    left: 81px;
    font-family: "Inter", Helvetica;
    font-weight: 600;
    color: #000000;
    font-size: 18px;
    letter-spacing: 0;
    line-height: normal;
}
.frame-2 {
    display: inline-flex;
    align-items: flex-start;
    gap: 99.7px;
    position: absolute;
    top: 184px;
    left: 220px;
    justify-content:center;
    align-items:center;
}

.frame-wrapper {
    position: relative;
    width: 244px;
    height: 164px;
    border-radius: 24px;
}

.frame-3:hover{
    transition: transform 0.3s ease;
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
<header style="position: relative;top:-8px;width: 102%;left: -1%;height: 35px;">
        <nav style="position: relative;width: 1200px">
            <div class="logo"style="position: relative;top: -8px;left:122px">
                <i class=""></i> Leave balance</div>
            <ul>
                <li><a href="../4 emp home/i4.php"style="position: relative;left: 136px;top:-8px">Home</a></li>
            </ul>
        </nav>
    </header>
    <img src="EMP.png">


    <div class="logo-1">
    <img src="logo.png">
    </div>
    <div style="margin-top: 100px;"></div>
    <div class="frame-2">

    <div class="frame-wrapper">
            <div class="frame-3">
                <div class="text-wrapper-2">Loss of pay</div>
                <div class="text-wrapper-3" style="color:red;"><?php echo $LossOfPayCount; ?></div>
                <a href="fetchlossofpay.php">
                <div class="div-wrapper"><div class="text-wrapper-4" style="cursor:pointer;">More info</div></div>
</a>
            </div>
            </div>
            <div class="frame-wrapper">
            <div class="frame-3">
            <div class="text-wrapper-2">Casual Leave<br>(Granted-4)</div>
            <div class="text-wrapper-3"  style="color:green;"><?php echo $remainingCasualLeaveDays; ?></div>
            <a href="casualleave.php">
            <div class="div-wrapper"><div class="text-wrapper-4" style="cursor:pointer;">More info</div></div>
</a>
            </div>
        </div>
        <div class="frame-wrapper">
        <div class="frame-3">
            <div class="text-wrapper-2">Sick Leave<br>(Granted-4)</div>
            <div class="text-wrapper-3"  style="color:green;"><?php echo $totalsickleave; ?></div>
            <a href="sickleave.php">
            <div class="div-wrapper"><div class="text-wrapper-4" style="cursor:pointer;">More info</div></div>
</a>
            </div>
        </div>
            
            </div>
    <div>
</body>
</html>