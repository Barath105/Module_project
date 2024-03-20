<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="s25.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awesome.min.css">
    <script src="https://kit.fontawesome.com/523c1d8307.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/pikaday.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/css/pikaday.min.css">
</head>
<body>
    <style>
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
    </style>
    <title>Apply</title>

    <header style="position: relative;top:-8%;width: 100%;left: 0%;height: 82px;">
        <nav style="position: relative;width: 1200px">
            <div class="logo"style="position: relative;top: 6px;left:122px">
                <i class=""></i> Overtime request</div>
            <ul>
                <li><a href="../4 emp home/i4.php"style="position: relative;left: 136px;top:7px">Home</a></li>
            </ul>
        </nav>
    </header>
    <img src="EMP.png">

    <div class="button-group">
        <button id="applyBtn" style="width: 106px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);" fdprocessedid="edr5qqp">Apply</button>

        <a href="../30 overtime pending/i30.php">
        <button id="pendingBtn" style="width: 106px;" fdprocessedid="3ngugx">Pending</button>
        </a>

        <a href="../31 overtime history/i31.php">
        <button id="historyBtn" style="width: 106px;" fdprocessedid="7nfh6h">History</button>
        </a>
    </div>

    <section class="container">
            
    <form id="leaveForm" class="form" method="POST" action="over time.php" enctype="multipart/form-data">
                    <h4>Overtime</h4>
                <div class="column">
                <div class="input-box">
                    <label>Name</label>
                    <input type="text" name="name" id="username" placeholder="Enter Name" required />
                </div>
        
                <div class="input-box">
                    <label>Userid</label>
                    <input type="text" name="employeeId" id="employeeId" placeholder="Enter userid" required />
                </div>
            </div>
        
                
        
                <div class="column">
                <div class="input-box">
                        <label>Date</label>
                        <input type="date" type="date" name="date" id="date" placeholder="Date" required />
                    </div>
                </div>
                    <button type="submit" value="Request" style="height:40px;top:68px;">Request</button>
                </form>
            </section>

            <div style="margin-top: 100px;"></div>

    
            <script>
        
         // JavaScript to handle button clicks
        document.getElementById("applyBtn").addEventListener("click", function () {
            updateButtonColors(this);
            // Your other actions for the "Apply" button here
        });
        
        document.getElementById("pendingBtn").addEventListener("click", function () {
            updateButtonColors(this);
            // Your other actions for the "Pending" button here
        });
        
        document.getElementById("historyBtn").addEventListener("click", function () {
            updateButtonColors(this);
            // Your other actions for the "History" button here
        });

        window.addEventListener("load", function () {
            var applyBtn = document.getElementById("applyBtn");
            applyBtn.style.backgroundColor = "skyblue";
        });
        
        function updateButtonColors(clickedButton) {
            const buttons = document.querySelectorAll(".button-group button");
        
            buttons.forEach(function (button) {
                if (button === clickedButton) {
                    button.style.backgroundColor = "skyblue"; // Change the background color of the clicked button to skyblue
                } else {
                    button.style.backgroundColor = ""; // Reset the background color of other buttons to default
                }
            });
        }
    </script>




<script>
        // Function to calculate the number of days between two dates
        function calculateDays() {
            var startDate = new Date(document.getElementById('startDate').value);
            var endDate = new Date(document.getElementById('endDate').value);

            // Calculate the difference in milliseconds
            var timeDifference = endDate - startDate;

            // Convert milliseconds to days
            var daysDifference = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));

            // Display the result in the "No. of days" input field
            document.getElementById('days').value = daysDifference;
        }

        // Attach the calculateDays function to the input fields' onchange event
        document.getElementById('startDate').addEventListener('change', calculateDays);
        document.getElementById('endDate').addEventListener('change', calculateDays);
    </script>

</body>
</html>
