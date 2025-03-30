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
    $insuranceData = $Insurance->oneInsurance($patientID);
} else {
    $_SESSION['LOGIN_ERROR'] = true;
    header("Location: ../Homepage.php?error=login");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = $Insurance->validateAndProcessEditInsuranceForm($_POST, $patientID);
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
                <label for="provider">Insurance Provider:</label>
                <input type="text" name="provider" value="<?php echo htmlspecialchars($insuranceData['INSURANCE_PROVIDER']); ?>" required><br>

                <label for="policynumber">Policy number:</label>
                <input type="text" name="policynumber" value="<?php echo htmlspecialchars($insuranceData['POLICY_NUMBER']); ?>" required><br>

                <label for="coveragedetails">Coverage details:</label>
                <input type="text" name="coveragedetails" value="<?php echo htmlspecialchars($insuranceData['COVERAGE_DETAILS']); ?>" required><br>

                <label for="insurancestartdate">Insurance start date:</label>
                <input type="date" name="insurancestartdate" value="<?php echo htmlspecialchars($insuranceData['INSURANCE_START_DATE'] ?? ''); ?>" required><br>

                <label for="insuranceenddate">Insurance end date:</label>
                <input type="date" name="insuranceenddate" value="<?php echo htmlspecialchars($insuranceData['INSURANCE_EXPIRY_DATE'] ?? ''); ?>" required><br>

                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</main>

<footer id="footer" class="footer"></footer>
</body>
</html>
