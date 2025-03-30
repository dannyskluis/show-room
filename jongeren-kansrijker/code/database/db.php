<?php

class DB {
    private $dbh;
    protected $stmt;

    public function __construct($db = "jongeren_kansrijker", $port = "3306", $host = "localhost", $user = "root", $pass = "") {
        try {
            $this->dbh = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $user, $pass);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
    }

    public function execute($sql, $placeholders = null) {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($placeholders);
        return $stmt;
    }

    public function login($username) {
        $stmt = $this->dbh->prepare("SELECT * FROM coworkers WHERE username = ?");
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }

    public function aanmelden($gebruikersnaam, $wachtwoord, $email, $rol = 'gebruiker') {
        $stmt = $this->dbh->prepare("INSERT INTO gebruikers (gebruikersnaam, wachtwoord, email, rol) VALUES (?, ?, ?, ?)");
        $stmt->execute([$gebruikersnaam, $wachtwoord, $email, $rol]);
    }
}

$myDb = new DB('jongeren_kansrijker');
?>
