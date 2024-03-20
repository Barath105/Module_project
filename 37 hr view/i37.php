<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['hrid'])) {
    header("Location: ../35 hr login/hrlogin.php");
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

// Fetch the user's current details from the userinfo table
$query = "SELECT gender, role, DOB, mail, address, phone,organization FROM hrinfo WHERE hrid = '$hrid'";
$result = mysqli_query($connection, $query);

if ($result === false) {
    die("Error in SQL query: " . mysqli_error($connection));
}

// Check if a row was returned
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Set session variables with the retrieved data
    $_SESSION['gender'] = $row['gender'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['DOB'] = $row['DOB'];
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['address'] = $row['address'];
    $_SESSION['phone'] = $row['phone'];
    $_SESSION['organization'] = $row['organization'];
} else {
    // Handle the case when no data is found in the userinfo table
    // You can set default values or redirect the user to a page to update their profile
}

// Close the database connection
mysqli_close($connection);
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        
    <link rel="stylesheet" type="text/css" href="s37.css">
</head>
<body>
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
body {
    font-family: Arial, sans-serif;
    background: url('bg.jpg') no-repeat center center fixed;
    background-size: cover;
}

.man img{
    max-width:100%;
    width:250px;
    height:auto;
    left:10%;
    top:25%;

}

.footer {
  position: absolute;
  bottom: -200;
  left: 0;
  width: 100%;
  color: black;
  text-align: center;
  padding: 20px 0;
  background-image: linear-gradient(to right, #a3acf8, #a1a7dd);
  /* Replace #ff8a00 and #da1b60 with your desired colors */
  /* animation: footerAnimation 5s infinite; */
}

.footer-content {
  font-size: 14px;
}

.footer-content p {
  margin: 0;
}
        
    </style>


    
<header style="position: relative;top: 0px;width:100%;left: 0px;height: 36px">
            <nav style="position: relative;width: 1200px">
                <div class="logo" style="position: relative;top: -6px;left: 128px">
                    
                    <i class="fas fa-home"></i>View Profile</div>
                    
                <ul>
                    <li><a href="../36 hr home/i36.php" style="position: relative;left: 110px;top:-6px;">Home</a></li>
                </ul>
            </nav>
        </header>
        <img src="EMP.png">
        <!-- <div class="container" style="position: relative; top: 20px;"> -->
            <section class="container">
            
                <form action="add.php" method="post" class="form">
                <div class="column">
                <div class="input-box">
                    <label><strong>Full Name</strong></label>
                    <input type="text" name="name" value="<?php echo $_SESSION["hrname"]; ?>"readonly>
                </div>

                <div class="input-box">
                        <label><strong>User ID</strong></label>
                    <input type="text" name="userid" value="<?php echo $_SESSION["hrid"]; ?>"readonly>
                    </div>
        </div>


            <div class="column">
            <div class="input-box">
                    <label><strong>Gender</strong></label>
                    <input type="text" name="gender" value="<?php echo $_SESSION["gender"]; ?>"readonly>
                </div>

            <div class="input-box">
                    <label><strong>Email Address</strong></label>
                    <input type="text" name="mail" value="<?php echo $_SESSION["mail"]; ?>"readonly>
                </div>
                </div>
        
                <div class="column">
                    <div class="input-box">
                        <label><strong>Phone Number</strong></label>
                        <input type="number" name="phone"  value="<?php echo $_SESSION["phone"]; ?>"readonly>
                    </div>

                    <div class="input-box">
                        <label><strong>Birth Date</strong></label>
                        <input type="date" name="dob" value="<?php echo $_SESSION["DOB"]; ?>"readonly>
                    </div>
                </div>
            </div>
        
                    <div class="column">
                    
                    <div class="input-box">
                        <label><strong>Role</strong></label>
                        <input type="text" name="role" placeholder="Role" value="<?php echo $_SESSION["role"]; ?>"readonly>
                        </div>
            
                    <div class="input-box">
                        <label><strong>Organization</strong></label>
                    <input type="text" name="organization" value="<?php echo $_SESSION["organization"]; ?>" readonly />
                    </div>
            
                    </div>

        
                <div class="input-box address">
                    <label><strong>Address</strong></label>
                    <input type="text" name="address"value=" <?php echo $_SESSION["address"]; ?>" readonly>
                    </div>
                    
                </div>
                </form>
            </section>

            <div style="margin-top: 150px;"></div>

            <footer class="footer">
                <div class="footer-content">
                    <p>&copy; 2024 HR Employee. All rights reserved.</p>
                </div>
            </footer>

            <div class="man">
                <img src="man.png">
            </div>

</body>
</html>