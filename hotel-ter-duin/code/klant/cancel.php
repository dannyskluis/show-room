<?php
session_start();

// Controleer of de gebruiker een klant is
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'klant') {
    header('Location: login.php');
    exit;
}

// Include database
require '../database/db.php';
$db = new DB();

// Controleer of reservering_id is meegegeven
$reservering_id = $_POST['reservering_id'] ?? null;

if ($reservering_id === null) {
    echo "Geen reserverings-ID opgegeven!";
    exit;
}

try {
    // Haal de kamer_id op van de reservering
    $stmt = $db->execute("SELECT kamer_id FROM reserveringen WHERE reservering_id = :reservering_id AND klant_id = :klant_id", [
        ':reservering_id' => $reservering_id,
        ':klant_id' => $_SESSION['user_id']
    ]);

    $reservering = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reservering) {
        echo "Geen reservering gevonden of je hebt geen rechten om deze te annuleren.";
        exit;
    }

    $kamer_id = $reservering['kamer_id'];

    // Zet reservering op 'geannuleerd'
    $db->execute("UPDATE reserveringen SET status = 'geannuleerd' WHERE reservering_id = :reservering_id", [
        ':reservering_id' => $reservering_id
    ]);

    // Zet de kamer weer op 'beschikbaar'
    $db->execute("UPDATE kamers SET status = 'beschikbaar' WHERE kamer_id = :kamer_id", [
        ':kamer_id' => $kamer_id
    ]);

    // Redirect naar overzicht na annuleren
    header('Location: overzicht.php');
    exit;

} catch (PDOException $e) {
    echo "Fout: " . $e->getMessage();
    exit;
}
?>
