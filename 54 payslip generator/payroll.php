<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css2?family=Urbanist:wght@100;200;300;400;500;600;700;800;900&display=swap' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <script src=
 "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js">
    </script>
    <script src=
 "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js">
    </script>
    <title>Payslip</title>
</head>
<body>
<?php
$currentMonth = date('F Y'); // Get the current month in the format "Month Year"
?>
<?php
        // Start the session
        session_start();

        // Database connection
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPass = '';
        $dbName = 'adminhr';

        $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if( isset($_GET['username']) && isset($_GET['userid'])) {
            
            $username = $_GET['username'];
            $userid = $_GET['userid'];
        }
        

            $userId = $userid;
            $transport=1000;
            $tax=800.00;
            $fund=500.00;
            
        
            // Database connection
            $dbHost = 'localhost';
            $dbUser = 'root';
            $dbPass = '';
            $dbName = 'adminhr'; // Replace 'your_database_name' with your actual database name
        
            $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
        
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        
            // Prepare and execute a SQL query to fetch the basic salary for the logged-in user
            $sql = "SELECT * FROM userinfo WHERE userid = '$userId'";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                // Fetch the basic salary from the result set
                $row = $result->fetch_assoc();
                $basicSalary = $row['basic_salary'];
                $houserent = $row['house_rent'];
                $position = $row['role'];

        
        
                // Close the database connection
                $conn->close();
            } else {
                echo "No records found for the user.";
            }


        // Check if the user is logged in and retrieve the user ID

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'adminhr'; // Replace 'your_database_name' with your actual database name

// Create connection
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sqlPresentDays = "SELECT COUNT(*) AS presentDays FROM useratt WHERE userid = '$userid' AND overall_att = 'Present'";

// Execute SQL query to fetch present days
$resultPresentDays = $conn->query($sqlPresentDays);

if ($resultPresentDays) {
    // Fetch the result of present days
    $rowPresentDays = $resultPresentDays->fetch_assoc();
    $presentDays = $rowPresentDays['presentDays'];
    
    // SQL query to fetch total no-of-days from hrleave table for Sick leave and Casual leave for a specific userid
    $sqlTotalSickDays = "SELECT SUM(`no-of-days`) AS totalSickDays FROM hrleave WHERE leaveType = 'Sick leave' AND employeeId = '$userid'";

    // Execute SQL query to fetch total sick days
    $resultTotalSickDays = $conn->query($sqlTotalSickDays);

    if ($resultTotalSickDays) {
        // Fetch the result of total sick days
        $rowTotalSickDays = $resultTotalSickDays->fetch_assoc();
        $totalSickDays = min($rowTotalSickDays['totalSickDays'], 4); // Limit to maximum of 4 days

        // SQL query to fetch total no-of-days from hrleave table for Casual leave for a specific userid
        $sqlTotalCasualDays = "SELECT SUM(`no-of-days`) AS totalCasualDays FROM hrleave WHERE leaveType = 'Casual leave' AND employeeId = '$userid'";

        // Execute SQL query to fetch total casual days
        $resultTotalCasualDays = $conn->query($sqlTotalCasualDays);

        if ($resultTotalCasualDays) {
            // Fetch the result of total casual days
            $rowTotalCasualDays = $resultTotalCasualDays->fetch_assoc();
            $totalCasualDays = min($rowTotalCasualDays['totalCasualDays'], 4); // Limit to maximum of 4 days

            // Add total sick days and total casual days to present days
            $presentDays += ($totalSickDays + $totalCasualDays);

            // Close the database connection
            $conn->close();
        } else {
            echo "Error executing the total casual days query: " . $conn->error;
        }
    } else {
        echo "Error executing the total sick days query: " . $conn->error;
    }
} else {
    echo "Error executing the present days query: " . $conn->error;
}



        $paidDays = $presentDays;

        // Check if paidDays is not zero to avoid division by zero error
        if ($paidDays !== 0) {
            // Calculate per-day salary rate
            $perDaySalary = $basicSalary / 30;
        
            // Calculate total amount
            $total = $perDaySalary * $paidDays;

            $total = intval($total);
        
        } else {
            echo "Error: Division by zero.";
        }

        // Calculate the basic salary
        // $bSalary = $perDaySalary;

        $total_deduction = $basicSalary-$total;

        $gross=$total+$houserent+$transport;

        $deduction=$tax+$fund;

        




        // OVERTIME
// Database connection settings
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'adminhr';

