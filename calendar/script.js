const daysTag = document.querySelector(".days");
const currentDate = document.querySelector(".current-date");
const prevNextIcon = document.querySelectorAll(".icons span");

// Sample data object indicating whether data is present or absent for each date
const dataStatus = {
    "2023-12-01": "absent",
    "2023-12-05": "present",
    "2023-12-10": "absent",
    "2024-01-01": "present",
    // ... Add more dates as needed
};

// getting new date, current year and month
let date = new Date(),
    currYear = date.getFullYear(),
    currMonth = date.getMonth();

// storing full name of all months in array
const months = ["January", "February", "March", "April", "May", "June", "July",
    "August", "September", "October", "November", "December"];

const renderCalendar = () => {
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay();
    let lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate();
    let lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay();
    let lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();
    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) {
        liTag += `<li class="inactive"></li>`;
    }

    for (let i = 1; i <= lastDateofMonth; i++) {
        const dateString = `${currYear}-${(currMonth + 1).toString().padStart(2, "0")}-${i.toString().padStart(2, "0")}`;
        let dataStatusForDate = dataStatus[dateString];
        
        if (dataStatusForDate !== undefined) {
            let backgroundColor = dataStatusForDate === "present" ? "green" : "red";
            let isToday = i === date.getDate() && currMonth === new Date().getMonth() 
                        && currYear === new Date().getFullYear() ? "active" : "";

            liTag += `<li class="${isToday}" onclick="changeColor(this)" data-status="${dataStatusForDate}" style="background-color: ${backgroundColor};">${i}</li>`;
        } else {
            liTag += `<li>${i}</li>`;
        }
    }

    for (let i = lastDayofMonth; i < 6; i++) {
        liTag += `<li class="inactive"></li>`;
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`;
    daysTag.innerHTML = liTag;
}

renderCalendar();

prevNextIcon.forEach(icon => {
    icon.addEventListener("click", () => {
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if (currMonth < 0 || currMonth > 11) {
            date = new Date(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear();
            currMonth = date.getMonth();
        } else {
            date = new Date();
        }
        renderCalendar();
    });
});

function changeColor(element) {
    const dataStatusForDate = element.getAttribute("data-status");
    const backgroundColor = dataStatusForDate === "present" ? "green" : "red";
    element.style.backgroundColor = backgroundColor;
}
