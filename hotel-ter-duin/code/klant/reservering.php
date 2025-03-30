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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kamer_id = $_POST['kamer_id'];
    $check_in_datum = $_POST['check_in_datum'];
    $check_out_datum = $_POST['check_out_datum'];
    $status = 'geboekt'; // Default status for the reservation

    // Prepare SQL to insert the reservation into the database
    $sql = "INSERT INTO reserveringen (klant_id, kamer_id, check_in_datum, check_out_datum, status)
            VALUES (:klant_id, :kamer_id, :check_in_datum, :check_out_datum, :status)";
    
    // Bind parameters and execute the query
    $placeholders = [
        ':klant_id' => $klant_id,
        ':kamer_id' => $kamer_id,
        ':check_in_datum' => $check_in_datum,
        ':check_out_datum' => $check_out_datum,
        ':status' => $status
    ];

    $db->execute($sql, $placeholders);

    // Update the room status to 'geboekt' (booked) after the reservation is made
    $update_sql = "UPDATE kamers SET status = :status WHERE kamer_id = :kamer_id";
    $update_placeholders = [
        ':status' => 'bezet',  // Set the room status as booked
        ':kamer_id' => $kamer_id
    ];

    $db->execute($update_sql, $update_placeholders);

    echo "Reservation successful! Room is now booked.";
}

// Fetch distinct available room types from the 'kamers' table
$sql = "SELECT DISTINCT kamertype, kamer_id, prijs FROM kamers WHERE status != 'bezet'";
$stmt = $db->execute($sql);
$kamers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../components/header.php'; ?>

<div class="container">
    <main>
        <form class="formulier" method="POST">
            <h2>Reservation Form</h2>

            <!-- Hidden field for klant_id (automatically taken from session) -->
            <input type="hidden" name="klant_id" value="<?= $klant_id ?>">

            <!-- Room Type Selection (No duplicate room types) -->
            <label for="kamer_id">Room Type:</label>
            <select name="kamer_id" id="kamer_id" required>
                <?php foreach ($kamers as $kamer): ?>
                    <option value="<?= $kamer['kamer_id'] ?>">
                        <?= $kamer['kamertype'] ?> - €<?= $kamer['prijs'] ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <!-- Check-in Date -->
            <label for="check_in_datum">Check-in Date:</label>
            <input type="date" name="check_in_datum" id="check_in_datum" required><br>

            <!-- Check-out Date -->
            <label for="check_out_datum">Check-out Date:</label>
            <input type="date" name="check_out_datum" id="check_out_datum" required><br>

            <button type="submit">Submit Reservation</button>
        </form>
    </main>
</div> 
