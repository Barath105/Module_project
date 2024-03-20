<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="https://kit.fontawesome.com/523c1d8307.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/523c1d8307.js" crossorigin="anonymous"></script>
        
    
    <link rel="stylesheet" type="text/css" href="s19.css">
</head>
<body>
    <style>
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
        .apply-form {
            animation: fadeIn 1s ease;
        }
    </style>
    <header style="position: relative;height: 28px;top: -46px;width: 1372px;left: -8px;height:68px;">
            <nav>
                <div class="logo" style="position: relative;top: -5px;left: 8px">
                    Password Change
                </div>
                <ul>
                    <li><a href="../4 emp home/i4.php" style="position: relative;top: -5px;left:16px;">Home</a></li>
                </ul>
            </nav>
        </header>
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">
                Change Password
            </div>
        </div>
        <div class="form-container">
            <div class="form-inner">
            
            <form action="changepassword.php" method="POST">
                <div class="field">
                    <input type="text" name="cpassword" placeholder="Current Password" required>
                </div>
                <div class="field">
                    <input type="password" name="npassword" id="newPassword" placeholder="New Password" required>
                    <span class="password-toggle-icon" onclick="togglePassword('newPassword')" style="position: relative;top: -38px;left: 300px">
                    <i class="fas fa-eye"></i>
                    </span>
                </div>


                <div class="field">
                    <input type="password" name="rpassword" id="reenterPassword" placeholder="Confirm Password" required>
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
        </form>
        
    </div>

    <script>
        function submitForm(event) {
            event.preventDefault();
    
            // Form data
            var nameInput = document.getElementById("name");
            var empIdInput = document.getElementById("employeeId");
            var dateInput = document.getElementById("date");
    
            var name = nameInput.value;
            var empId = empIdInput.value;
            var date = dateInput.value;
    
            // Validation for the name, employeeId, and date fields
            if (!name || !employeeId || !cpassword || !npassword || !rpassword) {
                showErrorMsg("Please fill in all fields.");
                return false;
            }
    
            // Submit form (Replace with your own code for form submission)
            // Here, we are just showing a success message
            showSuccessMsg("Password change successfully");
    
            return true;
        }
    
        function showSuccessMsg(message) {
            var successMsg = document.getElementById("successMsg");
            successMsg.style.display = "block";
            successMsg.textContent = message;
    
            var errorMsg = document.getElementById("errorMsg");
            errorMsg.style.display = "none";
        }
    
        function showErrorMsg(message) {
            var successMsg = document.getElementById("successMsg");
            successMsg.style.display = "none";
    
            var errorMsg = document.getElementById("errorMsg");
            errorMsg.style.display = "block";
            errorMsg.textContent = message;
        }
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