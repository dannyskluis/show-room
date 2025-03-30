<?php
session_start();
require_once 'connection.php'; // Assuming DB.php contains your database connection class

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate input
    if (!empty($firstname) && !empty($password)) {
        // Query the database for the user
        $db = new DB();
        $sql = "SELECT id, password FROM coworkers WHERE firstname = :firstname";
        $user = $db->execute($sql, ['firstname' => $firstname])->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Store user ID in session
            $_SESSION['user_id'] = $user['id'];
            header('Location: homepage.php');
            exit;
        } else {
            $error = 'Invalid firstname or password.';
        }
    } else {
        $error = 'Please fill in all fields.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <h1>Login</h1>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="firstname">Firstname:</label>
        <input type="text" id="firstname" name="firstname" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
