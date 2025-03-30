<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="agenda.js" defer></script>

    <!-- toegevoegd door Toei -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../website/CSS CODES/homepagina.css">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>

<body>

    <!-- toegevoegd door Toei -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../website/PHP CODES/homepage.php">HOME</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../calculator/calc.php"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-calculator" viewBox="0 0 16 16">
                            <path
                                d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                            <path
                                d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </a>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tools
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../To do list/index.php">To do list</a>
                        <a class="dropdown-item" href="agenda.php">Agenda</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <style>
        body {
            padding-top: 56px;
        }


        .navbar {
            width: 100%;
            padding: 1rem 2rem;
            background: linear-gradient(to left, #878fa0, #0340a8);
            border-bottom: 1px solid #ddd;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: bold;
            color: white !important;
        }

        .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            color: #f0f0f0 !important;
        }

        .dropdown-menu {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            padding: 10px 20px;
            color: #337ab7;
        }

        .dropdown-item:hover {
            background-color: #f0f0f0;
            color: #23527c;
        }

        .navbar-toggler-icon {
            filter: invert(1);
        }

        :root {
            --primary-color: #b38add;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #34495e;
        }

        .container {
            position: relative;
            max-width: 1200px;
            min-height: 850px;
            margin: 20px auto;
            padding: 5px;
            color: #fff;
            display: flex;
            border-radius: 10px;
            background-color: #373c4f;
        }

        .left {
            width: 70%;
            padding: 20px;
        }

        .right {
            width: 30%;
            padding: 20px;
            background-color: #f4f4f4;
            color: #373c4f;
            border-radius: 10px;
            margin-left: 20px;
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
            color: var(--primary-color);
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
            position: relative;
        }

        .calendar .days .day {
            width: 14.28%;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--primary-color);
            border: 1px solid #f5f5f5;
            position: relative;
        }

        .calendar .day:not(.prev-date, .next-date):hover {
            color: #373c4f;
            background-color: var(--primary-color);
        }

        .calendar .days .prev-date,
        .calendar .days .next-date {
            color: #b3b3b3;
        }

        .calendar .days .active {
            position: relative;
            font-size: 2rem;
            background-color: var(--primary-color);
        }

        .calendar .days .active::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            box-shadow: 0 0 0 2px var(--primary-color);
        }

        .calendar .days .today {
            font-size: 2rem;
        }

        .calendar .days .event {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .calendar .days .event::before {
            content: '';
            position: absolute;
            bottom: 10%;
            left: 0;
            width: 100%;
            height: 6px;
            border-radius: 30px;
            background-color: #ba12d6;
        }

        .calendar .days .event span {
            position: absolute;
            bottom: 20%;
            width: 100%;
            text-align: center;
            color: #fff;
            font-size: 0.75rem;
            pointer-events: none;
        }

        .calendar .days .event.start::before {
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }

        .calendar .days .event.end::before {
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .calendar .goto-today {
            width: 100%;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 5px;
            padding: 0 20px;
            color: var(--primary-color);
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
            color: var(--primary-color);
            border-radius: 5px;
        }

        .calendar .goto-today button {
            padding: 5px 10px;
            border: 2px solid #373c4f;
            border-radius: 5px;
            background-color: transparent;
            cursor: pointer;
            color: var(--primary-color);
        }

        .calendar .goto-today button:hover {
            color: #fff;
            background-color: #ba12d6;
        }

        .agenda {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        #agenda-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        #agenda-input,
        #start-date-input,
        #end-date-input {
            padding: 5px;
        }

        #agenda-list {
            list-style: none;
            padding: 0;
        }

        #agenda-list li {
            background-color: #ba12d6;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #agenda-list li button {
            background-color: #fff;
            color: #ba12d6;
            border: none;
            padding: 2px 5px;
            cursor: pointer;
            border-radius: 3px;
        }
    </style>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <style>
            /* Add this new CSS rule to fix the navbar at the top */
            body {
                padding-top: 56px;
                /* Adjust based on the height of your navbar */
            }

            /* Navbar styling */
            .navbar {
                width: 100%;
                padding: 1rem 2rem;
                background: linear-gradient(to left, #878fa0, #0340a8);
                border-bottom: 1px solid #ddd;
                position: fixed;
                /* Fix the navbar at the top */
                top: 0;
                left: 0;
                z-index: 1000;
                /* Ensure the navbar is on top of other elements */
            }

            .navbar-brand {
                font-weight: bold;
                color: white !important;
            }

            .nav-link {
                color: white !important;
            }

            .nav-link:hover {
                color: #f0f0f0 !important;
            }

            .dropdown-menu {
                background-color: #f9f9f9;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .dropdown-item {
                padding: 10px 20px;
                color: #337ab7;
            }

            .dropdown-item:hover {
                background-color: #f0f0f0;
                color: #23527c;
            }

            .navbar-toggler-icon {
                filter: invert(1);
            }

            :root {
                --primary-color: #b38add;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Poppins', sans-serif;
            }

            body {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                background-color: #34495e;
            }

            .container {
                position: relative;
                max-width: 1200px;
                min-height: 850px;
                margin: 20px auto;
                padding: 5px;
                color: #fff;
                display: flex;
                border-radius: 10px;
                background-color: #373c4f;
            }

            .left {
                width: 70%;
                padding: 20px;
            }

            .right {
                width: 30%;
                padding: 20px;
                background-color: #f4f4f4;
                color: #373c4f;
                border-radius: 10px;
                margin-left: 20px;
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
                color: var(--primary-color);
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
                position: relative;
            }

            .calendar .days .day {
                width: 14.28%;
                height: 90px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                color: var(--primary-color);
                border: 1px solid #f5f5f5;
                position: relative;
            }

            .calendar .day:not(.prev-date, .next-date):hover {
                color: #373c4f;
                background-color: var(--primary-color);
            }

            .calendar .days .prev-date,
            .calendar .days .next-date {
                color: #b3b3b3;
            }

            .calendar .days .active {
                position: relative;
                font-size: 2rem;
                background-color: var(--primary-color);
            }

            .calendar .days .active::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                box-shadow: 0 0 0 2px var(--primary-color);
            }

            .calendar .days .today {
                font-size: 2rem;
            }

            .calendar .days .event {
                position: relative;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .calendar .days .event::before {
                content: '';
                position: absolute;
                bottom: 10%;
                left: 0;
                width: 100%;
                height: 6px;
                border-radius: 30px;
                background-color: #ba12d6;
            }

            .calendar .days .event span {
                position: absolute;
                bottom: 20%;
                width: 100%;
                text-align: center;
                color: #fff;
                font-size: 0.75rem;
                pointer-events: none;
            }

            .calendar .days .event.start::before {
                border-top-left-radius: 15px;
                border-bottom-left-radius: 15px;
            }

            .calendar .days .event.end::before {
                border-top-right-radius: 15px;
                border-bottom-right-radius: 15px;
            }

            .calendar .goto-today {
                width: 100%;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 5px;
                padding: 0 20px;
                color: var(--primary-color);
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
                color: var(--primary-color);
                border-radius: 5px;
            }

            .calendar .goto-today button {
                padding: 5px 10px;
                border: 2px solid #373c4f;
                border-radius: 5px;
                background-color: transparent;
                cursor: pointer;
                color: var(--primary-color);
            }

            .calendar .goto-today button:hover {
                color: #fff;
                background-color: #ba12d6;
            }

            .agenda {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            #agenda-form {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            #agenda-input,
            #start-date-input,
            #end-date-input {
                padding: 5px;
            }

            #agenda-list {
                list-style: none;
                padding: 0;
            }

            #agenda-list li {
                background-color: #ba12d6;
                color: #fff;
                padding: 5px;
                border-radius: 5px;
                margin-bottom: 5px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            #agenda-list li button {
                background-color: #fff;
                color: #ba12d6;
                border: none;
                padding: 2px 5px;
                cursor: pointer;
                border-radius: 3px;
            }
        </style>

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
                <div class="days"></div>
                <div class="goto-today">
                    <div class="goto">
                        <input type="text" placeholder="mm/yyyy" class="date-input">
                        <button class="goto-btn">Go</button>
                    </div>
                    <button class="today-btn">Today</button>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="agenda">
                <h2>Agenda for <span id="selected-date">Today</span></h2>
                <form id="agenda-form">
                    <input type="text" id="agenda-input" placeholder="Add an event">
                    <input type="date" id="start-date-input" placeholder="Start date">
                    <input type="date" id="end-date-input" placeholder="End date">
                    <button type="submit">Add</button>
                </form>
                <ul id="agenda-list"></ul>
            </div>
        </div>
    </div>
</body>

</html>