// Establish database connection
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute a SQL query to fetch the count of "Approved" entries
$sql = "SELECT COUNT(*) AS ApprovedCount FROM hrovertime WHERE status = 'Approved' AND userid='$userid'";
$result = $conn->query($sql);

// Check if query executed successfully
if ($result) {
    // Fetch the count from the result set
    $row = $result->fetch_assoc();
    $approvedCount = $row['ApprovedCount'];
    
} else {
    echo "Error executing query: " . $conn->error;
}

// Close the result set
$result->close();

$overtime=$approvedCount*($basicSalary/30)/2;

$overtime = intval($overtime);

    ?>

<div class="pdf" id="pdf">

    
    <header style="text-align: center; margin: 2.5%;">
        <img style="width:200px;height:200px" src="./EMP.png"/>
            
        <h1 style="margin-top: 2%; color: #344335; font-size: 16px; font-family: Urbanist; font-weight: 700; line-height: 20px; word-wrap: break-word">PAYSLIP  FOR THE MONTH OF <?php echo $currentMonth; ?></h1>

        <table style="border-collapse: collapse; width: 52.5%; margin: 0% auto; " >
            <tr>
                <th style="border: 1px solid #7C8D7E; padding: 1% 2%; text-align: left; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 600; line-height: 16px; word-wrap: break-word">
                Employee Name</th>
                <td style="border: 1px solid #7C8D7E; padding: 1% 2%; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; text-align: left;">
                <?php echo htmlspecialchars($username); ?></td>
                <th style="border: 1px solid #7C8D7E; padding: 1% 2%; text-align: left; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 600; line-height: 16px; word-wrap: break-word">
                Position</th>
                <td style="border: 1px solid #7C8D7E; padding: 1% 2%; text-align: left; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word">
                <?php echo htmlspecialchars($position); ?></td>
            </tr>
            <tr>
                <th style="border: 1px solid #7C8D7E;  padding: 1% 2%; text-align: left; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 600; line-height: 16px; word-wrap: break-word">
                Employee ID</th>
                <td style="border: 1px solid #7C8D7E; padding: 1% 2%; text-align: left; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word">
                <?php echo htmlspecialchars($userid); ?></td>
                <th style="border: 1px solid #7C8D7E;  padding: 1% 2%; text-align: left; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 600; line-height: 16px; word-wrap: break-word">
                Department</th>
                <td style="border: 1px solid #7C8D7E;  padding: 1% 2%; text-align: left; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word">
                IT</td>
            </tr>
            <tr>
                <th style="border: 1px solid #7C8D7E;  padding: 1% 2%; text-align: left; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 600; line-height: 16px; word-wrap: break-word">
                Location</th>
                <td style="border: 1px solid #7C8D7E;  padding: 1% 2%; text-align: left; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word">
                Chennai</td>
                <th style="border: 1px solid #7C8D7E; padding: 1% 2%; text-align: left; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 600; line-height: 16px; word-wrap: break-word">
                Month/Year</th>
                <td style="border: 1px solid #7C8D7E;  padding: 1% 2%; text-align: left; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word">
                <?php echo $currentMonth; ?></td>
                </tr>
        </table>
    </header>
    <main>
        <table style="border-collapse: collapse; width: 50%; margin: 0% auto;">
            <thead>
                <tr class="">
                    <th style="border: 1px solid #7C8D7E; background: #2B8C34; padding: 1% 2%; text-align: left; color: white; font-size: 14px; font-family: Urbanist; font-weight: 600; line-height: 18px; word-wrap: break-word; width: 1/3;">
                        Descriptions
                    </th>
                    <th style="border: 1px solid #7C8D7E; background: #2B8C34;  padding: 1% 2%; text-align: left; color: white; font-size: 14px; font-family: Urbanist; font-weight: 600; line-height: 18px; word-wrap: break-word; width: 1/3;">
                        Earnings
                    </th>
                    <th style="border: 1px solid #7C8D7E;  background: #2B8C34; padding: 1% 2%; text-align: left; color: white; font-size: 14px; font-family: Urbanist; font-weight: 600; line-height: 18px; word-wrap: break-word; width: 1/3;">
                        Deductions
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; padding: 1% 2%;">
                    Basic Salary</td>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; padding: 1% 2%;">
                    <strong><?php echo htmlspecialchars($basicSalary); ?></strong></td> 
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; padding: 1% 2%;">
                    <strong>Nil</strong></td> </td>
                </tr>

                <tr>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; padding: 1% 2%;">
                    Housing Allowance</td>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; padding: 1% 2%;">
                    <strong><?php echo htmlspecialchars($houserent); ?></strong></td>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; padding: 1% 2%;">
                    <strong>Nil</strong></td>
                </td>
                </tr>
                
                <tr>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; padding: 1% 2%;">
                    Transport Allowance</td>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; padding: 1% 2%;">
                    <strong><?php echo htmlspecialchars($transport); ?></strong></td>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; padding: 1% 2%;">
                    <strong>Nil</strong></td>
                </tr>

                <tr>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; padding: 1% 2%;">
                    Pay period</td>
                    <td style="border:none;color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; padding: 1% 2%;">
                            <input style="border:none;" class="text-wrapper-2" type="month" onchange="calculateLossOfPayDays(this)">
                    </td>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; padding: 1% 2%;">
                    <strong>Nil</strong></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; padding: 1% 2%;">
                    Paid days</td>
                    <td id="paidDaysCell" style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; padding: 1% 2%;">
                        <strong><?php echo htmlspecialchars($paidDays); ?></strong>
                    </td>

                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 400; line-height: 16px; word-wrap: break-word; padding: 1% 2%;">
                    <strong>Nil</strong></td>
                </tr>

                <tr>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist;  padding: 1% 2%;font-weight: 400; line-height: 16px; word-wrap: break-word"
                    >Loss of pay(Days)</td>
                    <td style="border:none;color: #344335; font-size: 12px; font-family: Urbanist;  padding: 1% 2%;font-weight: 400; line-height: 16px; word-wrap: break-word">
                        <input id="lossOfPayDays"  style="border:none;" type="number">
                    </td>
                    <td id="lossOfPayDays" style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist;  padding: 1% 2%;font-weight: 400; line-height: 16px; word-wrap: break-word">
                </td>
                </tr>

                <tr>
                    <th style="background: #F3D861; border: 1px solid #7C8D7E; color: #344335; font-size: 12px; padding: 1% 2%; text-align: left; font-family: Urbanist; font-weight: 600; line-height: 18px; word-wrap: break-word">
                    Gross Payable (a)</th>
                    <th style="background: #F3D861; border: 1px solid #7C8D7E; color: #344335; font-size: 16px; padding: 1% 2%; text-align: left; font-family: Urbanist; font-weight: 600; line-height: 18px; word-wrap: break-word">
                    <?php echo htmlspecialchars($gross); ?></th>
                    <th style="background: #F3D861; border: 1px solid #7C8D7E; color: #344335; font-size: 12px; padding: 1% 2%; text-align: left; font-family: Urbanist; font-weight: 600; line-height: 18px; word-wrap: break-word">
                    </th>
                </tr>


