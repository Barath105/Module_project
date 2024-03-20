<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="g13.css" />
    <link rel="stylesheet" href="s13.css" />
  </head>
  <body>
    <style>
      html, body {
        overflow: hidden;
    }
</style>
      <style>
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
        .frame-5 {
          position: absolute;
          width: 1440px;
          height: 68px;
          top: 0;
          left: 0;
          background-color:#a3acf8;
      }
      
        
        .text-wrapper-4 {
          position: absolute;
          width: 169px;
          top: 20px;
          left: 22px;
          font-family: "Inter", Helvetica;
          font-weight: bold;
          color:black;
          font-size: 26px;
          letter-spacing: 0;
          line-height: normal;
          white-space: nowrap;
        }
        header {
          background-color: rgba(0, 0, 0, 0.7);
          color: #fff;
          padding: 20px 0;
        }
        
        
        .logo {
          font-size: 24px;
          font-weight: bold;
          display: flex;
          align-items: center;
        }
        
        ul {
          list-style: none;
          display: flex;
        }
        
        ul li {
          margin-right: 20px;
        }
        
        ul li a {
          text-decoration: none;
          color: #fff;
          transition: color 0.3s;
        }
        
        ul li a:hover {
          color: #f7ce68;
        }
      </style>
    <div class="emp-p-view">
      <div class="overlap-group-wrapper">
        <div class="overlap-group">
          <div class="frame">
            <div class="div">
              <a href="../21 privacy/i21.php">
              <div class="text-wrapper" style="position: relative;left: 42px">Privacy and Policy</div>
              <img class="vector" src="https://c.animaapp.com/IgNThupA/img/vector.svg" />
            </a>
            <div style="margin-top: 12px;"></div>
            </div>
            <a href="../19 pass change/i19.php">
            <div class="frame-2">
              <div class="text-wrapper-2" style="position: relative;left: 42px">Change Password</div>
              <img class="img" src="https://c.animaapp.com/IgNThupA/img/frame-370.svg" />
            </div>
          </a>
          <div style="margin-top: 12px;"></div>
            <!-- <a href="../1 get start/i1.php" id="logout-link">
              <div class="frame-3">
                <div class="text-wrapper" style="position: relative;top: -5px;left: 42px">Logout</div>
                <img class="vector-2" src="https://c.animaapp.com/IgNThupA/img/vector-1.svg" style="position: relative;top: -30px">
              </div>
            </a> -->
          </div>

          <div class="frame-5">
            <div class="text-wrapper-4">
                Settings
            </div>
            <ul>
                <li><a href="../4 emp home/i4.php" style="color:black;position: relative;left: 1280px;top: 26px;text-decoration: none;font-family:Inter, Helvetica;">Home</li>
            </ul>
          </div>

        </div>
      </div>
    </div>
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
