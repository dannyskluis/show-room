<?php

if(isset($_POST['id'])){
    require '../db_conn.php';
    require 'Todo.php';

    $database = new Database();
    $todo = new Todo($database->pdo);
    $todo->id = $_POST['id'];

    if(empty($todo->id)){
        echo 0;
    } else {
        if($todo->delete()){
            echo 1;
           
            } else {
                echo 0;
            }
        }
    } else {
        header("Location: ../index.php?mess=error");
    }
    ?>