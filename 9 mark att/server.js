const express = require("express");
const http = require("http");
const socketIo = require("socket.io");
const path = require("path"); // Require the 'path' module

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

const PORT = process.env.PORT || 8080;

// Serve static files from the "public" folder on your desktop
app.use(express.static(path.join(__dirname, "att")));

// In-memory attendance data (replace with a database in production)
const attendanceList = [];

// Socket.io handling
io.on("connection", (socket) => {
    console.log("A user connected");

    socket.on("markAttendance", (attendanceData) => {
        // Store attendance data
        attendanceList.push(attendanceData);

        // Broadcast the updated attendance list to all connected clients
        io.emit("updateAttendance", attendanceList);
    });

    socket.on("disconnect", () => {
        console.log("A user disconnected");
    });
});

server.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
