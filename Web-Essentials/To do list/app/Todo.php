<?php

class Todo {
    private $pdo;
    private $table_name = "todos";

    public $id;
    public $title;
    public $checked;
    public $date_time;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (title) VALUES (:title)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':title', $this->title);
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->pdo->query($query);
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET checked = :checked WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':checked', $this->checked);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>