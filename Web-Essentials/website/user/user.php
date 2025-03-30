<?php
include '../db.php';

class User {
    private $dbh;
    private $tableUser = 'user';

    public function __construct(DB $dbh) {
        $this->dbh = $dbh;
    }

    public function hash($password) : string {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function getAllUsers() : array {
        return $this->dbh->execute("SELECT * from $this->tableUser")->fetchAll();
    }

    public function getOneUser($id) : array {
        return $this->dbh->execute("SELECT * from $this->tableUser where id = ?", [$id])->fetch();
    }
   
    public function insertUser($naam, $email, $password, $rol) {
        return $this->dbh->execute("INSERT INTO $this->tableUser (naam, email, password, rol) values (?,?,?,?)", [$naam, $email, $this->hash($password), $rol]);
    }

    public function editUser($naam, $email, $password, $rol, $id) {
        if (!empty($password)) {
            $password = $this->hash($password);
            return $this->dbh->execute("UPDATE $this->tableUser SET naam = ?, email = ?, password = ?, rol = ? where id = ?", [$naam, $email, $password, $rol, $id]);
        } else {
            return $this->dbh->execute("UPDATE $this->tableUser SET naam = ?, email = ?, rol = ? where id = ?", [$naam, $email, $rol, $id]);
        }
    }

    public function deleteUser($id) {
        return $this->dbh->execute("DELETE FROM $this->tableUser where id = ?", [$id]);
    }

    public function login($email) {
        return $this->dbh->execute("SELECT * FROM $this->tableUser WHERE email = ?", [$email])->fetch();
    }

    public function getUsersByRole($role) : array {
        return $this->dbh->execute("SELECT * FROM $this->tableUser WHERE rol = ?", [$role])->fetchAll();
    }
    public function emailExists($email) : bool {
        $result = $this->dbh->execute("SELECT COUNT(*) as count FROM $this->tableUser WHERE email = ?", [$email])->fetch();
        return $result['count'] > 0;
    }
}

$user = new User($myDb);
?>