<!-- TAX -->








                <tr>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; padding: 1% 2%; font-weight: 400; line-height: 16px; word-wrap: break-word">
                    Taxable Pay</td>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; padding: 1% 2%; font-weight: 400; line-height: 16px; word-wrap: break-word">
                    <strong>Nil</strong></td>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; padding: 1% 2%; font-weight: 400; line-height: 16px; word-wrap: break-word">
                    <strong><?php echo htmlspecialchars($tax); ?></strong>
                </td>
                </tr>
                <tr>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; padding: 1% 2%;  font-weight: 400; line-height: 16px; word-wrap: break-word" >
                    Provident Fund</td>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; padding: 1% 2%; font-weight: 400; line-height: 16px; word-wrap: break-word">
                    <strong>Nil</strong></td>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist;  padding: 1% 2%;  font-weight: 400; line-height: 16px; word-wrap: break-word">
                    <strong><?php echo htmlspecialchars($fund); ?></strong></td>
                </tr>
                
                <tr>
                    <th style="background: #FBB7AB; border: 1px solid #7C8D7E; color: #344335; font-size: 12px; padding: 1% 2%; text-align: left; font-family: Urbanist; font-weight: 600; line-height: 18px; word-wrap: break-word">
                    Total Deductions (b)</th>
                    <th style=" background: #FBB7AB; border: 1px solid #7C8D7E; color: #344335; font-size: 12px; padding: 1% 2%; text-align: left; font-family: Urbanist; font-weight: 600; line-height: 18px; word-wrap: break-word">
                </th>
                    <th style=" background: #FBB7AB; border: 1px solid #7C8D7E; color: #344335; font-size: 16px; padding: 1% 2%; text-align: left; font-family: Urbanist; font-weight: 600; line-height: 18px; word-wrap: break-word">
                    <strong><?php echo htmlspecialchars( $deduction); ?></strong></th>
                </tr>
                <tr>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist;  padding: 1% 2%; font-weight: 400; line-height: 16px; word-wrap: break-word">
                    Overtime(Days)</td>
                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; padding: 1% 2%; font-weight: 400; line-height: 16px; word-wrap: break-word">
                    <strong>Total days: <?php echo htmlspecialchars($approvedCount); ?></strong><br>
                    <strong>Earnings: <?php echo htmlspecialchars($overtime); ?></strong></td>

                    <td style="border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist;   padding: 1% 2%; font-weight: 400; line-height: 16px; word-wrap: break-word">
                    <strong>Nil</strong></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th style="background: #A7EAAD; border: 1px solid #7C8D7E; color: #344335; font-size: 12px; font-family: Urbanist; font-weight: 700; line-height: 16px; word-wrap: break-word; text-align: left;  padding: 1% 2%;">
                    Net Salary</th>
                    <th colspan="2" style="background: #A7EAAD; border: 1px solid #7C8D7E;  padding: 1% 2%; text-align: center; color: #344335; font-size: 18px; font-family: Urbanist; font-weight: 700; line-height: 16px; word-wrap: break-word;">
                    Rs.<strong><?php echo htmlspecialchars($gross+$deduction+$overtime); ?></strong></th>
                </tr>
            </tfoot>
        </table>
    </main>

        <footer style="margin-top: 3%; text-align: center;">
            <img src="./signature.jpg" alt="HR signature" height="50"/>
            <hr style="width: 10%; text-align: center;  border: 0.50px #344335 solid"/>
            <h2 style="color: #344335; font-size: 14px; font-family: Urbanist; font-weight: 600; line-height: 18px; word-wrap: break-word; padding-bottom: 0%;">
            HUMAN RESOURCE MANAGER</h2>
            <h3 style="color: #344335; font-size: 14px; font-family: Urbanist; font-weight: 400; line-height: 18px; word-wrap: break-word; padding-top: 0%;">
            HR EMPLOYEE COMMUNITY</h3>
        </footer>
