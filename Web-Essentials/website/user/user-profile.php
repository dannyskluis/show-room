<?php
session_start();
if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
    header("Location:user-login.php");
    exit();
}
include '../header.php';
include 'user.php';

$user = new User($myDb);
$userData = $user->getOneUser($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naam = htmlspecialchars($_POST['naam']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $rol = $_SESSION['rol'];

    try {
        $user->editUser($naam, $email, $password, $rol, $_SESSION['user_id']);
        $_SESSION['username'] = $email;
        header("Location:user-profile.php?update=success");
        exit();
    } catch (Exception $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../style/User/profile.css">
</head>
<body>
<div class="container">
    <h2>Your Profile</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST">
        <input type="text" name="naam" value="<?php echo $userData['naam']; ?>" placeholder="Name" required>
        <input type="email" name="email" value="<?php echo $userData['email']; ?>" placeholder="Email" required>
        <input type="password" name="password" placeholder="New Password" required>
        <input type="submit" value="Update Profile">
    </form>
</div>
</body>
</html>
<?php
include '../footer.php';
?>