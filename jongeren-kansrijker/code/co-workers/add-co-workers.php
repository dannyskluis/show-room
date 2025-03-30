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

// Initialize error and success message arrays
$errors = [];
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form input
    $firstname = trim($_POST['firstname']);
    $middlename = trim($_POST['middlename']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $phonenumber = trim($_POST['phonenumber']);
    $password = trim($_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Validation to check if required fields are filled
    if (empty($firstname) || empty($lastname) || empty($email) || empty($phonenumber) || empty($password)) {
        $errors[] = 'All fields except middlename are required.';
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    // Check if email already exists in the database
    $checkDuplicateQuery = "SELECT id FROM coworkers WHERE email = :email";
    $duplicate = $db->fetch($checkDuplicateQuery, [':email' => $email]);

    if ($duplicate) {
        $errors[] = 'A co-worker with this email already exists.';
    }

    // If no errors, insert new co-worker data into the database
    if (empty($errors)) {
        $query = "INSERT INTO coworkers (firstname, middlename, lastname, email, phonenumber, password)
                  VALUES (:firstname, :middlename, :lastname, :email, :phonenumber, :password)";

        $params = [
            ':firstname' => $firstname,
            ':middlename' => $middlename,
            ':lastname' => $lastname,
            ':email' => $email,
            ':phonenumber' => $phonenumber,
            ':password' => $hashedPassword,
        ];

        if ($db->execute($query, $params)) {
            $success = 'Co-worker added successfully!';
        } else {
            $errors[] = 'Failed to add co-worker. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Co-worker</title>
    <link rel="stylesheet" href="../styles/co-workers.css">
</head>

<body>
    <?php
    $pageTitle = 'Add Co-worker';
    include '../header-page.php';
    ?>

    <div class="co-worker-form">
        <h1>Add Co-worker</h1>

        <!-- Display error messages if any -->
        <?php if (!empty($errors)) : ?>
            <div class="error-messages">
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Display success message if any -->
        <?php if (!empty($success)) : ?>
            <div class="success-message">
                <p><?= htmlspecialchars($success) ?></p>
            </div>
        <?php endif; ?>

        <!-- Form for adding a new co-worker -->
        <form action="add-co-workers.php" method="POST">
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" required>

            <label for="middlename">Middle Name:</label>
            <input type="text" id="middlename" name="middlename">

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phonenumber">Phone Number:</label>
            <input type="text" id="phonenumber" name="phonenumber" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="action-btn">Add Co-worker</button>
            <button type="button" class="action-btn" onclick="window.location.href='co-workers.php'">Go Back</button>
        </form>
    </div>

    <?php include '../footer.php'; ?>
</body>

</html>