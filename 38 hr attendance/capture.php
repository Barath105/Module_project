<?php
session_start(); // Start the session
$servername = "localhost";
$username = "root"; // Changed from $hrname to $username for consistency
$password = "";
$dbname = "adminhr";

date_default_timezone_set('Asia/Kolkata');

$conn = new mysqli($servername, $username, $password, $dbname); // Fixed variable name

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION["hrid"]) && isset($_SESSION["hrname"])) {
    $hrid = $_SESSION["hrid"];
    $hrname = $_SESSION["hrname"];

    // Use CURTIME() to get the current time
    $currentTime = date("H:i:s");
    $currentDate = date("Y-m-d");

    // Define your time slots and corresponding att_time columns
    $timeSlots = array(
        "att1" => array("start" => "08:00", "end" => "08:28"),
        "att2" => array("start" => "08:29", "end" => "09:50"),
        "att3" => array("start" => "09:50", "end" => "15:00"),
        "att4" => array("start" => "17:00", "end" => "18:00")
    );

    // Find the appropriate attendance slot
    $attendanceSlot = "";
    $attTimeColumn = "";

    $validTimeSlot = false;

    foreach ($timeSlots as $slot => $times) {
        if ($currentTime >= $times["start"] && $currentTime < $times["end"]) {
            $attendanceSlot = $slot;
            $attTimeColumn = $slot . "_time"; // Construct the corresponding time column name
            $validTimeSlot = true;
            break; // No need to check further
        }
    }

    if (!$validTimeSlot) {
        // User is trying to mark attendance outside of the specified time slots
        echo '<script>alert("You are not able to access attendance right now. Please wait for the next slot."); window.location.href = "../36 hr home/i36.php";</script>';
    } else {
        // Check if the user is late
        if ($currentTime > $timeSlots[$attendanceSlot]["end"] && $currentTime <= "08:10") {
            $lateColumn = $attendanceSlot . "_late";
            $lateTimeColumn = $attendanceSlot . "_late_time";

            // Check if the user has already marked attendance as late for this time slot on the same day
            $sqlCheckLateAttendance = "SELECT $lateColumn FROM hratt WHERE hrid = ? AND attendance_date = ?";
            $stmtCheckLateAttendance = $conn->prepare($sqlCheckLateAttendance);

            if ($stmtCheckLateAttendance) {
                $stmtCheckLateAttendance->bind_param("ss", $hrid, $currentDate);
                $stmtCheckLateAttendance->execute();
                $result = $stmtCheckLateAttendance->get_result();
            

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    if ($row[$lateColumn] == 'late') {
                        // The user has already marked attendance as late for this time slot today
                        echo '<script>alert("You have already marked attendance as late for ' . $attendanceSlot . ' today."); window.location.href = "../4 emp home/i4.php";</script>';
                    } else {
                        // Update the specific attendance slot and late time for the user and date
                        $sqlUpdateLateAttendance = "UPDATE hratt SET $lateColumn = 'late', $lateTimeColumn = ? WHERE hrid = ? AND attendance_date = ?";
                        $stmtUpdateLateAttendance = $conn->prepare($sqlUpdateLateAttendance);

                        if ($stmtUpdateLateAttendance) {
                            $stmtUpdateLateAttendance->bind_param("sss", $currentTime, $hrid, $currentDate);
                            if ($stmtUpdateLateAttendance->execute()) {
                                // Display an alert using JavaScript and redirect to the home page
                                echo '<script>alert("localhost says: Attendance marked as \'late\' for ' . $attendanceSlot . ' at ' . $currentTime . ' by ' . $hrname . '"); window.location.href = "../4 emp home/i4.php";</script>';
                            } else {
                                echo "Error updating late attendance: " . $stmtUpdateLateAttendance->error;
                            }
                        } else {
                            echo "Error preparing late update statement: " . $conn->error;
                        }
                    }
                } else {
                    // If no existing late attendance record is found, create a new one for the user
                    $sqlInsertLateAttendance = "INSERT INTO hratt (hrid, hrname, attendance_date, $lateColumn, $lateTimeColumn) VALUES (?, ?, ?, 'late', ?)";
                    
                    $stmtInsertLateAttendance = $conn->prepare($sqlInsertLateAttendance);

                    if ($stmtInsertLateAttendance) {
                        $stmtInsertLateAttendance->bind_param("ssss", $hrid, $hrname, $currentDate, $currentTime);
                        if ($stmtInsertLateAttendance->execute()) {
                            // Display an alert using JavaScript and redirect to the home page
                            echo '<script>alert("localhost says: New late attendance record created and marked as \'late\' for ' . $attendanceSlot . ' at ' . $currentTime . ' by ' . $hrname . '"); window.location.href = "../4 emp home/i4.php";</script>';
                        } else {
                            // Display an alert using JavaScript and redirect to the home page
                            echo '<script>alert("localhost says: Error creating late attendance record: ' . $stmtInsertLateAttendance->error . '"); window.location.href = "../36 hr home/i36.php";</script>';
                        }
                    } else {
                        echo "Error preparing late insert statement: " . $conn->error;
                    }
                }

                $stmtCheckLateAttendance->close();
            } else {
                echo "Error preparing late check statement: " . $conn->error;
            }
        } else {
            // Query to check if the user has already marked attendance for this time slot on the same day
            $sqlCheckAttendance = "SELECT $attendanceSlot FROM hratt WHERE hrid = ? AND attendance_date = ?";
            $stmtCheckAttendance = $conn->prepare($sqlCheckAttendance);
            if ($stmtCheckAttendance) {
                $stmtCheckAttendance->bind_param("ss", $hrid, $currentDate);
                $stmtCheckAttendance->execute();
                $result = $stmtCheckAttendance->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    if ($row[$attendanceSlot] == 'present') {
                        // The user has already marked attendance for this time slot today
                        echo '<script>alert("You have already marked attendance for ' . $attendanceSlot . ' today."); window.location.href = "../36 hr home/i36.php";</script>';
                    } else {
                        // Update the specific attendance slot and att_time for the user and date
                        $sqlUpdateAttendanceSlot = "UPDATE hratt SET $attendanceSlot = 'present', $attTimeColumn = ? WHERE hrid = ? AND attendance_date = ?";
                        $stmtUpdateAttendanceSlot = $conn->prepare($sqlUpdateAttendanceSlot);

                        if ($stmtUpdateAttendanceSlot) {
                            $stmtUpdateAttendanceSlot->bind_param("sss", $currentTime, $hrid, $currentDate);
                            if ($stmtUpdateAttendanceSlot->execute()) {
                                // Display an alert using JavaScript and redirect to the home page
                                echo '<script>alert("localhost says: Attendance marked as \'present\' for ' . $attendanceSlot . ' at ' . $currentTime . ' by ' . $hrname . '"); window.location.href = "../4 emp home/i4.php";</script>';
                            } else {
                                echo "Error updating attendance slot: " . $stmtUpdateAttendanceSlot->error;
                            }
                        } else {
                            echo "Error preparing update statement: " . $conn->error;
                        }
                    }
                } else {
                    // If no existing attendance record is found, create a new one for the user
                    $sqlInsertAttendance = "INSERT INTO hratt (hrid, hrname, attendance_date, $attendanceSlot, $attTimeColumn) VALUES (?, ?, ?, 'present', ?)";  
                    $stmtInsertAttendance = $conn->prepare($sqlInsertAttendance);
                    if ($stmtInsertAttendance) {
                        $stmtInsertAttendance->bind_param("ssss", $hrid, $hrname, $currentDate, $currentTime);
                        if ($stmtInsertAttendance->execute()) {
                            // Display an alert using JavaScript and redirect to the home page
                            echo '<script>alert("localhost says: New attendance record created and marked as \'present\' for ' . $attendanceSlot . ' at ' . $currentTime . ' by ' . $hrname . '"); window.location.href = "../36 hr home/i36.php";</script>';
                        } else {
                            // Display an alert using JavaScript and redirect to the home page
                            echo '<script>alert("localhost says: Error creating attendance record: ' . $stmtInsertAttendance->error . '"); window.location.href = "../36 hr home/i36.php";</script>';
                        }
                    } else {
                        echo "Error preparing insert statement: " . $conn->error;
                    }
                }
                $stmtCheckAttendance->close();
            } else {
                echo "Error preparing check statement: " . $conn->error;
            }
        }
    }
}
$conn->close();
?>
