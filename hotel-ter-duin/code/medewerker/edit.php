<?php
session_start();

// Controleer of de gebruiker is ingelogd als medewerker
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

require '../database/db.php';
$db = new DB();

if (!isset($_GET['id'])) {
    die("Geen reservering geselecteerd.");
}

$reservering_id = $_GET['id'];

// Haal reservering op
$sql = "SELECT * FROM reserveringen WHERE reservering_id = ?";
$stmt = $db->execute($sql, [$reservering_id]);
$reservering = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reservering) {
    die("Reservering niet gevonden.");
}

// Formulier verwerking
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $check_in_datum = $_POST['check_in_datum'];
    $check_out_datum = $_POST['check_out_datum'];
    $status = $_POST['status'];

    $update_sql = "UPDATE reserveringen SET check_in_datum = ?, check_out_datum = ?, status = ? WHERE reservering_id = ?";
    $db->execute($update_sql, [$check_in_datum, $check_out_datum, $status, $reservering_id]);

    header("Location: reservering_overzicht.php");
    exit;
}
?>

<?php include '../components/header.php'; ?>

<div class="container">
    <main>
        <h2>Reservering Bewerken</h2>
        <form method="POST">
            <label for="check_in_datum">Check-in Datum:</label>
            <input type="date" name="check_in_datum" value="<?= htmlspecialchars($reservering['check_in_datum']) ?>" required><br>

            <label for="check_out_datum">Check-out Datum:</label>
            <input type="date" name="check_out_datum" value="<?= htmlspecialchars($reservering['check_out_datum']) ?>" required><br>

            <label for="status">Status:</label>
            <select name="status">
                <option value="geboekt" <?= ($reservering['status'] == 'geboekt') ? 'selected' : '' ?>>Geboekt</option>
                <option value="geannuleerd" <?= ($reservering['status'] == 'geannuleerd') ? 'selected' : '' ?>>Geannuleerd</option>
                <option value="bezet" <?= ($reservering['status'] == 'bezet') ? 'selected' : '' ?>>Bezet</option>
            </select><br>

            <button type="submit">Opslaan</button>
        </form>
    </main>
</div>

<?php include '../components/footer.php'; ?>
