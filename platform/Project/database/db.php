<?php
class DB 
{
    private $host;
    private $username;
    private $password;
    private $database;

    private $port;
    private $dbh;
    

    public function __construct() 
    {
        $this->host = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->database = 'platform';
        $this->port = 3307;

        $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->database";
        try {
            $this->dbh = new PDO($dsn, $this->username, $this->password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
    }

    // function to make sql query easy and not write the same code every time
    public function run($query, $args = null): PDOStatement | false
    {
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->execute($args);
            return $stmt;
        } catch (PDOException $e) {
            die("Query error: " . $e->getMessage());
        }
    }

    public function lastId() : int
    {
        return $this->dbh->lastInsertId();
    }
}