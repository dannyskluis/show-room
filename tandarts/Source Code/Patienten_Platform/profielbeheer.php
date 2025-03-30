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
    <link rel="stylesheet" href="../Style/profielbeheer.css">
    <title>Profile - Patient</title>
</head>
<body>
<nav id="nav" class="nav" data-loggedin="<?php echo $isLoggedIn ? 'true' : 'false'; ?>"></nav>
<script>
    const unreviewedAppointments = <?php echo json_encode($unreviewedAppointments); ?>;
</script>

    <main>
        <div class="total-profile">
            <div class="profile">
                <h2>Profile:</h2>
                <p>Name: <?php echo $patientData['PATIENT_FIRSTNAME'] . ' ' . $patientData['PATIENT_LASTNAME']; ?></p>
                <p>Email: <?php echo $patientData['PATIENT_EMAIL']; ?></p>
                <p>Phonenumber: <?php echo $patientData['PATIENT_PHONENUMBER']; ?></p>
                <p>Birthdate: <?php echo $patientData['PATIENT_BIRTHDATE']; ?></p>
                <a href="edit_profiel.php" class="edit"><p>Edit personal information</p></a>
            </div>
            <div class="insurance-profile">
                <h2>Insurance:</h2>
                <!-- if it is not empty then show the data in the column else if it is empty then show 'Not provided yet' -->
                <p>Insurance Provider: <?php echo !empty($insuranceData['INSURANCE_PROVIDER']) ? htmlspecialchars($insuranceData['INSURANCE_PROVIDER']) : 'Not provided yet'; ?></p>
                <p>Policy Number: <?php echo !empty($insuranceData['POLICY_NUMBER']) ? htmlspecialchars($insuranceData['POLICY_NUMBER']) : 'Not provided yet'; ?></p>
                <p>Coverage details: <?php echo !empty($insuranceData['COVERAGE_DETAILS']) ? htmlspecialchars($insuranceData['COVERAGE_DETAILS']) : 'Not provided yet'; ?></p>
                <p>Insurance Start date: <?php echo !empty($insuranceData['INSURANCE_START_DATE']) ? htmlspecialchars($insuranceData['INSURANCE_START_DATE']) : 'Not provided yet'; ?></p>
                <p>Insurance Expiry date: <?php echo !empty($insuranceData['INSURANCE_EXPIRY_DATE']) ? htmlspecialchars($insuranceData['INSURANCE_EXPIRY_DATE']) : 'Not provided yet'; ?></p>
                <a href="edit_insurance.php" class="edit"><p>Edit insurance information</p></a>
            </div>
            <a href="../Homepage.php" class="return"><p>Return to homepage</p></a>
        </div>
    </main>

    <footer id="footer" class="footer"></footer>
</body>
</html>
