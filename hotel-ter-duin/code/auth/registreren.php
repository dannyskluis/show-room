<?php
require '../database/db.php'; // Jouw DB class
require_once("../session_manager.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Haal de formuliergegevens op
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $telefoonnummer = $_POST['telefoonnummer'];
    $wachtwoord = $_POST['wachtwoord'];
    $wachtwoord_bevestigen = $_POST['wachtwoord_bevestigen'];

    // Controleer of de wachtwoorden overeenkomen
    if ($wachtwoord !== $wachtwoord_bevestigen) {
        echo "De wachtwoorden komen niet overeen.";
        exit;
    }

    // Hash het wachtwoord
    $hashedPassword = password_hash($wachtwoord, PASSWORD_DEFAULT);

    // Maak verbinding met de database
    $db = new DB();

    // Controleer of het e-mailadres al bestaat in de database
    $stmt = $db->execute("SELECT * FROM klanten WHERE e_mail = ?", [$email]);
    $klant = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($klant) {
        echo "Dit e-mailadres is al geregistreerd.";
        exit;
    }

    // Voeg de klant toe aan de database
    $stmt = $db->execute(
        "INSERT INTO klanten (voornaam, achternaam, e_mail, telefoonnummer, wachtwoord) VALUES (?, ?, ?, ?, ?)",
        [$voornaam, $achternaam, $email, $telefoonnummer, $hashedPassword]
    );

    // Als registratie succesvol is, doorverwijzen naar de loginpagina
    echo "Registratie succesvol! Je kunt nu inloggen.";
    header('Location: login.php');
    exit;
}
?>

<?php include '../components/header.php'; ?>

<form method="POST" class="formulier">
    <input type="text" name="voornaam" placeholder="Voornaam" required>
    <input type="text" name="achternaam" placeholder="Achternaam" required>
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="text" name="telefoonnummer" placeholder="Telefoonnummer" required>
    <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
    <input type="password" name="wachtwoord_bevestigen" placeholder="Bevestig wachtwoord" required>
    <button type="submit">Registreren</button>
</form>

<?php include '../components/footer.php'; ?>