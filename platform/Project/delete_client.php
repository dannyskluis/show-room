<?php
require_once 'database/DB.php';

$db = new DB();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM clients WHERE client_id = :id";
    $stmt = $db->run($sql, array(':id' => $id));

    if ($stmt->rowCount() > 0) {
        header("Location: clients.php");
    } else {
        echo "Error deleting record.";
    }
} else {
    echo "Invalid request.";
}

?>
