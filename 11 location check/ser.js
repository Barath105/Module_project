const express = require("express");
const http = require("http");
const socketIo = require("socket.io");
const path = require("path");
const fs = require("fs");

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

const PORT = process.env.PORT || 8080;

app.use(express.static(path.join(__dirname, "public")));

const attendanceList = [];

io.on("connection", (socket) => {
    console.log("A user connected");

    socket.on("markAttendance", (attendanceData) => {
        attendanceList.push(attendanceData);
        io.emit("updateAttendance", attendanceList);
    });

    socket.on("disconnect", () => {
        console.log("A user disconnected");
    });
});

// Define a route for the root path ("/") that sends a simple response
app.get("/", (req, res) => {
    res.send("Welcome to the Attendance System!");
});

server.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
