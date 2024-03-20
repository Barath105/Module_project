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
    $date = $_POST['date']; // Retrieve the startDate from the form
    $title = $_POST['title']; // Retrieve the title from the form
    $ses = $_POST['ses']; // Retrieve the leaveType from the form
    $reason = $_POST['reason']; // Retrieve the reason from the form

    if (isset($_SESSION['userid'])) {
        $loggedUserEmployeeId = $_SESSION['userid'];

        if ($loggedUserEmployeeId == $employeeId) {
            // Specify the target directory for file uploads
            $targetDirectory = "uploads/";
            $file_name = uniqid() . '_' . $_FILES["pdf"]["name"]; // Generate a unique file name
            $targetFile = $targetDirectory . $file_name;
            $uploadOk = 1;

            // Check if the file already exists
            if (file_exists($targetFile)) {
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                        echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "File already exists",
                                }).then(function() {
                                    window.location.href = "i18.php";
                                });
                            </script>';
                $uploadOk = 0;
            }

            // Check file size (you can adjust this limit)
            if ($_FILES["pdf"]["size"] > 5000000) { // Adjust the size limit as needed
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "File is too large",
                        }).then(function() {
                            window.location.href = "i18.php";
                        });
                    </script>';
                $uploadOk = 0;
            }

            // Allow specific file types (PDF, JPG, and PNG)
            $allowedExtensions = array("pdf", "jpg", "png");
            $fileExtension = pathinfo($targetFile, PATHINFO_EXTENSION);

            if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                        echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Invalid file type. Only PDF, JPG, and PNG files are allowed.",
                                }).then(function() {
                                    window.location.href = "i18.php";
                                });
                            </script>';
                $uploadOk = 0;
            }

            // Check if all checks pass
            if ($uploadOk === 1) {
                // Move the uploaded file to the directory
                if (move_uploaded_file($_FILES["pdf"]["tmp_name"], $targetFile)) {
                    $dbHost = 'localhost';
                    $dbUser = 'root';
                    $dbPass = '';
                    $dbName = 'adminhr';

                    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Insert the data into the database
                    $sql = "INSERT INTO hrpermission (title, session, userid, date, reason, pdf, pdf_name) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssissss", $title, $ses, $employeeId, $date, $reason, $file_name, $file_name);

                    if ($stmt->execute()) {
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                        echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "Permission request successful!",
                                }).then(function() {
                                    window.location.href = "i18.php";
                                });
                            </script>';
                    } else {
                        echo "Error: " . $stmt->error; // Display the SQL error message
                    }

                    $stmt->close();
                    $conn->close();
                } else {
                    // File upload failed
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                        echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "File upload failed",
                                }).then(function() {
                                    window.location.href = "i18.php";
                                });
                            </script>';
                }
            } else {
                
            }
        } else {
            
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                        echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Userid does not matched, Please try again",
                                }).then(function() {
                                    window.location.href = "i18.php";
                                });
                            </script>';
    
        }
    } else {
        
        
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                        echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "User is not logged in. Please log in to access this page.",
                                }).then(function() {
                                    window.location.href = "i18.php";
                                });
                            </script>';
    }
}
?>
