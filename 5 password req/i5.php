<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="s5.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="font-awesome.min.css">
      <script src="https://kit.fontawesome.com/523c1d8307.js" crossorigin="anonymous"></script>
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
  <body style="overflow-x:hidden;">
  <div class="frame">
      <div class="image-1">
        <img src="EMP.png" alt="Your Image">
      </div>
  </div>
      <div class="wrapper">
        <div class="title-text">
            <div class="title login">
            Request Password Change
            </div>
        </div>
        <div class="form-container">
            <div class="form-inner">
              
              <form action="pass.php" method="POST">
                  <div class="field">
                    <input type="text" name="user_id" placeholder="User ID" required>
                  </div>
                  <div class="field">
                    <input type="password" name="new_password" id="newPassword" placeholder="New Password" required>
                    <span class="password-toggle-icon" onclick="togglePassword('newPassword')" style="position: relative;top: -38px;left: 300px">
                      <i class="fas fa-eye"></i>
                    </span>
                  </div>


                  <div class="field">
                    <input type="password" name="reenter_password" id="reenterPassword" placeholder="Confirm Password" required>
                    <span class="password-toggle-icon" onclick="togglePassword('reenterPassword')" style="position: relative;top: -38px;left: 300px">
                      <i class="fas fa-eye"></i>
                    </span>
                  </div>
                  <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Request">
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
        // JavaScript function to toggle the password visibility
        function togglePassword(inputId) {
          const passwordInput = document.getElementById(inputId);
          const icon = passwordInput.parentElement.querySelector('.password-toggle-icon');
          if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.querySelector("i").classList.remove("fa-eye");
            icon.querySelector("i").classList.add("fa-eye-slash");
          } else {
            passwordInput.type = "password";
            icon.querySelector("i").classList.remove("fa-eye-slash");
            icon.querySelector("i").classList.add("fa-eye");
          }
        }
      </script>
      
      
  </body>
</html>