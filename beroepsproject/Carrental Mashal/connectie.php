<?php
// Verbinding maken met de database (pas de gegevens aan indien nodig)
$host = "localhost";
$username = "root";
$password = "";
$database = "carrental";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindingsfout: " . $e->getMessage());
}
?>
