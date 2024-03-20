document.addEventListener("DOMContentLoaded", function () {
    const datesContainer = document.getElementById("dates");

    // Sample leave dates
    const leaveDates = [4, 8, 12, 16, 20];

    const currentDate = new Date();
    const currentMonth = currentDate.getMonth();
    const daysInMonth = new Date(currentDate.getFullYear(), currentMonth + 1, 0).getDate();

    for (let day = 1; day <= daysInMonth; day++) {
        const dateElement = document.createElement("div");
        dateElement.className = "date";
        dateElement.textContent = day;

        if (leaveDates.includes(day)) {
            dateElement.classList.add("absent");
        }

        datesContainer.appendChild(dateElement);
    }
});
