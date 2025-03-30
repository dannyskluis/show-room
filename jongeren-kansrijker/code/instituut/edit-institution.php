<?php
session_start();
require_once 'connection.php';  // Adjust path if needed

// Check if the institution ID is passed via GET
if (!isset($_GET['id'])) {
    die('Institution ID is required.');
}

$institutionId = $_GET['id'];

// Create DB instance
$db = new DB();

// Fetch the institution details by ID
$query = "SELECT * FROM institutions WHERE id = ?";
$institution = $db->fetch($query, [$institutionId]);

// Check if the institution exists
if (!$institution) {
    die('Institution not found.');
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $description = $_POST['description'];

    // Update the institution in the database
    $query = "UPDATE institutions SET name = ?, address = ?, description = ? WHERE id = ?";
    $db->execute($query, [$name, $address, $description, $institutionId]);

    // Redirect back to the institutions page
    header('Location: institutions.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituut Bewerken</title>
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            width: 100%;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Instituut Bewerken</h1>
        <form method="post">
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($institution['name']) ?>" required><br>

            <label for="address">Adres:</label>
            <input type="text" id="address" name="address" value="<?= htmlspecialchars($institution['address']) ?>"><br>

            <label for="description">Beschrijving:</label>
            <textarea id="description" name="description"><?= htmlspecialchars($institution['description']) ?></textarea><br>

            <button type="submit">Opslaan</button>
        </form>
    </div>

</body>
</html>
