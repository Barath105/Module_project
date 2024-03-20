<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="s8.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./i8_files/css2">
    <style>
      .popup {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 2; 
      }

      .popup-content {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
      }


      .close-popup {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        cursor: pointer;
      }

      .att-values {
        display: flex;
        flex-wrap: wrap;
      }

      .att-item {
        margin: 10px;
      }

      input[type="text"] {
        width: 100px;
      }
      .fa-home:before {
        content: "\f015";
        position: relative;
        left: -558px;
        }

    
      .frame-5 {
        position: absolute;
        width: 1440px;
        height: 78px;
        top: 0;
        left: 0;
        background:linear-gradient(45deg, #a3acf8, #c9cef5);
    }
    
      
      .text-wrapper-4 {
        position: absolute;
        width: 200px;
        top: 24px;
        left: 144px;
        font-family: "Inter", Helvetica;
        font-weight: bold;
        color:black;
        font-size: 26px;
        letter-spacing: 0;
        line-height: normal;
        white-space: nowrap;
      }
      .wrapper {
        animation: fadeIn 1s ease;
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
      .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        display: none;
        z-index: 1; /* Lower z-index for the overlay */
    }

    img {
  max-width: 100%;
  width: 100px;
  height: auto;
  position: absolute;
  top: -10px;
  left: 40px;
  z-index:2;
}

.cartoon img{
  width:600px;
  height:auto;
  left:50%;
  top:10%;
  z-index:-1;
}



.footer {
  position: absolute;
  bottom: -200;
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
    </style>
  </head>
  <body>
    <div class="wrapper"style="position: relative;top: 26px; left:-20%">
      <header>
        <p class="current-date"></p>
        <div class="icons">
          <span id="prev" class="material-symbols-rounded"><</span>
          <span id="next" class="material-symbols-rounded">></span>
        </div>
      </header>
      <div class="calendar">
        <ul class="weeks">
          <li>Sun</li>
          <li>Mon</li>
          <li>Tue</li>
          <li>Wed</li>
          <li>Thu</li>
          <li>Fri</li>
          <li>Sat</li>
        </ul>
        <ul class="days">
          <!-- Calendar day elements go here -->
        </ul>
      </div>
    </div>

    <!-- Add the popup structure here -->
    <div class="popup" style="display: none;">
      <div class="popup-content" style="position: relative; width: 400px; top: 30px; left: 35%;">
        <span class="close-popup" id="closePopup">×</span>
        <h2>Date: <span id="selectedDate"></span></h2>
        <div class="att-values">

          <div class="att-item">
            <label for="att1">att1:</label>
            <input type="text" id="att1" fdprocessedid="63vdkl">
          </div>

          <div class="att-item">
            <label for="att2">att2:</label>
            <input type="text" id="att2" fdprocessedid="8l2uq">
          </div>

          <div class="att-item" style="position: relative;left: 68px;color: green;">
            <label for="overall_att">Overall Att:</label>
            <input type="text" id="overall_att" readonly="" fdprocessedid="x7b4me">
          </div>

        </div>
      </div>
    </div>
    <div class="cartoon">
    <img src="cartoon.png">
  </div>

    <img src="EMP.png">
    <div class="frame-5">
      <div class="text-wrapper-4">
          View Attendance
      </div>
      <ul>
          <li><a href="../4 emp home/i4.php" style="color:black;position: relative;left: 1280px;top: 26px;text-decoration: none;">Home</li>
      </ul>
  </div>

  
  <footer class="footer">
                <div class="footer-content">
                    <p>&copy; 2024 HR Employee. All rights reserved.</p>
                </div>
            </footer>

  
  

    <script>
      const daysTag = document.querySelector(".days");
      const currentDate = document.querySelector(".current-date");
      const prevNextIcon = document.querySelectorAll(".icons span");

      let date = new Date();
      let currYear = date.getFullYear();
      let currMonth = date.getMonth();

      const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ];

      // Function to render the calendar
      const renderCalendar = () => {
        const firstDayofMonth = new Date(currYear, currMonth, 1).getDay();
        const lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate();
        const lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();
        let liTag = "";

        for (let i = firstDayofMonth; i > 0; i--) {
          liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
        }

        for (let i = 1; i <= lastDateofMonth; i++) {
          const isToday = i === date.getDate() && currMonth === date.getMonth() && currYear === date.getFullYear() ? "active" : "";
          liTag += `<li class="${isToday}">${i}</li>`;
        }

        currentDate.textContent = `${months[currMonth]} ${currYear}`;
        daysTag.innerHTML = liTag;
      };

      // Function to display the popup
      const displayPopup = (clickedDate) => {
        const selectedDate = new Date(currYear, currMonth, clickedDate);
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById("selectedDate").textContent = selectedDate.toLocaleDateString(undefined, options);

        // You can add your logic here to fetch and display data based on the selected date.
        // For simplicity, we'll just clear the input fields.
        document.getElementById("att1").value = "";
        document.getElementById("att2").value = "";
        

        // Show the popup
        document.querySelector(".popup").style.display = "block";
      };

      // Render the initial calendar
      renderCalendar();

      // Add event listeners to previous and next icons
      prevNextIcon.forEach(icon => {
        icon.addEventListener("click", () => {
          currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

          if (currMonth < 0 || currMonth > 11) {
            date = new Date(currYear, currMonth, date.getDate());
            currYear = date.getFullYear();
            currMonth = date.getMonth();
          }
          renderCalendar();
        });
      });

      // Add click event listener to the calendar days
      daysTag.addEventListener("click", (e) => {
        const clickedDate = e.target.innerText;
        if (clickedDate && !e.target.classList.contains("inactive")) {
          displayPopup(parseInt(clickedDate));
        }
      });

      // Add click event listener to close the popup
      document.getElementById("closePopup").addEventListener("click", () => {
        document.querySelector(".popup").style.display = "none";
      }); 

      function fetchDataForDate(date) {
    const url = `viewatt.php?attendance_date=${date}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            document.getElementById("att1").value = data.att1 || '';
            document.getElementById("att2").value = data.att2 || '';
            document.getElementById("overall_att").value = data.overall_att || ''; // Update overall_att field
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}


      // ... (previous code) ...

      // Add click event listener to the calendar days
      daysTag.addEventListener("click", (e) => {
        const clickedDate = e.target.innerText;
        if (clickedDate && !e.target.classList.contains("inactive")) {
            displayPopup(parseInt(clickedDate));
            
            // Construct the date parameter
            const dateParameter = `${currYear}-${currMonth + 1}-${clickedDate}`;
            fetchDataForDate(dateParameter);
            
            // Debugging: log the date parameter
            console.log("Date Parameter:", dateParameter);
    
          
        }
    });
      document.getElementById("closePopup").addEventListener("click", () => {
        document.querySelector(".popup").style.display = "none";
      });
    </script>
  </body>
</html>
