// Elements
const markAttendanceButton = document.getElementById("markAttendanceButton");
const locationStatus = document.getElementById("locationStatus");
const selfieContainer = document.getElementById("selfieContainer");
const captureButton = document.getElementById("captureButton");
const goBackButton = document.getElementById("goBackButton");

// Event listener for marking attendance
markAttendanceButton.addEventListener("click", async () => {
    // Check if location is matched
    const isLocationMatched = await checkLocation();
    
    if (isLocationMatched) {
        locationStatus.textContent = "Location matched!";
        selfieContainer.style.display = "block";
    } else {
        locationStatus.textContent = "Location not matched!";
        goBackButton.style.display = "block";
    }
});

// Event listener for capturing a selfie
captureButton.addEventListener("click", () => {
    captureSelfie();
});

// Event listener for going back
goBackButton.addEventListener("click", () => {
    locationStatus.textContent = "";
    selfieContainer.style.display = "none";
    goBackButton.style.display = "none";
});

// Function to check if the user's location matches a predefined location
async function checkLocation() {
    // Replace these coordinates with your predefined location coordinates
    const predefinedLatitude = 13.0288969; // Replace with your latitude
    const predefinedLongitude = 80.0360545; // Replace with your longitude

    try {
        // Get the user's current coordinates
        const position = await getCurrentPosition();

        // Calculate the distance between the user's location and the predefined location
        const distance = calculateDistance(
            predefinedLatitude,
            predefinedLongitude,
            position.coords.latitude,
            position.coords.longitude
        );

        // Define a proximity threshold (in meters) within which the location is considered matched
        const proximityThreshold = 100; // Adjust as needed

        // Check if the distance is within the proximity threshold
        if (distance <= proximityThreshold) {
            locationStatus.textContent = "Location matched!";
            selfieContainer.style.display = "block";
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

// Function to get the user's current coordinates using the Geolocation API
function getCurrentPosition() {
    return new Promise((resolve, reject) => {
        navigator.geolocation.getCurrentPosition(
            (position) => resolve(position),
            (error) => reject(error)
        );
    });
}

// Function to calculate the distance between two sets of coordinates using the Haversine formula
function calculateDistance(lat1, lon1, lat2, lon2) {
    const earthRadius = 6371e3; // Earth's radius in meters
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
