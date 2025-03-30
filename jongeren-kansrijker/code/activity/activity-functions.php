<?php

include '../connection.php';
class activity {
    public function voegActiviteitToe($db, $naam, $beschrijving, $datum) {
        $sql = "INSERT INTO activiteiten (naam, beschrijving, datum) VALUES (:naam, :beschrijving, :datum)";
        $db->execute($sql, [':naam' => $naam, ':beschrijving' => $beschrijving, ':datum' => $datum]);
    }

    public function wijzigActiviteit($db, $id, $naam, $beschrijving, $datum) {
        $sql = "UPDATE activiteiten SET naam = :naam, beschrijving = :beschrijving, datum = :datum WHERE id = :id";
        $db->execute($sql, [':id' => $id, ':naam' => $naam, ':beschrijving' => $beschrijving, ':datum' => $datum]);
    }

    public function verwijderActiviteit($db, $id) {
        $sql = "DELETE FROM activiteiten WHERE id = :id";
        $db->execute($sql, [':id' => $id]);
    }

    public function haalActiviteitenMetDeelnemersOp($db) {
        $sql = "
            SELECT 
                a.id AS activiteit_id, 
                a.naam AS activiteit_naam, 
                a.beschrijving, 
                a.datum, 
                d.id AS deelnemer_id, 
                d.naam AS deelnemer_naam, 
                d.email AS deelnemer_email
            FROM activiteiten a
            LEFT JOIN activiteit_deelnemers ad ON a.id = ad.activiteit_id
            LEFT JOIN deelnemers d ON ad.deelnemer_id = d.id
            ORDER BY a.datum, a.id";
        return $db->execute($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