</div>
            <div style="margin-bottom:68px"></div>
            <div style="display: flex; justify-content: center; align-items: center;">
    <button onclick="generatePDF()" style="background-color: lightgreen; border: none; height: 50px; width: 200px; cursor: pointer; color: black; font-weight: 700;">Generate Payroll</button>
  </div>
                <div style="margin-bottom:100px"></div>

<script>
        // JavaScript for calculating Gross Earnings
        document.addEventListener('input', function (event) {
            if (event.target.id === 'basicInput' || event.target.id === 'hraInput') {
                calculateGrossEarnings();
            }
        });

        function calculateGrossEarnings() {
            // Get values from input fields
            var basicValue = parseFloat(document.getElementById('basicInput').value) || 0;
            var hraValue = parseFloat(document.getElementById('hraInput').value) || 0;

            // Calculate Gross Earnings
            var grossEarnings = basicValue + hraValue;

            // Update the Gross Earnings input field
            document.getElementById('grossEarningsInput').value = grossEarnings;
        }
    </script>
    <script>
        // JavaScript for calculating Gross Earnings and Total Deduction
        document.addEventListener('input', function (event) {
            if (
                event.target.id === 'basicInput' ||
                event.target.id === 'hraInput' ||
                event.target.id === 'incomeTaxInput' ||
                event.target.id === 'providentFundInput'
            ) {
                calculateGrossEarnings();
                calculateTotalDeduction();
            }
        });

        function calculateGrossEarnings() {
            // Get values from input fields
            var basicValue = parseFloat(document.getElementById('basicInput').value) || 0;
            var hraValue = parseFloat(document.getElementById('hraInput').value) || 0;

            // Calculate Gross Earnings
            var grossEarnings = basicValue + hraValue;

            // Update the Gross Earnings input field
            document.getElementById('grossEarningsInput').value = grossEarnings;
        }

        function calculateTotalDeduction() {
            // Get values from input fields
            var incomeTaxValue = parseFloat(document.getElementById('incomeTaxInput').value) || 0;
            var providentFundValue = parseFloat(document.getElementById('providentFundInput').value) || 0;

            // Calculate Total Deduction
            var totalDeduction = incomeTaxValue + providentFundValue;

            // Update the Total Deduction input field
            document.getElementById('totalDeductionInput').value = totalDeduction;
        }
    </script>

    <script>
        // JavaScript for calculating Gross Earnings, Total Deduction, and Total Payable
        document.addEventListener('input', function (event) {
            if (
                event.target.id === 'basicInput' ||
                event.target.id === 'hraInput' ||
                event.target.id === 'incomeTaxInput' ||
                event.target.id === 'providentFundInput'
            ) {
                calculateGrossEarnings();
                calculateTotalDeduction();
                calculateTotalPayable();
            }
        });

        function calculateGrossEarnings() {
            // Get values from input fields
            var basicValue = parseFloat(document.getElementById('basicInput').value) || 0;
            var hraValue = parseFloat(document.getElementById('hraInput').value) || 0;

            // Calculate Gross Earnings
            var grossEarnings = basicValue + hraValue;

            // Update the Gross Earnings input field
            document.getElementById('grossEarningsInput').value = grossEarnings;
        }

        function calculateTotalDeduction() {
            // Get values from input fields
            var incomeTaxValue = parseFloat(document.getElementById('incomeTaxInput').value) || 0;
            var providentFundValue = parseFloat(document.getElementById('providentFundInput').value) || 0;

            // Calculate Total Deduction
            var totalDeduction = incomeTaxValue + providentFundValue;

            // Update the Total Deduction input field
            document.getElementById('totalDeductionInput').value = totalDeduction;
        }

        function calculateTotalPayable() {
            // Get values from input fields
            var grossEarnings = parseFloat(document.getElementById('grossEarningsInput').value) || 0;
            var totalDeduction = parseFloat(document.getElementById('totalDeductionInput').value) || 0;

            // Calculate Total Payable
            var totalPayable = grossEarnings - totalDeduction;

            // Update the Total Payable input field
            document.getElementById('totalPayableInput').value = totalPayable;
        }
    </script>
    <script type="text/javascript">
        function generatePDF() {
            const { jsPDF } = window.jspdf;

            let doc = new jsPDF('l', 'mm', [1500, 1400]);
            let pdfjs = document.querySelector('#pdf');

            doc.html(pdfjs, {
                callback: function(doc) {
                    doc.save("payroll.pdf");
                },
                x: 12,
                y: 12
            });                
        }            
    </script>




    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Retrieve username and userid from session storage
            var generatedUsername = sessionStorage.getItem('generatedUsername');
            var generatedUserId = sessionStorage.getItem('generatedUserId');
        
            // Now you can use generatedUsername and generatedUserId as needed
            console.log('Generated Username:', generatedUsername);
            console.log('Generated UserID:', generatedUserId);
        
            // Clear session storage after use (optional)
            sessionStorage.removeItem('generatedUsername');
            sessionStorage.removeItem('generatedUserId');
        });
        </script>

        <script>
            function updateMonthAndYear() {
              // Create an array of month names
            const monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
        
              // Get the current date
            const currentDate = new Date();
        
              // Get the month and year
            const currentMonth = monthNames[currentDate.getMonth()];
            const currentYear = currentDate.getFullYear();
        
              // Update the content of the div
            const textWrapper = document.getElementById("currentMonthYear");
            textWrapper.textContent = `${currentMonth} ${currentYear}`;
            }
        
            // Call the function initially to set the initial content
            updateMonthAndYear();
        
            // Set up an interval to update the content every minute (adjust as needed)
            setInterval(updateMonthAndYear, 60000); // Update every minute
        </script>



<script>
    function calculateLossOfPayDays(monthInput) {
        console.log('calculateLossOfPayDays function called');
        // Get the selected month from the input field
        var selectedMonth = new Date(monthInput.value);
        // Get the year and month separately
        var year = selectedMonth.getFullYear();
        var month = selectedMonth.getMonth() + 1; // JavaScript months are 0-based
        
        // Get the number of days in the selected month
        var daysInMonth = new Date(year, month, 0).getDate();

        // Get the number of present days (replace this with your actual present days calculation)
        var presentDays = <?php echo $presentDays; ?>; // Assuming $presentDays is available

        // Calculate the loss of pay days
        var lossOfPayDays = daysInMonth - presentDays;

        // Update the loss of pay days input field
        document.getElementById('lossOfPayDays').value = lossOfPayDays;
    }
</script>


</body>
</html>