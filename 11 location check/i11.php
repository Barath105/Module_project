<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        /* Reset some default styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Style the container frame */
        .frame {
            text-align: center;
            background-color: #a3acf842;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            width: 300px;
            height: 200px;
            left: 122px;
            top: 20px;
        }

        /* Style the button */
        button {
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin: 10px;
            transition: background-color 0.3s ease; /* Smooth button transition */
        }

        /* Style the "Mark Attendance" button */
        #markAttendanceButton {
            background-color: #f7ce68;
            position: relative;
            left: 0px;
            top: 20px;
            color:black;
        }

        /* Style the "Go Back" button */
        #goBackButton {
            background-color: #e74c3c;
        }

        /* Style the "Capture" button */
        #captureButton {
            background-color: #f39c12;
            position: relative;
            left: 96px;
            top: 20px;
        }

        /* Style the paragraph displaying location status */
        #locationStatus {
            font-size: 18px;
            margin: 10px;
        }

        /* Style the image */
        #selfieImage {
            max-width: 100%;
            height: auto;
            margin: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: none; /* Initially hidden */
        }

        header {
            background:linear-gradient(45deg, #a3acf8, #c9cef5);
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
            color: blue;
        }
        #videoContainer {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Style the video element */
        video {
            max-width: 200px;
            height: 200px;
            border-radius: 145%;
            object-fit: cover;
            position: fixed;
            left: 68%;
            top: 246px;
        }

        /* Define a bounce animation */
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Apply the bounce animation to the "Mark Attendance" button */
        .bounce-once {
            animation: bounce 0.5s ease;
        }

        body {
            overflow: hidden;
            background: url('bg.jpg') no-repeat center center fixed;
            background-size: cover;
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
        .frame {
            animation: fadeIn 1s ease;
            background-color:#a3acf842;
        }
/* Add CSS for the "Home" link on hover */
.text-hi a:hover {
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



.footer {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  color: black;
  text-align: center;
  padding: 20px 0;
  background-image: linear-gradient(to right, #a3acf8, #a1a7dd);
  /* Replace #ff8a00 and #da1b60 with your desired colors */
  /* animation: footerAnimation 5s infinite; */
}

.footer-content {
  font-size: 14px;
}

.footer-content p {
  margin: 0;
}


.cartoon img {
    max-width: 100%; /* Ensure the image doesn't exceed its container */
    display: block; /* Ensure the image behaves as a block element */
    border-radius: 5px; /* Add rounded corners to the image */
    left:8%;
    top:20%;
    width:400px;
}


    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>
</head>
<body>
    
<header style="position: relative;top: -285px;width:100%;left: 0px;height: 36px">
            <nav style="position: relative;width: 1200px">
                <div class="logo" style="position: relative;top: -5px;left: 128px">
                    <i class="fas fa-home"></i>Attendance</div>
                <ul>
                    <li><a href="../4 emp home/i4.php" style="position: relative;left: 110px;top:-6px;">Home</a></li>
                </ul>
            </nav>
</header>
    
    <img src="EMP.png">
    
    <div class="frame" style="position: fixed;left: 42%;top: 36%;">
        <p id="dateTime"></p>
        <button id="markAttendanceButton">Mark Attendance</button>
        <p id="locationStatus"></p>
        <a href="../10 pick loc/i10.html" style="position:relative;">
            <button id="goBackButton" style="display: none;">Go Back</button>
        </a>
        <a href="storeimg.php" style="text-decoration: none;">
            <button id="captureButton" style="display: none;">Capture</button>
        </a>
        <img id="selfieImage" style="display: none;" alt="Selfie Image">
    </div>

    <div class="cartoon">
    <img src="img.jpg">
</div>


    <footer class="footer">
                <div class="footer-content">
                    <p>&copy; 2024 HR Employee. All rights reserved.</p>
                </div>
            </footer>

<script>
    const markAttendanceButton = document.getElementById("markAttendanceButton");
    const locationStatus = document.getElementById("locationStatus");
    const goBackButton = document.getElementById("goBackButton");
    const captureButton = document.getElementById("captureButton");
    const selfieImage = document.getElementById("selfieImage");
    const dateTimeElement = document.getElementById("dateTime");
    const videoContainer = document.getElementById("videoContainer"); // Added video container
    const cameraStream = document.getElementById("cameraStream"); // Added video element
    let stream;

    let attendanceMarked = false; // Add this variable to track if attendance has been marked

    function displayCurrentTimeInKolkata() {
        // Get the current time in Kolkata time zone
        const kolkataTimeZone = "Asia/Kolkata";
        const now = new Date();
        const options = { timeZone: kolkataTimeZone, hour12: true };
        const currentDateTime = now.toLocaleString("en-US", options);

        // Display the current time
        dateTimeElement.textContent = `Current Date and Time (Kolkata): ${currentDateTime}`;
    }

    markAttendanceButton.addEventListener("click", async () => {
        if (attendanceMarked) {
            // If attendance has already been marked, do nothing
            return;
        }

        const isLocationMatched = await checkLocation();

        if (isLocationMatched) {
            // Get the current time in Kolkata time zone
            const kolkataTimeZone = "Asia/Kolkata";
            const now = new Date();
            const options = { timeZone: kolkataTimeZone, hour12: true };
            const currentDateTime = now.toLocaleString("en-US", options);

            // Define time slots for attendance
            const att1StartTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 8, 0, 0); // 8:00 AM
            const att2StartTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 11, 0, 0); // 11:00 AM
            // const att3StartTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 16, 0, 0); // 4:00 PM
            // const att4StartTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 20, 30, 0); // 8:30 PM

            // Check if the current time falls within the defined time slots
            if (now >= att1StartTime && now < att2StartTime) {
                // Mark attendance for att1
                markAttendance('att1');
            } else if (now >= att2StartTime && now < att3StartTime) {
                // Mark attendance for att2
                markAttendance('att2');
            }else {
                // User tried to mark attendance outside of defined time slots
                alert("You do not have access to mark attendance at this time.");
            }
        } else {
            locationStatus.textContent = "Location not matched!";
            goBackButton.style.display = "block";
        }

        // Call the function to display current time in Kolkata
        displayCurrentTimeInKolkata();
    });

    captureButton.addEventListener("click", () => {
        captureImageAndStore();
    });

    async function checkLocation() {
        const predefinedLatitude = 13.0514944// Replace with your latitude
        const predefinedLongitude = 80.2029568 // Replace with your longitude

        try {
            const position = await getCurrentPosition();

            const distance = calculateDistance(
                predefinedLatitude,
                predefinedLongitude,
                position.coords.latitude,
                position.coords.longitude
            );

            const proximityThreshold = 100000; // Adjust as needed

            if (distance <= proximityThreshold) {
                locationStatus.textContent = "Location matched!";
                showCameraStream();
                return true;
            } else {
                locationStatus.textContent = "Location not matched!";
                goBackButton.style.display = "block";
                return false;
            }
        } catch (error) {
            console.error("Error getting user location:", error);
            alert("Unable to access location. Please check your browser settings.");
            return false;
        }
    }

    function getCurrentPosition() {
        return new Promise((resolve, reject) => {
            navigator.geolocation.getCurrentPosition(
                (position) => resolve(position),
                (error) => reject(error)
            );
        });
    }

    function calculateDistance(lat1, lon1, lat2, lon2) {
        const earthRadius = 6371e3;
        const radLat1 = (Math.PI * lat1) / 180;
        const radLat2 = (Math.PI * lat2) / 180;
        const deltaLat = (Math.PI * (lat2 - lat1)) / 180;
        const deltaLon = (Math.PI * (lon2 - lon1)) / 180;

        const a =
            Math.sin(deltaLat / 2) * Math.sin(deltaLat / 2) +
            Math.cos(radLat1) * Math.cos(radLat2) * Math.sin(deltaLon / 2) * Math.sin(deltaLon / 2);

        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        const distance = earthRadius * c;

        return distance;
    }

    function showCameraStream() {
        navigator.mediaDevices
            .getUserMedia({ video: true })
            .then((streamObj) => {
                stream = streamObj;
                const videoElement = document.createElement("video");
                videoElement.srcObject = stream;
                document.body.appendChild(videoElement);
                videoElement.play();

                locationStatus.style.display = "none";
                goBackButton.style.display = "none";
                captureButton.style.display = "block";
            })
            .catch((error) => {
                console.error("Error accessing camera:", error);
                alert("Failed to access the camera.");
            });
    }

    function captureImageAndStore() {
        const videoTracks = stream.getVideoTracks();
        if (videoTracks.length === 0) {
            console.error("No video tracks found in the camera stream.");
            return;
        }

        const videoTrack = videoTracks[0];
        const imageCapture = new ImageCapture(videoTrack);

        imageCapture
            .grabFrame()
            .then((imageBitmap) => {
                const canvas = document.createElement("canvas");
                canvas.width = imageBitmap.width;
                canvas.height = imageBitmap.height;
                const context = canvas.getContext("2d");
                context.drawImage(imageBitmap, 0, 0, canvas.width, canvas.height);

                const capturedImage = canvas.toDataURL("image/jpeg");

                // Store the captured image with a timestamp
                const timestamp = new Date().toLocaleString();
                const data = { image: capturedImage, timestamp };

                // Display the captured image on the screen
                selfieImage.src = capturedImage;
                selfieImage.style.display = "block";

                // You can send the data to the server or perform other actions as needed
                // For example:
                // sendImageToServer(data);
            })
            .catch((error) => {
                console.error("Error capturing image:", error);
                alert("Failed to capture the image.");
            });
    }

    function sendImageToServer(data, userId) {
        fetch('store_image.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `image=${encodeURIComponent(data.image)}&user_id=${userId}`,
        })
            .then(response => response.text())
            .then(responseData => {
                console.log(responseData);
                // Handle the server response as needed
            })
            .catch(error => {
                console.error('Error sending image data:', error);
            });
    }
</script>
</body>
</html>
