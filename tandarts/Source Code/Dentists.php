<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dentist Profiles</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .nav {
            list-style-type: none;     /* Remove bullets */
            padding: 0;                /* Remove padding */
            margin: 0;                 /* Remove margin */
            background-color: #f8f9fa; /* Light background color */
            display: flex;             /* Align items horizontally */
            justify-content: space-around; /* Space between items */
            padding: 10px;             /* Padding for the navbar */
        }
        .menu_item {
            display: inline-block;      /* Align items horizontally */
            margin-right: 10px;        /* Space between items */
        }
        .notification-dropdown {
            display: none;              /* Hide dropdown by default */
            position: absolute;         /* Position it correctly */
            background-color: white;    /* White background */
            border: 1px solid #ccc;    /* Border for dropdown */
            z-index: 1000;             /* On top of other elements */
        }
        .notification-dropdown.show {
            display: block;             /* Show when active */
        }

        /* Existing CSS for images and overlay text */
        .image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: calc(100%);
            object-fit: cover;
            z-index: -1;
        }

        .overlay-text {
            width: 100%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 7em;
            color: rgb(255, 255, 255);
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        @media (max-width: 768px) {
            .main {
                position: relative;
                height: auto;
            }
            .image {
                position: relative;
                width: 100%;
                height: auto;
            }

            .overlay-text {
                font-size: 2.5em;
                padding: 0 20px;
                top: 40%;
                left: 50%;
                transform: translate(-50%, -40%);
            }
        }
    </style>
</head>
<body>
    <nav id="nav" data-loggedin="true"></nav> <!-- Navigation bar placeholder -->

    <h1>Dentist Profiles</h1>
    <div class="upper-row">
        <!-- Dentist 1: Dr. Sarah Johnson -->
        <div class="dentist-profile">
            <img src="fotos/Dentist5.jpg" alt="Dr. Sarah Johnson">
            <h2>Dr. Sarah Johnson</h2>
            <p>Specialization: Orthodontist</p>
            <div class="stars" data-rating="4.0">
                <span>⭐⭐⭐⭐☆</span>
                <span>(4.0 stars)</span>
            </div>
        </div>

        <!-- Dentist 2: Dr. Emily Brown -->
        <div class="dentist-profile">
            <img src="fotos/dentist4.jpg" alt="Dr. Emily Brown">
            <h2>Dr. Emily Brown</h2>
            <p>Specialization: Pediatric Dentist</p>
            <div class="stars" data-rating="4.5">
                <span>⭐⭐⭐⭐⭐</span>
                <span>(4.5 stars)</span>
            </div>
        </div>

        <!-- Dentist 3: Dr. Michael Lee -->
        <div class="dentist-profile">
            <img src="fotos/dentist6.jpg" alt="Dr. Michael Lee">
            <h2>Dr. Michael Lee</h2>
            <p>Specialization: Periodontist</p>
            <div class="stars" data-rating="3.8">
                <span>⭐⭐⭐⭐☆</span>
                <span>(3.8 stars)</span>
            </div>
        </div>
    </div>

    <div class="bottom-row">
        <!-- Dentist 4: Dr. James Wilson -->
        <div class="dentist-profile">
            <img src="fotos/dentist3.jpg" alt="Dr. James Wilson">
            <h2>Dr. James Wilson</h2>
            <p>Specialization: Endodontist</p>
            <div class="stars" data-rating="4.2">
                <span>⭐⭐⭐⭐☆</span>
                <span>(4.2 stars)</span>
            </div>
        </div>

        <!-- Dentist 5: Dr. Laura Smith -->
        <div class="dentist-profile">
            <img src="fotos/Dentist1.jpg" alt="Dr. Laura Smith">
            <h2>Dr. Laura Smith</h2>
            <p>Specialization: Oral Surgeon</p>
            <div class="stars" data-rating="4.7">
                <span>⭐⭐⭐⭐⭐</span>
                <span>(4.7 stars)</span>
            </div>
        </div>

        <!-- Dentist 6: Dr. David Clark -->
        <div class="dentist-profile">
            <img src="fotos/Dentist2.jpg" alt="Dr. David Clark">
            <h2>Dr. David Clark</h2>
            <p>Specialization: Prosthodontist</p>
            <div class="stars" data-rating="4.1">
                <span>⭐⭐⭐⭐☆</span>
                <span>(4.1 stars)</span>
            </div>
        </div>
    </div>

    <script>
        // JavaScript code for the navbar
        document.addEventListener("DOMContentLoaded", function () {
            const nav = document.getElementById("nav");
            const isLoggedIn = nav.getAttribute("data-loggedin") === "true";

            let navContent = `
                <ul class='nav'>
                    <li class='menu_item'><a href='Homepage.php'>Home</a></li>
                    <li class='menu_item'><a href='Dentists.php'>Dentists</a></li>
                    <li class='menu_item'><a href='education.php'>Education material</a></li>
                    <li class='menu_item'><a href='Patienten_Platform/messages.php'>Communicate</a></li>
                    <li class='menu_item'><a href='Patienten_Platform/add_appointment.php'>Make an appointment</a></li>
                    <li class='menu_item'><a href='Patienten_Platform/history_appointments.php'>Appointments</a></li>
                    <li class='menu_item'><a href='Patienten_Platform/profielbeheer.php'>Profile</a></li>
                    <li class='menu_item'>
                        <button id='language-toggle'>Change Language</button>
                    </li>
            `;

            if (isLoggedIn) {
                // Removed Logout option
                // navContent += `
                //     <li class='menu_item'><a href="Database/logout.php" class="login">Logout</a></li>
                // `;
            } else {
                navContent += `
                    <li class='menu_item'><a href="autentication/login.php" class="login">Login</a></li>
                    <li class='menu_item'><a href="autentication/registreren.php" class="register">Register - Patient</a></li>
                `;
            }

            navContent += `</ul>`;
            nav.innerHTML = navContent;

            // Language toggle functionality
            const languageToggleButton = document.getElementById("language-toggle");
            languageToggleButton.addEventListener("click", function () {
                const menuItems = document.querySelectorAll('.menu_item a');
                menuItems.forEach((item) => {
                    switch (item.textContent) {
                        case 'Home':
                            item.textContent = 'Huis';
                            break;
                        case 'Dentists':
                            item.textContent = 'Tandartsen';
                            break;
                        case 'Education material':
                            item.textContent = 'Onderwijsmateriaal';
                            break;
                        case 'Communicate':
                            item.textContent = 'Communiceren';
                            break;
                        case 'Make an appointment':
                            item.textContent = 'Maak een afspraak';
                            break;
                        case 'Appointments':
                            item.textContent = 'Afspraak';
                            break;
                        case 'Profile':
                            item.textContent = 'Profiel';
                            break;
                        // Removed Logout option translation
                        case 'Login':
                            item.textContent = 'Inloggen';
                            break;
                        case 'Register - Patient':
                            item.textContent = 'Registreren - Patiënt';
                            break;
                    }
                });
                // Optionally, change button text as well
                languageToggleButton.textContent = 'Verander naar Engels'; // Change button text
            });
        });
    </script>
</body>
</html>
