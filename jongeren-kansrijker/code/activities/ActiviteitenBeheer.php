<?php


require_once '../connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

// Database connection


class ActiviteitenBeheer {
    private $dbh;

    public function __construct() {
        $this->dbh = new DB('jongeren_kansrijker');
    }

    // Activiteit toevoegen
    public function addActiviteit($naam, $beschrijving, $datum, $locatie) {
        if (empty($naam) || empty($beschrijving) || empty($datum) || empty($locatie)) {
            return false; // Invoer is niet geldig
        }

        $sql = "INSERT INTO activiteiten (naam, beschrijving, datum, locatie) VALUES (?, ?, ?, ?)";
        $placeholders = [$naam, $beschrijving, $datum, $locatie];

        try {
            $stmt = $this->dbh->execute($sql, $placeholders);
            return $stmt;
        } catch (Exception $e) {
            return false;
        }
    }

    // Alle activiteiten ophalen
    public function getAllActiviteiten() {
        $sql = "SELECT * FROM activiteiten";
        $stmt = $this->dbh->execute($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Activiteit ophalen op basis van ID
    public function getActiviteitById($id) {
        $sql = "SELECT * FROM activiteiten WHERE id = ?";
        $placeholders = [$id];
        $stmt = $this->dbh->execute($sql, $placeholders);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Activiteit bijwerken
    public function updateActiviteit($id, $naam, $beschrijving, $datum, $locatie) {
        if (empty($naam) || empty($beschrijving) || empty($datum) || empty($locatie)) {
            return false;
        }

        $sql = "UPDATE activiteiten SET naam = ?, beschrijving = ?, datum = ?, locatie = ? WHERE id = ?";
        $placeholders = [$naam, $beschrijving, $datum, $locatie, $id];

        try {
            $stmt = $this->dbh->execute($sql, $placeholders);
            return $stmt;
        } catch (Exception $e) {
            return false;
        }
    }

    // Activiteit verwijderen
    public function verwijderActiviteit($id) {
        $sql = "DELETE FROM activiteiten WHERE id = ?";
        $placeholders = [$id];

        try {
            $stmt = $this->dbh->execute($sql, $placeholders);
            return $stmt;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>
