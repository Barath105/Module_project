<?php
session_start(); // Start the session
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminhr";

date_default_timezone_set('Asia/Kolkata');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION["userid"]) && isset($_SESSION["username"])) {
    $userID = htmlspecialchars($_SESSION["userid"]);
    $username = htmlspecialchars($_SESSION["username"]);

    // Use time() to get the current time as Unix timestamp
    $currentTime = time();
    $currentDate = date("Y-m-d");

    // Define your time slots and corresponding att_time columns
    $timeSlots = array(
        "att1" => array("start" => strtotime("07:15"), "end" => strtotime("08:00")),  //7:15-8 (Morning-check in)
        "att2" => array("start" => strtotime("12:00"), "end" => strtotime("18:00")), //5-6 (Evening check out)
        "late" => array("start" => strtotime("08:01"), "end" => strtotime("08:20"))
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
        echo '<script>alert("You are not able to access attendance right now. Please wait for the next slot."); window.location.href = "../4 emp home/i4.php";</script>';
    } else {
        // Check if the user is late
        $lateEndTime = strtotime("08:20");

        if ($currentTime > $timeSlots[$attendanceSlot]["end"] && $currentTime <= $lateEndTime) {
            $lateColumn = $attendanceSlot . "_late";
            $lateTimeColumn = $attendanceSlot . "_late_time";

            // Check if the user has already marked attendance as late for this time slot today
            $sqlCheckLateAttendance = "SELECT $lateColumn FROM useratt WHERE userid = ? AND attendance_date = ?";
            $stmtCheckLateAttendance = $conn->prepare($sqlCheckLateAttendance);

            if ($stmtCheckLateAttendance) {
                $stmtCheckLateAttendance->bind_param("ss", $userID, $currentDate);
                $stmtCheckLateAttendance->execute();
                $result = $stmtCheckLateAttendance->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    if ($row[$lateColumn] == 'late') {
                        // The user has already marked attendance as late for this time slot today
                        echo '<script>alert("You have already marked attendance as late for ' . $attendanceSlot . ' today."); window.location.href = "../4 emp home/i4.php";</script>';
                    } else {
                        // Update the specific attendance slot and late time for the user and date
                        $sqlUpdateLateAttendance = "UPDATE useratt SET $lateColumn = 'late', $lateTimeColumn = ?, att1 = 'present' WHERE userid = ? AND attendance_date = ?";
                        $stmtUpdateLateAttendance = $conn->prepare($sqlUpdateLateAttendance);

                        if ($stmtUpdateLateAttendance) {
                            $stmtUpdateLateAttendance->bind_param("sss", date("H:i:s", $currentTime), $userID, $currentDate);
                            if ($stmtUpdateLateAttendance->execute()) {
                                // Display an alert using JavaScript and redirect to the home page
                                echo '<script>alert("localhost says: Attendance marked as \'late\' for ' . $attendanceSlot . ' at ' . date("H:i:s", $currentTime) . ' by ' . $username . '"); window.location.href = "../4 emp home/i4.php";</script>';
                            } else {
                                echo "Error updating late attendance: " . $stmtUpdateLateAttendance->error;
                            }
                        } else {
                            echo "Error preparing late update statement: " . $conn->error;
                        }
                    }
                } else {
                    // If no existing late attendance record is found, create a new one for the user
                    $sqlInsertLateAttendance = "INSERT INTO useratt (userid, username, attendance_date, $lateColumn, $lateTimeColumn, att1) VALUES (?, ?, ?, 'late', ?, 'present')";
                    
                    $stmtInsertLateAttendance = $conn->prepare($sqlInsertLateAttendance);

                    if ($stmtInsertLateAttendance) {
                        $stmtInsertLateAttendance->bind_param("ssss", $userID, $username, $currentDate, date("H:i:s", $currentTime));
                        if ($stmtInsertLateAttendance->execute()) {
                            // Display an alert using JavaScript and redirect to the home page
                            echo '<script>alert("localhost says: New late attendance record created and marked as \'late\' for ' . $attendanceSlot . ' at ' . date("H:i:s", $currentTime) . ' by ' . $username . '"); window.location.href = "../4 emp home/i4.php";</script>';
                        } else {
                            // Display an alert using JavaScript and redirect to the home page
                            echo '<script>alert("localhost says: Error creating late attendance record: ' . $stmtInsertLateAttendance->error . '"); window.location.href = "../4 emp home/i4.php";</script>';
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
            $sqlCheckAttendance = "SELECT $attendanceSlot, $attTimeColumn FROM useratt WHERE userid = ? AND attendance_date = ?";
            $stmtCheckAttendance = $conn->prepare($sqlCheckAttendance);
            if ($stmtCheckAttendance) {
                $stmtCheckAttendance->bind_param("ss", $userID, $currentDate);
                $stmtCheckAttendance->execute();
                $result = $stmtCheckAttendance->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    if ($row[$attendanceSlot] == 'present') {
                        // The user has already marked attendance for this time slot today
                        echo '<script>alert("You have already marked attendance for ' . $attendanceSlot . ' today."); window.location.href = "../4 emp home/i4.php";</script>';
                    } else {
                        // Update the specific attendance slot and att_time for the user and date
                        $sqlUpdateAttendanceSlot = "UPDATE useratt SET $attendanceSlot = 'present', $attTimeColumn = ?, att1 = 'present' WHERE userid = ? AND attendance_date = ?";
                        $stmtUpdateAttendanceSlot = $conn->prepare($sqlUpdateAttendanceSlot);

                        if ($stmtUpdateAttendanceSlot) {
                            $stmtUpdateAttendanceSlot->bind_param("sss", date("H:i:s", $currentTime), $userID, $currentDate);
                            if ($stmtUpdateAttendanceSlot->execute()) {
                                // Display an alert using JavaScript and redirect to the home page
                                echo '<script>alert("localhost says: Attendance marked as \'present\' for ' . $attendanceSlot . ' at ' . date("H:i:s", $currentTime) . ' by ' . $username . '"); window.location.href = "../4 emp home/i4.php";</script>';
                            } else {
                                echo "Error updating attendance slot: " . $stmtUpdateAttendanceSlot->error;
                            }
                        } else {
                            echo "Error preparing update statement: " . $conn->error;
                        }
                    }
                } else {
                    // If no existing attendance record is found, create a new one for the user
                    $sqlInsertAttendance = "INSERT INTO useratt (userid, username, attendance_date, $attendanceSlot, $attTimeColumn) VALUES (?, ?, ?, 'present', ?)";

                    $stmtInsertAttendance = $conn->prepare($sqlInsertAttendance);
                    if ($stmtInsertAttendance) {
                        $stmtInsertAttendance->bind_param("ssss", $userID, $username, $currentDate, date("H:i:s", $currentTime));
                        if ($stmtInsertAttendance->execute()) {
                            // Display an alert using JavaScript and redirect to the home page
                            echo '<script>alert("localhost says: New attendance record created and marked as \'present\' for ' . $attendanceSlot . ' at ' . date("H:i:s", $currentTime) . ' by ' . $username . '"); window.location.href = "../4 emp home/i4.php";</script>';
                        } else {
                            // Display an alert using JavaScript and redirect to the home page
                            echo '<script>alert("localhost says: Error creating attendance record: ' . $stmtInsertAttendance->error . '"); window.location.href = "../4 emp home/i4.php";</script>';
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

        // Determine the overall attendance status based on att1 and att2
        $fnAttStatus = checkAttendanceStatus("att1");
        $att2Status = checkAttendanceStatus("att2");

        $overallAttStatus = "absent";

        // Check if either att1 or att2 is present
        if ($fnAttStatus == "present" || $att2Status == "present") {
            $overallAttStatus = "present";
        }

        // Check if either att1 or att2 is absent, then mark overall_att as "Absent"
        if ($fnAttStatus == "absent" || $att2Status == "absent") {
            $overallAttStatus = "absent";
        }

        // Update overall_att in the database
        $sqlUpdateOverallAttendance = "UPDATE useratt SET overall_att = ? WHERE userid = ? AND attendance_date = ?";
        $stmtUpdateOverallAttendance = $conn->prepare($sqlUpdateOverallAttendance);

        if ($stmtUpdateOverallAttendance) {
            $stmtUpdateOverallAttendance->bind_param("sss", $overallAttStatus, $userID, $currentDate);
            if (!$stmtUpdateOverallAttendance->execute()) {
                echo "Error updating overall_att: " . $stmtUpdateOverallAttendance->error;
            }
        } else {
            echo "Error preparing overall_att update statement: " . $conn->error;
        }
    }
}

$conn->close();

// Function to check the attendance status for a specific time slot
function checkAttendanceStatus($timeSlot)
{
    global $conn, $userID, $currentDate;

    $sqlCheckAttendance = "SELECT $timeSlot FROM useratt WHERE userid = ? AND attendance_date = ?";
    $stmtCheckAttendance = $conn->prepare($sqlCheckAttendance);

    if ($stmtCheckAttendance) {
        $stmtCheckAttendance->bind_param("ss", $userID, $currentDate);
        $stmtCheckAttendance->execute();
        $result = $stmtCheckAttendance->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row[$timeSlot];
        } else {
            // No existing attendance record found, consider as absent
            return "absent";
        }
    } else {
        echo "Error preparing check statement: " . $conn->error;
        return "error";
    }
}
?>
