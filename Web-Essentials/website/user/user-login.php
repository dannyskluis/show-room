<?php
include '../header.php';
include 'user.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User($myDb);
    try {
        $email = htmlspecialchars($_POST['email']);
        $pass = htmlspecialchars($_POST['password']);
        $userExist = $user->login($email);

        if ($userExist) {
            $passVerify = password_verify($pass, $userExist['password']);
            if ($userExist && $passVerify) {
                session_start();
                $_SESSION['is_logged_in'] = true;
                $_SESSION['naam'] = $userExist['naam'];
                $_SESSION['user_id'] = $userExist['id'];
                $_SESSION['username'] = $userExist['email'];
                $_SESSION['rol'] = $userExist['rol'];
                header("Location:user-profile.php?logged_in");
                exit();
            } else {
                $error = "Incorrect username or password";
            }
        } else {
            $error = "Incorrect username or password";
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
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="login">
        <h1>Login</h1>
        <form method="POST">
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <p>Don't have an account? <a href="user-signup.php">Register</a></p>
    </div>
</div>
</body>
</html>
<?php
include '../footer.php';
?>