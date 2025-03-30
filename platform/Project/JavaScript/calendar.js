const calendar = document.querySelector(".calendar"),
    days = document.querySelector(".date"),
    daysContainer = document.querySelector(".days"),
    prev = document.querySelector(".prev"),
    next = document.querySelector(".next"),
    todayBtn = document.querySelector(".today-btn"),
    gotoBtn = document.querySelector(".goto-btn"),
    dateInput = document.querySelector(".date-input");

let today = new Date();
let activeDay;
let month = today.getMonth();
let year = today.getFullYear();

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
    "December"
];

function initCalendar() {
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const prevLastDay = new Date(year, month, 0);
    const prevDays = prevLastDay.getDate();
    const lastDate = lastDay.getDate();
    const day = firstDay.getDay();
    const nextDays = 7 - lastDay.getDay() - 1;

    days.innerHTML = months[month] + " " + year;

    let daysHTML = "";

    for (let x = day; x > 0; x--) {
        daysHTML += `<div class="day prev-date">${prevDays - x + 1}</div>`;
    }

    for(let i = 1; i <= lastDate; i++) {
        if(
            i === new Date().getDate() &&
            year === new Date().getFullYear() &&
            month === new Date().getMonth()
        ) {
            daysHTML += `<div class="day today">${i}</div>`;
        } else {
            daysHTML += `<div class="day">${i}</div>`;
        }
    }

    for(let i = 1; i <= nextDays; i++) {
        daysHTML += `<div class="day next-date">${i}</div>`;
    }
    
    daysContainer.innerHTML = daysHTML;
}

function updateCalendar() {
    initCalendar();
}

prev.addEventListener('click', () => {
    month--;
    if (month < 0) {
        month = 11;
        year--;
    }
    updateCalendar();
});

next.addEventListener('click', () => {
    month++;
    if (month > 11) {
        month = 0;
        year++;
    }
    updateCalendar();
});

todayBtn.addEventListener('click', () => {
    const today = new Date();
    month = today.getMonth();
    year = today.getFullYear();
    updateCalendar();
});

gotoBtn.addEventListener('click', () => {
    const [monthInput, yearInput] = dateInput.value.split("/");
    if (monthInput && yearInput) {
        month = parseInt(monthInput) - 1;
        year = parseInt(yearInput);
        updateCalendar();
    } else {
        alert("Please enter a valid date in mm/yyyy format.");
    }
});

initCalendar();
