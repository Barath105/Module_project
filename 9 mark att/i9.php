<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Your Page Title</title>
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
  background: url('your-background-image.jpg') no-repeat center center fixed;
  background-size: cover;
  color: #333;
  text-align: center;
}

/* Header styles */
header {
  background-color: #a3acf8;
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

/* Main content styles */
.main-content {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

.container {
  background-color:#a3acf842;
  border-radius: 10px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  padding: 40px;
  text-align: center;
}

.request-attendance {
  animation: fadeIn 1s ease;
}

.request-attendance img {
  width: 100px;
  height: 100px;
  margin: 0 auto;
}

.request-attendance h1 {
  font-size: 24px;
  margin: 20px 0;
}

.request-attendance p {
  font-size: 16px;
  color: #333;
}

.with-photo {
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 20px 0;
}

.with-photo img {
  width: 30px;
  height: 30px;
  margin-right: 10px;
}

.mark-attendance {
  display: inline-block;
  padding: 10px 20px;
  background-color: #f7ce68;
  color: #fff;
  border: none;
  border-radius: 5px;
  text-decoration: none;
  transition: background-color 0.3s;
}

.mark-attendance:hover {
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
body {
  overflow-y: hidden; /* Hide vertical scrollbar */
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

    <section class="main-content">
        <div class="container">
            <div class="request-attendance">
                <img class="calendar" src="https://c.animaapp.com/roZgGkcV/img/calendar--1--1@2x.png" alt="Calendar Icon">
                <h1>Request Attendance</h1>
                <p>Request to mark your attendance</p>
                <div class="with-photo">
                    <img class="photo" src="https://c.animaapp.com/roZgGkcV/img/photo-1@2x.png" alt="Photo Icon">
                    <p>With photo and location</p>
                </div>
                <a class="mark-attendance" href="../10 pick loc/i10.php">Mark Attendance</a>
            </div>
        </div>
    </section>

    
</body>
</html>
