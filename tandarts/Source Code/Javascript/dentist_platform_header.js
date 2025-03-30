let nav = `
    <ul class='nav'>
        <li class='menu_item'><a href='dentists_platform_home.php'>Dashboard</a></li>
        <li class='menu_item'><a href='profielbeheer.php'>Profile</a></li>
        <li class='menu_item'><a href='appointments.php'>Appointments</a></li>
        <li class='menu_item'><a href='show_patients.php'>Registered patients</a></li>
        <li class='menu_item'><a href='response.php'>Answer</a></li>
        <li class='menu_item'><a href="../Database/logout.php">Logout</a></li>
    </ul>
    `;

document.getElementById("nav").innerHTML = nav;