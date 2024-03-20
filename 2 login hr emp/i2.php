<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">
      <title>Login and Registration Form in HTML | CodingNepal</title>
      <link rel="stylesheet" href="s2.css">
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

        .image-1 img {
      max-width: 100%;
      width: 150px;
      height: auto;
    }
    .image-1 {
      position: absolute;
      top: 0;
      left: 0;
    }
      </style>    
  </head>
  <body>
  <div class="frame">
      <div class="image-1">
        <img src="EMP.png" alt="Your Image">
      </div>
  </div>

      <div class="wrapper">
        <div class="title-text">
            <div class="title login">
              Employee Login
            </div>
            <div class="title signup">
              HR Login
            </div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
              <input type="radio" name="slide" id="login" checked>
              <input type="radio" name="slide" id="signup">
              <label for="login" class="slide login">Employee</label>
              <label for="signup" class="slide signup">HR</label>
              <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
              
                <form action="../3 emp login/login.php" method="POST"  class="login" >
                  <div class="field">
                    <input type="text" name="userid" placeholder="User ID" required>
                  </div>
                  <div class="field">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <span class="password-toggle-icon" onclick="togglePassword('password', 'eye-icon')" style="position: relative;top: -38px;left: 300px">
                      <i id="eye-icon" class="fas fa-eye"></i>
                    </span>
                  </div>
                  <div class="pass-link">
                    <a href="../5 password req/i5.php">Forgot password?</a>
                  </div>
                  <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Login">
                  </div>
                  
              </form>

              <form action="../35 hr login/hrlogin.php" method="POST" class="signup">
                  <div class="field">
                    <input type="text" name="hrid" placeholder="HR ID" required>
                  </div>
                  <div class="field">
                    <input type="password" id="hrpassword"   name="password" placeholder="Password" required>
                    <span class="password-toggle-icon" onclick="togglePassword('hrpassword', 'eye-icon-2')" style="position: relative;top: -38px;left: 300px">
                      <i id="eye-icon-2" class="fas fa-eye"></i>
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



<footer class="footer">
  <div class="footer-content">
    <p>&copy; 2024 HR Employee. All rights reserved.</p>
  </div>
</footer>







      
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