<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    
    <?php
session_start();

// Replace these variables with your actual database connection parameters
$hostname = "localhost";
$username = "root";
$password = "";
$database = "adminhr";

// Create a connection to the database using the defined variables
$mysqli = new mysqli($hostname, $username, $password, $database);

// Check if the connection was successful
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loggedUserId = $_SESSION['userid']; // Get the logged-in user's ID from the session
    $loggedUsername = $_SESSION['username']; // Get the logged-in user's username from the session

    $employeeId = $_POST["employeeId"];
    $date = $_POST["date"];

    // Attempt to parse the date from the mm/dd/yy format
    $timestamp = strtotime($date);
    if ($timestamp === false) {
        echo "Invalid date format. Please use mm/dd/yy.";
    } else {
        // Format the date to yy/mm/dd for the database
        $req_date = date('y/m/d', $timestamp);

        // Perform validation
        if (!empty($loggedUserId) && !empty($loggedUsername) && !empty($employeeId) && !empty($req_date)) {
            // Check if the user exists in the userinfo table
            $checkQuery = "SELECT userid FROM userinfo WHERE userid = ? AND username = ?"; // Replace 'employee_id' and 'username' with the actual column names
            $checkStmt = $mysqli->prepare($checkQuery);
            $checkStmt->bind_param("ss", $employeeId, $loggedUsername);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                $row = $checkResult->fetch_assoc();
                $userid = $row['userid'];

                // User exists, insert the pay slip request if the logged-in user's ID matches
                if ($loggedUserId == $userid) {
                    $insertQuery = "INSERT INTO hrpayslip (userid, username, date) VALUES (?, ?, ?)";
                    $insertStmt = $mysqli->prepare($insertQuery);
                    $insertStmt->bind_param("sss", $userid, $loggedUsername, $req_date);

                    if ($insertStmt->execute()) {
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                        echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "Pay slip request submitted successfully",
                                }).then(function() {
                                    window.location.href = "i16.php";
                                });
                            </script>';
                    } else {
                        echo "Error submitting pay slip request: " . $insertStmt->error;
                    }

                    $insertStmt->close();
                } else {
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Employee ID does not match",
                            text: "Please check your input",
                            }).then(function() {
                                window.location.href = "i16.php";
                            });
                        </script>';
                }
            } else {
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Employee ID or Username does not exist",
                        text: "Please check your input",
                        }).then(function() {
                            window.location.href = "i16.php";
                        });
                    </script>';
            }
        }

        if (isset($checkStmt)) {
            $checkStmt->close();
        }
    }
}

// Close the database connection when you're done
$mysqli->close();
?>
</body>
</html>