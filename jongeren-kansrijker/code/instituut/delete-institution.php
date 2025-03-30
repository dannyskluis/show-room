<?php
session_start();
require_once 'connection.php';  // Adjust path if needed

// Check if the ID is passed
if (isset($_POST['id'])) {
    $institutionId = $_POST['id'];

    // Create DB instance
    $db = new DB(); 

    // Delete the institution
    $query = "DELETE FROM institutions WHERE id = ?";
    $result = $db->execute($query, [$institutionId]);

    // Check if the deletion was successful
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
