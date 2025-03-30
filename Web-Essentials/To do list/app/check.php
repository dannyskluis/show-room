<?php

if(isset($_POST['id'])){
    require '../db_conn.php';
    require 'Todo.php';

    $database = new Database();
    $todo = new Todo($database->pdo);
    $todo->id = $_POST['id'];

    if(empty($todo->id)){
        echo 'error';
    } else {
        $stmt = $database->pdo->prepare("SELECT id, checked FROM todos WHERE id=?");
        $stmt->execute([$todo->id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $todo->checked = $row['checked'] ? 0 : 1;
            if($todo->update()){
                echo $row['checked'];
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }
} else {
    header("Location: ../index.php?mess=error");
}
?>