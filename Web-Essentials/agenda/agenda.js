const calendar = document.querySelector(".calendar"),
    days = document.querySelector(".date"),
    daysContainer = document.querySelector(".days"),
    prev = document.querySelector(".prev"),
    next = document.querySelector(".next"),
    todayBtn = document.querySelector(".today-btn"),
    gotoBtn = document.querySelector(".goto-btn"),
    dateInput = document.querySelector(".date-input"),
    agendaForm = document.getElementById("agenda-form"),
    agendaInput = document.getElementById("agenda-input"),
    startDateInput = document.getElementById("start-date-input"),
    endDateInput = document.getElementById("end-date-input"),
    agendaList = document.getElementById("agenda-list"),
    selectedDateEl = document.getElementById("selected-date");

let today = new Date();
let activeDay;
let month = today.getMonth();
let year = today.getFullYear();
let agenda = [];

const months = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
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

    for (let i = 1; i <= lastDate; i++) {
        const dateKey = new Date(year, month, i).toDateString();
        const hasEvent = agenda.some(event => {
            const start = new Date(event.startDate);
            const end = new Date(event.endDate);
            return new Date(year, month, i) >= start && new Date(year, month, i) <= end;
        });
        const classes = hasEvent ? `day event` : `day`;
        if (i === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
            daysHTML += `<div class="${classes} today" data-day="${i}">${i}</div>`;
        } else {
            daysHTML += `<div class="${classes}" data-day="${i}">${i}</div>`;
        }
    }

    for (let i = 1; i <= nextDays; i++) {
        daysHTML += `<div class="day next-date">${i}</div>`;
    }

    daysContainer.innerHTML = daysHTML;

    document.querySelectorAll('.day').forEach(day => {
        day.addEventListener('click', (e) => {
            const selectedDay = e.target.dataset.day;
            activeDay = new Date(year, month, selectedDay);
            updateAgenda();
        });
    });

    highlightMultiDayEvents();
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

agendaForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const eventText = agendaInput.value;
    const startDate = new Date(startDateInput.value);
    const endDate = new Date(endDateInput.value);
    if (eventText && startDate && endDate) {
        agenda.push({
            text: eventText,
            startDate: startDate.toDateString(),
            endDate: endDate.toDateString()
        });
        agendaInput.value = "";
        startDateInput.value = "";
        endDateInput.value = "";
        updateAgenda();
        updateCalendar(); // Update the calendar to show the event marker
    }
});

function updateAgenda() {
    const dateKey = activeDay ? activeDay.toDateString() : new Date(year, month, today.getDate()).toDateString();
    selectedDateEl.textContent = dateKey;
    agendaList.innerHTML = "";
    const dayEvents = agenda.filter(event => {
        const start = new Date(event.startDate);
        const end = new Date(event.endDate);
        return activeDay >= start && activeDay <= end;
    });
    if (dayEvents.length) {
        dayEvents.forEach((event, index) => {
            const li = document.createElement('li');
            li.textContent = event.text;
            const deleteBtn = document.createElement('button');
            deleteBtn.textContent = "Delete";
            deleteBtn.addEventListener('click', () => {
                agenda.splice(agenda.indexOf(event), 1);
                updateAgenda();
                updateCalendar(); // Update the calendar to remove the event marker if no events are left
            });
            li.appendChild(deleteBtn);
            agendaList.appendChild(li);
        });
    }
}

function highlightMultiDayEvents() {
    document.querySelectorAll('.day.event').forEach(dayElement => {
        const day = parseInt(dayElement.dataset.day);
        const date = new Date(year, month, day);
        const event = agenda.find(event => {
            const start = new Date(event.startDate);
            const end = new Date(event.endDate);
            return date >= start && date <= end;
        });
        if (event) {
            const start = new Date(event.startDate).getDate();
            const end = new Date(event.endDate).getDate();
            if (day === start) {
                dayElement.classList.add('start');
                dayElement.innerHTML += `<span>${event.text}</span>`;
            } else if (day === end) {
                dayElement.classList.add('end');
            }
        }
    });
}

initCalendar();
updateAgenda();