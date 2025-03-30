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

// Check if an ID is passed in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: co-workers.php');
    exit;
}

$coWorkerId = $_GET['id'];

// Fetch co-worker details based on the provided ID
$query = "SELECT id, firstname, middlename, lastname, email, phonenumber FROM coworkers WHERE id = :id";
$coWorker = $db->fetch($query, ['id' => $coWorkerId]);

// If no co-worker is found, redirect to the co-workers list page
if (!$coWorker) {
    header('Location: co-workers.php');
    exit;
}

// Handle form submission to update co-worker details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'] ?? '';
    $middlename = $_POST['middlename'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
    $phonenumber = $_POST['phonenumber'] ?? '';

    // Update query for modifying co-worker details
    $updateQuery = "UPDATE coworkers 
                    SET firstname = :firstname, middlename = :middlename, lastname = :lastname, 
                        email = :email, phonenumber = :phonenumber 
                    WHERE id = :id";

    $params = [
        'firstname' => $firstname,
        'middlename' => $middlename,
        'lastname' => $lastname,
        'email' => $email,
        'phonenumber' => $phonenumber,
        'id' => $coWorkerId,
    ];

    // Execute the update query and check success
    if ($db->execute($updateQuery, $params)) {
        $_SESSION['success_message'] = "Co-worker details updated successfully."; // Set success message in session
        header('Location: co-workers.php'); // Redirect to the co-workers list page
        exit;
    } else {
        // Set error message if update fails
        $error = "Failed to update co-worker details.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Co-worker</title>
    <link rel="stylesheet" href="../styles/co-workers.css">
</head>

<body>
    <?php
    $pageTitle = 'Edit Co-worker';
    include '../header-page.php';
    ?>

    <h1 style="text-align: center;">Edit Co-worker</h1>

    <!-- Form for updating co-worker details -->
    <form action="" method="POST" class="co-worker-form">
        <?php if (isset($error)) : ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p> <!-- Display error if any -->
        <?php endif; ?>

        <!-- Form fields with existing co-worker data -->
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" value="<?= htmlspecialchars($coWorker['firstname']) ?>" required>

        <label for="middlename">Middle Name:</label>
        <input type="text" id="middlename" name="middlename" value="<?= htmlspecialchars($coWorker['middlename']) ?>">

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" value="<?= htmlspecialchars($coWorker['lastname']) ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($coWorker['email']) ?>" required>

        <label for="phonenumber">Phone Number:</label>
        <input type="text" id="phonenumber" name="phonenumber" value="<?= htmlspecialchars($coWorker['phonenumber']) ?>" required>

        <button type="submit" class="action-btn">Update</button>
        <a href="co-workers.php" class="action-btn">Go back</a>

    </form>

    <?php include '../footer.php';?>
</body>

</html>