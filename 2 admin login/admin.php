<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">
      <title>Login and Registration Form in HTML | CodingNepal</title>
      <link rel="stylesheet" href="admin.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="font-awesome.min.css">
      <script src="https://kit.fontawesome.com/523c1d8307.js" crossorigin="anonymous"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="https://kit.fontawesome.com/a076d05399.js"></script>


      <style>
        body{
          background-image: url('bg.jpg');
          background-size: cover;
          background-position: center;
          background-repeat: no-repeat;
          margin: 0;
          padding: 0;
          overflow: hidden;
        }
      </style>    
  </head>
  <body>
    <div class="frame">
      <!-- Your content goes here -->
      <img src="EMP.png" alt="Your Image" style="width: 10%;position: relative;top: -18px;left: 40px;">
      <!-- Add any other elements or text as needed -->
    </div>
      <div class="wrapper">
        <div class="title-text">
            <div class="title login">
             Admin Login
            </div>
        </div>
        <div class="form-container">
            
              <input type="radio" name="slide" id="login" checked>
              <input type="radio" name="slide" id="signup">
            </div>
            <div class="form-inner">
              
                <form action="adminlogin.php" method="POST"  class="login" >
                  <div class="field">
                    <input type="text" name="userid" placeholder="ID" required>
                  </div>
                  <div class="field">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <span class="password-toggle-icon" onclick="togglePassword('password', 'eye-icon')" style="position: relative;top: -38px;left: 300px">
                      <i id="eye-icon" class="fas fa-eye"></i>
                    </span>
                  </div>
                  <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Login">
                  </div>
                  
              </form>
            </div>
        </div>
      </div>
      <script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");
        signupBtn.onclick = (()=>{
          loginForm.style.marginLeft = "-50%";
          loginText.style.marginLeft = "-50%";
        });
        loginBtn.onclick = (()=>{
          loginForm.style.marginLeft = "0%";
          loginText.style.marginLeft = "0%";
        });
        signupLink.onclick = (()=>{
          signupBtn.click();
          return false;
        });
      </script>


      <script>
        function togglePassword(fieldId, iconId) {
          var passwordField = document.getElementById(fieldId);
          var eyeIcon = document.getElementById(iconId);
    
          if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
          } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
          }
        }
      </script>
      
  </body>
</html>