<?php
require_once("../Database/session_manager.php");
require_once("../Database/Authentication.php");
require_once("../Database/Insurance.php");
require_once("../Database/Patients.php");
require_once('../Database/Appointments.php');

$isLoggedIn = isset($_SESSION['PATIENT_ID']);

if (isset($_SESSION['PATIENT_ID'])) {
    $patientID = $_SESSION['PATIENT_ID'];
    $patientData = $Patients->onePatient($patientID);
} else {
    $_SESSION['LOGIN_ERROR'] = true;
    header("Location: ../Homepage.php?error=login");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = $Patients->validateAndProcessEditForm($_POST, $patientID);
}

$unreviewedAppointments = [];
if (isset($_SESSION['PATIENT_ID'])) {
    // Only fetch unreviewed appointments if the patient is logged in
    $patientID = $_SESSION['PATIENT_ID'];
    $unreviewedAppointments = $appointment->getUnreviewedAppointments($patientID);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Javascript/patienten_platform_header.js" defer></script>
    <script src="../Javascript/patienten_platform_footer.js" defer></script>
    <link rel="stylesheet" href="../Style/public_header.css">
    <link rel="stylesheet" href="../Style/public_footer.css">
    <link rel="stylesheet" href="../Style/editProfile.css">
    <title>Edit personal information</title>
</head>
<body>
<nav id="nav" class="nav" data-loggedin="<?php echo $isLoggedIn ? 'true' : 'false'; ?>"></nav>
<script>
    const unreviewedAppointments = <?php echo json_encode($unreviewedAppointments); ?>;
</script>

<main>
    <div class="edit-profile">
        <div class="profile">
            <?php if (!empty($error)): ?>
                <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <form method="POST" action="">
                <label for="firstname">Firstname:</label>
                <input type="text" name="firstname" value="<?php echo htmlspecialchars($patientData['PATIENT_FIRSTNAME']); ?>" required><br>

                <label for="lastname">Lastname:</label>
                <input type="text" name="lastname" value="<?php echo htmlspecialchars($patientData['PATIENT_LASTNAME']); ?>" required><br>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($patientData['PATIENT_EMAIL']); ?>" required><br>

                <label for="phonenumber">Phonenumber:</label>
                <input type="tel" name="phonenumber" value="<?php echo htmlspecialchars($patientData['PATIENT_PHONENUMBER']); ?>" required><br>

                <label for="dateofbirth">Date of Birth:</label>
                <input type="date" name="dateofbirth" value="<?php echo $patientData['PATIENT_BIRTHDATE']; ?>" required
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

<footer id="footer" class="footer"></footer>
</body>
</html>
