<?php
require_once("../Database/session_manager.php");
require_once("../Database/Authentication.php");
require_once("../Database/Tandarts.php");

if (isset($_SESSION['EMPLOYEE_ID'])) {
    $dentistID = $_SESSION['EMPLOYEE_ID'];

    $dentistData = $Dentists->oneEmployee($dentistID);
} else {
    header("Location: ../Homepage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Javascript/dentist_platform_header.js" defer></script>
    <link rel="stylesheet" href="../Style/Tandarts/header.css">
    <link rel="stylesheet" href="../Style/Tandarts/profile.css">
    <title>Profile - Patient</title>
</head>
<body>
    <nav id="nav" class="nav"></nav>

    <main>
        <div class="total-profile">
            <div class="profile">
                <h2>Profile:</h2>
                <p>Name: <?php echo $dentistData['EMPLOYEE_FIRSTNAME'] . ' ' . $dentistData['EMPLOYEE_LASTNAME']; ?></p>
                <p>Private email: <?php echo $dentistData['EMPLOYEE_PRIVATE_EMAIL']; ?></p>
                <p>Work email: <?php echo $dentistData['EMPLOYEE_WORK_EMAIL']; ?></p>
                <p>Phonenumber: <?php echo $dentistData['EMPLOYEE_PHONENUMBER']; ?></p>
                <p>Birthdate: <?php echo $dentistData['EMPLOYEE_BIRTHDAY']; ?></p>
                <p>Function: <?php echo $dentistData['EMPLOYEE_FUNCTION']; ?></p>
                <p>Salary: <?php echo $dentistData['EMPLOYEE_SALARY']; ?></p>
                <a href="edit_profiel.php"><p>Edit personal information</p></a>
            </div>
            <a href="dentists_platform_home.php" class="return"><p>Return to homepage</p></a>
        </div>
    </main>

    <!-- hier footer -->
</body>
</html>