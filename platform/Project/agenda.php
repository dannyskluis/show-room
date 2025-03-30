<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calendar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="style/universal.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <script src="Javascript/calendar.js" defer></script>
    <script src="JavaScript/header.js" defer></script>
    <script src="JavaScript/footer.js" defer></script>
</head>

<body>

    <style>
        :root {
            --primary-color: #b38add;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif
        }

        body {
            min-height: 100vh;
            justify-content: center;
            background-color: #e2e1dc;
        }

        .container {
            position: relative;
            max-width: 1200px;
            min-height: 850px;
            margin: 0 auto;
            padding: 5px;
            color: #fff;
            display: flex;
            border-radius: 10px;
            background-color: #373c4f;
        }

        .left {
            width: 95%;
            padding: 20px;
        }

        .calendar {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            justify-content: space-between;
            color: #ba12d6;
            border-radius: 5px;
            background-color: #fff;
        }

        .calendar::before,
        .calendar::after {
            content: '';
            position: absolute;
            width: 12px;
            top: 0;
            bottom: 50;
            left: 100%;
            height: 97%;
            border-radius: 0 5px 5px 0;
            transform: translateY(-50%);
            background-color: #d3d5d6d7;
        }

        .calendar::before {
            height: 94%;
            left: calc(100% + 12px);
            background-color: rgb(153, 153, 153);
        }

        .calendar .month {
            width: 100%;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 50px;
            font-size: 1.2rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .calendar .month .prev,
        .calendar .month .next {
            cursor: pointer;
        }

        .calendar .month .prev:hover,
        .calendar .month .next:hover {
            color: var(--primary-clr);
        }

        .calendar .weekdays {
            width: 100%;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            font-size: 1rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .calendar .weekdays div {
            width: 14.28%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .calendar .days {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 0 20px;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .calendar .days .day {
            width: 14.28%;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--primary-clr);
            border: 1px solid #f5f5f5
        }

        .calendar .day:not(.prev-date, .next-date):hover {
            color: #fff;
            background-color: var(--primary-clr);
        }

        .calendar .days .prev-date,
        .calendar .days .next-date {
            color: #b3b3b3;
        }

        .calendar .days .active {
            position: relative;
            font-size: 2rem;
            background-color: var(--primary-clr);
        }

        .calendar .days .active::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            box-shadow: 0 0 0 2px var(--primary-clr);
        }

        .calendar .days .today {
            font-size: 2rem;
        }

        .calendar .days .event {
            position: relative;
        }

        .calendar .days .event::after {
            content: '';
            position: absolute;
            bottom: 10%;
            left: 50%;
            width: 75%;
            height: 6px;
            border-radius: 30px;
            transform: translateX(-50%);
            background-color: #ba12d6;
        }

        .calendar .event:hover::after {
            background-color: #fff;
        }

        .calendar .event:hover::after {
            background-color: #fff;
            bottom: 20%;
        }

        .calendar .active.event {
            padding-bottom: 10px;
        }

        .calendar .goto-today {
            width: 100%;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 5px;
            padding: 0 20px;
            color: var(--primary-clr);
        }

        .calendar .goto-today .goto {
            display: flex;
            align-items: center;
            border-radius: 5px;
        }

        .calendar .goto-today .goto input {
            width: 100%;
            height: 30px;
            outline: none;
            border-radius: 5px;
            padding: 0 20px;
            color: var(--primary-clr);
            border-radius: 5px;
        }

        .calendar .goto-today button {
            padding: 5px 10px;
            border: 2px solid #373c4f;
            border-radius: 5px;
            background-color: transparent;
            cursor: pointer;
            color: var(--primary-clr);
        }

        .calendar .goto-today button:hover {
            color: #fff;
            background-color: #ba12d6
        }
    </style>

    <header id="navbar"></header>

    <div class="container">
        <div class="left">
            <div class="calendar">
                <div class="month">
                    <i class="fa fa-angle-left prev"></i>
                    <div class="date"></div>
                    <i class="fa fa-angle-right next"></i>
                </div>
                <div class="weekdays">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div class="days">
                    
                </div>
                <div class="goto-today">
                    <div class="goto">
                        <input type="text" placeholder="mm/yyyy" class="date-input">
                        <button class="goto-btn">Go</button>
                    </div>
                    <button class="today-btn">Today</button>
                </div>
            </div>
        </div>
    </div>

    <footer id="footerbar"></footer>

</body>

</html>
