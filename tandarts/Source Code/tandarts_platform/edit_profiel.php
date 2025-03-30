<?php
require_once("../Database/session_manager.php");
require_once("../Database/Authentication.php");
require_once("../Database/Tandarts.php");

if (isset($_SESSION['EMPLOYEE_ID'])) {
    $dentistID = $_SESSION['EMPLOYEE_ID'];
    $dentistdata = $Dentists->oneEmployee($dentistID);
} else {
    header("Location: ../Homepage.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = $Dentists->validateAndProcessEditForm($_POST, $dentistID);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Javascript/dentist_platform_header.js" defer></script>
    <link rel="stylesheet" href="../Style/Tandarts/header.css">
    <link rel="stylesheet" href="../Style/Tandarts/edit_profile.css">
    <title>Edit personal information</title>
</head>
<body>
<nav id="nav" class="nav"></nav>

<main>
    <div class="edit-profile">
        <div class="profile">
            <?php if (!empty($error)): ?>
                <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <form method="POST" action="">
                <label for="firstname">Firstname:</label>
                <input type="text" name="firstname" value="<?php echo htmlspecialchars($dentistdata['EMPLOYEE_FIRSTNAME']); ?>" required><br>

                <label for="lastname">Lastname:</label>
                <input type="text" name="lastname" value="<?php echo htmlspecialchars($dentistdata['EMPLOYEE_LASTNAME']); ?>" required><br>

                <label for="email">Private email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($dentistdata['EMPLOYEE_PRIVATE_EMAIL']); ?>" required><br>

                <label for="phonenumber">Phonenumber:</label>
                <input type="tel" name="phonenumber" value="<?php echo htmlspecialchars($dentistdata['EMPLOYEE_PHONENUMBER']); ?>" required><br>

                <label for="dateofbirth">Date of Birth:</label>
                <input type="date" name="dateofbirth" value="<?php echo $dentistdata['EMPLOYEE_BIRTHDAY']; ?>" required
                    max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>"><br>

                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Enter new password"><br>

                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" placeholder="Confirm new password"><br>

                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</main>

<!-- hier footer -->
</body>
</html>
