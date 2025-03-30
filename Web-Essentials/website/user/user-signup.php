<?php
include '../header.php';
include 'user.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User($myDb);
    try {
        $naam = htmlspecialchars($_POST['naam']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $rol = 'student'; 

        if ($user->emailExists($email)) {
            $error = 'Email already exists. Please use a different email.';
        } else {
            $user->insertUser($naam, $email, $password, $rol);
            header("Location:user-login.php?signup=success");
            exit();
        }
    } catch (\Exception $e) {
        $error = 'Error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/User/login-user.css">
    <title>Sign Up</title>
</head>
<body>
<div class="container">
    <div class="login">
        <h1>Sign Up</h1>
        <form method="POST">
            <input type="text" name="naam" placeholder="Naam" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit">
        </form>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <p>Already have an account? <a href="user-login.php">Login</a></p>
    </div>
</div>
</body>
</html>
<?php
include '../footer.php';
?>