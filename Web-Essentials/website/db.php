<?php
class DB {
    private $dbh;
    protected $stmt;

    public function __construct($db, $host = "localhost", $user = "root", $pass = "") {
        try {
            $this->dbh = new PDO("mysql:host=$host;dbname=$db;", $user, $pass);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
    }

    public function execute($query, $args = null) {
        $stmt = $this->dbh->prepare($query);
        $stmt->execute($args);
        return $stmt;
    }

    public function lastId() {
        return $this->dbh->lastInsertId();
    }
}

$myDb = new DB('school');
?>