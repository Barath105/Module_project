<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .swal2-popup {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <?php
    session_start(); // Start or resume the session

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form data
        $employeeId = $_POST['employeeId']; // Retrieve the employeeId from the form
        $startDate = $_POST['startDate']; // Retrieve the startDate from the form
        $endDate = $_POST['endDate']; // Retrieve the endDate from the form
        $days = $_POST['days'];
        $title = $_POST['title']; // Retrieve the title from the form
        $reason = $_POST['reason']; // Retrieve the reason from the form

        // Retrieve the 'pdf' file and 'pdf_name' from the uploaded file
        $pdf_name = $_FILES['pdf']['name'];
        $pdf_tmp_name = $_FILES['pdf']['tmp_name'];

        // ... Your code to validate and process 'pdf', 'pdf_name', and other form data ...
        $uploadDirectory = __DIR__ . '/uploads/'; // Assuming a directory named 'uploads' in the same directory as this script

        // Check if the directory exists, and create it if it doesn't
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        // Check if the submitted employeeId matches the logged-in user's employeeId (userid) stored in the session
        if (isset($_SESSION['userid'])) {
            $loggedUserEmployeeId = $_SESSION['userid'];

            if ($loggedUserEmployeeId == $employeeId) {
                // The submitted employeeId matches the logged-in user's employeeId (userid)
                // Proceed with the form data processing and database insertion.

                // ... Your existing code for database connection ...

                $dbHost = 'localhost';
                $dbUser = 'root';
                $dbPass = '';
                $dbName = 'adminhr';

                $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Validate and format the date
                $startDateTimestamp = strtotime($startDate);
                $endDateTimestamp = strtotime($endDate);

                if ($startDateTimestamp === false || $endDateTimestamp === false) {
                    echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Invalid date format. Please use mm/dd/yy.",
                            }).then(function() {
                                window.location.href = "i24.php";
                            });
                        </script>';
                } else {
                    $startDate = date('y/m/d', $startDateTimestamp);
                    $endDate = date('y/m/d', $endDateTimestamp);

                    // Read the 'pdf' file
                    $pdf = file_get_contents($pdf_tmp_name);

                    // Example SQL and data insertion code:
                    $sql = "INSERT INTO hrod (title,employeeId, startDate, endDate, `no-of-days`, reason, pdf, pdf_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sissssss", $title, $employeeId, $startDate, $endDate, $days, $reason, $pdf, $pdf_name);

                    if ($stmt->execute()) {
                        $uploadedFilePath = $uploadDirectory . $pdf_name;
                        move_uploaded_file($_FILES['pdf']['tmp_name'], $uploadedFilePath);
                        echo '<script>
                                Swal.fire({
                                    icon: "success",
                                    title: "OD request successful!",
                                }).then(function() {
                                    window.location.href = "i24.php";
                                });
                            </script>';
                    } else {
                        echo '<script>
                                Swal.fire({
                                    icon: "error",
                                    title: "Error occurred while processing the request.",
                                }).then(function() {
                                    window.location.href = "i24.php";
                                });
                            </script>';
                    }

                    $stmt->close();
                }

                $conn->close();
            } else {
                // The submitted employeeId doesn't match the logged-in user's employeeId (userid)
                // Display an error message
                echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "EmployeeId does not match",
                        }).then(function() {
                            window.location.href = "i24.php";
                        });
                    </script>';
            }
        } else {
            // The user is not logged in
            // Display an error message or redirect to a login page
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "User is not logged in. Please log in to access this page.",
                    }).then(function() {
                        window.location.href = "i24.php";
                    });
                </script>';
            
        }
    }
    ?>
</body>
</html>
