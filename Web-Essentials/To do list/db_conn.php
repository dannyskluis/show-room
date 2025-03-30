<?php
class Database {
    public $pdo;
 
    public function __construct($db = "to_do_list", $user="root", $pass="", $host="localhost:3306") {
        try {
            $this->pdo = new PDO("mysql:host=$host; dbname=$db", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        } catch (PDOException $e) {
            echo "Connection faild: " . $e->getMessage();
        }
    }
}
?>
 
 