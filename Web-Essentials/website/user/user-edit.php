<?php
session_start();
if (!$_SESSION['is_logged_in']) {
    header("Location:user-login.php");
    exit();
}

include '../header.php';
include 'user.php';

$userId = $_GET['id'];
$users = new User($myDb);
$user = $users->getOneUser($userId);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];
    
    try {
        $users->editUser($naam, $email, $password, $rol, $userId);
        header("Location:user-view.php?process=edit");
        exit();
    } catch (Exception $e) {
        $error = 'Error: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/User/edit.css">

    <title>Edit User</title>
</head>
<body>
<div class="container">
    <h3>Edit User</h3>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="naam">Naam:</label>
            <input type="text" name="naam" id="naam" value="<?php echo $user['naam']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo $user['password']; ?>" required>
        </div>
        <div class="form-group">
            <label for="rol">Rol:</label>
            <select name="rol" id="rol" required>
                <option value="manager" <?php if ($user['rol'] == 'manager') echo 'selected'; ?>>Manager</option>
                <option value="docent" <?php if ($user['rol'] == 'docent') echo 'selected'; ?>>Docent</option>
                <option value="mentor" <?php if ($user['rol'] == 'mentor') echo 'selected'; ?>>Mentor</option>
                <option value="student" <?php if ($user['rol'] == 'student') echo 'selected'; ?>>Student</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
<?php
include '../footer.php';
?>