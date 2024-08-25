<?php

function connectToDatabase($host, $dbname, $username, $password) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

function markProjectAsDeleted($pdo, $projectId) {
    $stmt = $pdo->prepare("UPDATE Projects SET Active = false WHERE ID = :projectId");
    $stmt->bindParam(":projectId", $projectId);
    $stmt->execute();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] == "markProjectAsDeleted") {
       
        $host = "localhost:3306";
        $dbname = "nextLogic";
        $username = "root";
        $password = "";

        $pdo = connectToDatabase($host, $dbname, $username, $password);

        $projectIdToDelete = $_POST["projectIdToDelete"];
        markProjectAsDeleted($pdo, $projectIdToDelete);
        $pdo = null;
    }
}


function getNonDeletedProjects($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM Projects WHERE Active = true");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


$pdo = connectToDatabase($host, $dbname, $username, $password);
$nonDeletedProjects = getNonDeletedProjects($pdo);
print_r($nonDeletedProjects);
$pdo = null; 
?>
