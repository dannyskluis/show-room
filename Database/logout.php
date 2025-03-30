<?php
session_start(); // Start de sessie

// Controleer of de gebruiker is ingelogd
if (isset($_SESSION['EMPLOYEE_ID'])) {
    // stop de sessievariabele
    unset($_SESSION['EMPLOYEE_ID']);
    session_destroy();
    header("Location:../homepage.php?uitgelogd");
    exit();
} else if (isset($_SESSION['PATIENT_ID'])) {
    unset($_SESSION['PATIENT_ID']);
    session_destroy();
    header("Location:../homepage.php?uitgelogd");
    exit();
} else {
    // Als de gebruiker niet is ingelogd, stuur ze dan naar de inlogpagina
    header("Location:../homepage.php?uitgelogd");
    exit();
}

?>