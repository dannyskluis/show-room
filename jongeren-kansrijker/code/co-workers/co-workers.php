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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Co-workers</title>
    <link rel="stylesheet" href="../styles/co-workers.css">
</head>

<body>
    <?php
    $pageTitle = 'Co-workers';
    include '../header-page.php';
    ?>

    <!-- Page heading and add co-worker button -->
    <div class="top">
        <h1>Werknemers</h1>
        <a href="add-co-workers.php" class="action-btn">Voeg werknemer toe</a>
    </div>

    <!-- Table to display list of co-workers -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Tussenvoegsel</th>
                    <th>Achternaam</th>
                    <th>Email</th>
                    <th>Telefoonnummer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query to fetch all co-workers
                $query = "SELECT id, firstname, middlename, lastname, email, phonenumber, password FROM coworkers";
                $medewerkers = $db->fetchAll($query);

                // Check if any co-workers are retrieved
                if (!empty($medewerkers)) {
                    foreach ($medewerkers as $medewerker) {
                        echo "<tr>
                              <td>{$medewerker['id']}</td>
                              <td>{$medewerker['firstname']}</td>
                              <td>{$medewerker['middlename']}</td>
                              <td>{$medewerker['lastname']}</td>
                              <td>{$medewerker['email']}</td>
                              <td>{$medewerker['phonenumber']}</td>";

                        // Display edit and delete options only for the logged-in user
                        if ($_SESSION['user_id'] == $medewerker['id']) {
                            echo "<td>
                                  <a href='edit-co-workers.php?id={$medewerker['id']}' class='action-btn'>Edit</a>
                                  <a href='delete-co-workers.php?id={$medewerker['id']}' class='action-btn' onclick='return confirm(\"Are you sure you want to delete this co-worker?\");'>Delete</a>
                                  </td>";
                        } else {
                            echo "<td></td>"; // Leave actions column empty for others
                        }

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align: center;'>No co-workers found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include '../footer.php'; ?>
</body>

</html>