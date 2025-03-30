<?php
session_start();

// Controleer of de gebruiker is ingelogd als medewerker
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

require '../database/db.php';
$db = new DB();

// Haal alle reserveringen op
$sql = "SELECT 
            r.reservering_id, 
            k.voornaam AS klant_naam, 
            km.kamertype, 
            r.check_in_datum, 
            r.check_out_datum, 
            r.status 
        FROM reserveringen r
        JOIN klanten k ON r.klant_id = k.klant_id
        JOIN kamers km ON r.kamer_id = km.kamer_id
        ORDER BY r.check_in_datum ASC";

$stmt = $db->execute($sql);
$reserveringen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../components/header.php'; ?>

<link rel="stylesheet" href="../assets/css/overzicht.css">

<main>
    <h2>Reserveringen Overzicht</h2>
    <table class="reservation-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Klant</th>
                <th>Kamer</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Status</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reserveringen as $reservering): ?>
                <tr>
                    <td><?= htmlspecialchars($reservering['reservering_id']) ?></td>
                    <td><?= htmlspecialchars($reservering['klant_naam']) ?></td>
                    <td><?= htmlspecialchars($reservering['kamertype']) ?></td>
                    <td><?= htmlspecialchars($reservering['check_in_datum']) ?></td>
                    <td><?= htmlspecialchars($reservering['check_out_datum']) ?></td>
                    <td><?= htmlspecialchars($reservering['status']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $reservering['reservering_id'] ?>">Bewerken</a> |
                        <form method="POST" action="cancel.php" style="display:inline;">
                            <input type="hidden" name="reservering_id" value="<?= $reservering['reservering_id'] ?>">
                            <button type="submit" onclick="return confirm('Weet je zeker dat je deze reservering wilt annuleren?')">
                                Annuleren
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php include '../components/footer.php'; ?>