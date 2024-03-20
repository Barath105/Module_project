<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="approve.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User</title>
  <!-- Add your CSS styles if needed -->
</head>
<body>
<style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    form {
      max-width: 400px;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
      border:none
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
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

<header style="position: relative;top:0%;width: 100%;left: 0%;height: 75px;">
        <nav style="position: relative;width: 1200px">
            <div class="logo"style="position: relative;top: 2px;left:122px">
                <i class=""></i> Edit data</div>
            <ul>
                <li><a href="../36 hr home/i36.php"style="position: relative;left: 136px;top:0px">Home</a></li>
            </ul>
        </nav>
    </header>
    <img src="EMP.png">
        



<?php
if(isset($_GET['userid']) && is_numeric($_GET['userid'])) {
    $userId = $_GET['userid'];

    // Establish a connection to the database
    $conn = new mysqli("localhost", "root", "", "adminhr");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch user data based on user ID
    $sql = "SELECT * FROM userinfo WHERE userid = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();

        // Display the edit form with all fields editable
        ?>
        <!-- <h2>Edit User</h2> -->
        <form action="update.php" method="post">
            <input type="hidden" name="userid" value="<?php echo $userData['userid']; ?>">
            
            <!-- Editable fields -->
            <label for="username">Name:</label>
            <input type="text" id="username" name="username" value="<?php echo $userData['username']; ?>"><br>

            <label for="age">Age:</label>
            <input type="text" id="age" name="age" value="<?php echo $userData['age']; ?>"><br>

            <label for="gender">Gender:</label>
            <input type="text" id="gender" name="gender" value="<?php echo $userData['gender']; ?>"><br>

            <label for="mail">Email:</label>
            <input type="text" id="mail" name="mail" value="<?php echo $userData['mail']; ?>"><br>

            <label for="dob">DOB:</label>
            <input type="text" id="dob" name="dob" value="<?php echo $userData['DOB']; ?>"><br>

            <label for="phone">Contact:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $userData['phone']; ?>"><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $userData['address']; ?>"><br>


            <label for="role">Role:</label>
            <input type="text" id="role" name="role" value="<?php echo $userData['role']; ?>"><br>

            <label for="organization">organization:</label>
            <input type="text" id="organization" name="organization" value="<?php echo $userData['organization']; ?>"><br>

            <!-- Add other fields as needed -->

            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "User not found.";
    }

    // Close the connection
    $conn->close();
} else {
    echo "Invalid user ID.";
}
?>

</body>
</html>
