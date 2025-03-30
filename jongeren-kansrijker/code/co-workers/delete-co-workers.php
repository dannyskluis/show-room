<?php
// Include database connection and start session
require_once '../connection.php';
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

// Initialize database connection
$db = new DB();

// Check if an ID is provided in the URL and validate it
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Invalid co-worker ID.");
}

$id = intval($_GET['id']); // Convert ID to an integer for safety

// Execute delete query to remove the co-worker with the provided ID
$query = "DELETE FROM coworkers WHERE id = :id";
$deleteSuccess = $db->execute($query, [':id' => $id]);

// Check if the deletion was successful
if ($deleteSuccess) {
    // Redirect to the co-workers page after successful deletion
    header('Location: co-workers.php');
    exit;
} else {
    die("Failed to delete co-worker. Please try again.");
}
