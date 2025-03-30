<?php

if(isset($_POST['title'])){
    require '../db_conn.php';
    require 'Todo.php';

    $database = new Database();
    $todo = new Todo($database->pdo);
    $todo->title = $_POST['title'];

    if(empty($todo->title)){
        header("Location: ../index.php?mess=error");
    } else {
        if($todo->create()){
            header("Location: ../index.php?mess=success");
        } else {
            header("Location: ../index.php");
        }
    }
} else {
    header("Location: ../index.php?mess=error");
}
?>