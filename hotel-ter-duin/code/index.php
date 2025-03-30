<?php
require_once("session_manager.php");
include 'components/header.php';
require 'database/db.php';

// Maak een databaseverbinding
$db = new DB();

// Haal het aantal beschikbare kamers op
$stmt = $db->execute("SELECT COUNT(*) as beschikbare_kamers FROM kamers WHERE status = 'beschikbaar'");
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$beschikbare_kamers = $result['beschikbare_kamers'] ?? 0;

?>
<div class="container">
    <main>
        <h1>Welkom bij Hotel Ter Duin</h1>
        <p>Geniet van een ontspannen verblijf aan de kust.</p>

        <?php
        // Controleer of de gebruiker is ingelogd als medewerker en er nog maar 2 kamers over zijn
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' && $beschikbare_kamers <= 2) {
            echo "<div class='alert alert-warning'>⚠️ Er zijn nog maar 1 of 2 kamers beschikbaar!</div>";
        }
        ?>
    </main>
</div>

<?php include 'components/footer.php'; ?>