<?php
require_once("../Database/session_manager.php");
require_once("../Database/Authentication.php");
require_once("../Database/Insurance.php");
require_once("../Database/Patients.php");
require_once("../Database/db.php");
require_once('../Database/Appointments.php');

// Maak een instantie van de DB
$myDB = new DB();
$appointment = new Appointments($myDB);

// Hier zou je code komen om een afspraak te bewerken

// Controleer of de aanvraag een POST-verzoek is
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hier kun je de logica toevoegen om een afspraak bij te werken
}

// Haal de afspraak op basis van een ID, deze ID moet je op een andere manier krijgen (bijv. via een GET parameter)
$appointmentID = $_GET['id']; // Zorg ervoor dat deze veilig wordt behandeld
$currentAppointment = $appointment->oneAppointment($appointmentID);

// Als je behandelaars wilt ophalen, kun je dat hier doen
$behandelaars = $appointment->getBehandelaars(); // Zorg ervoor dat deze functie correct is in de Appointments class

// De rest van je code om de gegevens weer te geven en een formulier te maken voor de afspraak
?>

<!-- HTML-formulier voor het bewerken van de afspraak -->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Afspraak Bewerken</title>
</head>
<body>

<h1>Afspraak Bewerken</h1>

<form method="post" action="">
    <input type="hidden" name="appointment_id" value="<?= $currentAppointment['APPOINTMENT_ID']; ?>">

    <label for="date">Datum:</label>
    <input type="date" name="date" value="<?= date('Y-m-d', strtotime($currentAppointment['APPOINTMENT_DATETIME'])); ?>" required>

    <label for="time">Tijd:</label>
    <input type="time" name="time" value="<?= date('H:i', strtotime($currentAppointment['APPOINTMENT_DATETIME'])); ?>" required>

    <label for="behandelaar">Behandelaar:</label>
    <select name="behandelaar" required>
        <?php foreach ($behandelaars as $behandelaar): ?>
            <option value="<?= $behandelaar['EMPLOYEE_ID']; ?>"><?= $behandelaar['EMPLOYEE_FIRSTNAME'] . ' ' . $behandelaar['EMPLOYEE_LASTNAME']; ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Bijwerken</button>
</form>

</body>
</html>
