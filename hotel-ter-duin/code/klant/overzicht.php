<?php
session_start();

// Check if the user is logged in as a customer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'klant') {
    // Redirect to login if not logged in as a customer
    header('Location: login.php');
    exit;
}

$klant_id = $_SESSION['user_id']; // Automatically get klant_id from session

require '../database/db.php';
$db = new DB();

// Fetch the customer's reservations based on their klant_id
$sql = "SELECT r.reservering_id, k.kamertype, r.check_in_datum, r.check_out_datum, r.status, k.prijs
        FROM reserveringen r
        JOIN kamers k ON r.kamer_id = k.kamer_id
        WHERE r.klant_id = :klant_id";
$stmt = $db->execute($sql, [':klant_id' => $klant_id]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include '../components/header.php'; ?>

<link rel="stylesheet" href="../assets/css/overzicht.css">

<main class="reservation-overview">
    <h2>Your Reservations</h2>

    <?php if (count($reservations) > 0): ?>
        <table class="reservation-table">
            <thead>
                <tr>
                    <th>Room Type</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th>Actions</th> <!-- Added Actions column -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?= $reservation['kamertype'] ?></td>
                        <td><?= $reservation['check_in_datum'] ?></td>
                        <td><?= $reservation['check_out_datum'] ?></td>
                        <td class="status status-<?= strtolower($reservation['status']) ?>"><?= ucfirst($reservation['status']) ?></td>
                        <td>€<?= $reservation['prijs'] ?></td>
                        <td>
                            <?php if ($reservation['status'] !== 'geannuleerd'): ?> <!-- Check if it's already cancelled -->
                                <form action="cancel.php" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                    <input type="hidden" name="reservering_id" value="<?= $reservation['reservering_id'] ?>">
                                    <button type="submit" class="cancel-button">Cancel</button>
                                </form>
                            <?php else: ?>
                                <span>geannuleerd</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-reservations">You have no reservations.</p>
    <?php endif; ?>

</main>

<?php include '../components/footer.php'; ?>