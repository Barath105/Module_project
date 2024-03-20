<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
  <style>
    /* Reset some default styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Arial', sans-serif;
  background: url('bg.jpg') no-repeat center center fixed;
  background-size: cover;
  color: #333;
  text-align: center;
}

/* Header styles */
header {
  background:linear-gradient(45deg, #a3acf8, #c9cef5);
  color: black;
  padding: 20px 0;
  height:76px;
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
  left:128px;
  position:relative;
  top:6px;
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
  position:relative;
  top:6px;
}

nav ul li a:hover {
  color: blue;
}

/* Main content styles */
.main-content {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

.container {
  background-color: #a3acf842;
  border-radius: 10px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  padding: 40px;
  text-align: center;
  position:relative;
  left:-12%;
}

.branch-location {
  animation: fadeIn 1s ease;
}

.location-info, .pick-location {
  margin: 20px;
}

h2 {
  font-size: 24px;
}

.saveetha-school-of {
  font-size: 16px;
  color: #333;
}

.pick-location-button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #f7ce68;
  color: black;
  border: none;
  border-radius: 5px;
  text-decoration: none;
  transition: background-color 0.3s;
}

.pick-location-button:hover {
  background-color: #f7ce68;
}

/* Keyframe animation for fade-in effect */
@keyframes fadeIn {
  from {
      opacity: 0;
      transform: translateY(20px);
  }
  to {
      opacity: 1;
      transform: translateY(0);
  }
}
.mark-attendance:hover {
  background-color: #f7ce68;
}
img {
  max-width: 100%;
  width: 100px;
  height: auto;
  position: absolute;
  top: -10px;
  left: 40px;
}
.cartoon img{
  width: 350px;
  height: auto;
  position: absolute;
  left:66%;
  top:36%;
}

.footer {
  position: relative;
  bottom: 0;
  top:0;
  width: 100%;
  color: black;
  text-align: center;
  padding: 20px 0;
  background-image: linear-gradient(to right, #a3acf8, #a1a7dd);
}

.footer-content {
  font-size: 14px;
}

.footer-content p {
  margin: 0;
}
</style>

    <header>
        <nav>
            <div class="logo"><i class="fas fa-home"></i> Attendance</div>
            <ul>
                <li><a href="../4 emp home/i4.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <img src="EMP.png">

    <section class="main-content">
        <div class="container">
            <div class="branch-location">
                <div class="location-info">
                    <h2>Branch Location:</h2>
                    <p class="saveetha-school-of">
                        Saveetha School Of Engineering, Thandalam<br><br>
                        Latitude: 13.0289379<br>
                        Longitude: 80.0193009
                    </p>
                </div>
                <div class="pick-location">
                    <h2>Validate Location</h2>
                    <a class="pick-location-button" href="../11 location check/i11.php">Validate</a>
                </div>
            </div>
        </div>
    </section>

    <div class="cartoon">
      <img src="att-1.png">
    </div>
    

    <!-- <div style="margin-bottom:10px;"> -->
    <footer class="footer">
                <div class="footer-content">
                    <p>&copy; 2024 HR Employee. All rights reserved.</p>
                </div>
            </footer>

</body>
</html>
