<?php
 
class DB {
    private $dbh;
    protected $stmt;
 
    public function __construct($db = "php_dentalpractice", $port = "3306", $host = "localhost", $user = "root", $pass = "") {
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

    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }
}
$myDb = new DB('php_dentalpractice');

