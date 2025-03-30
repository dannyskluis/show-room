<?php
require_once("../Database/session_manager.php");
require_once("../Database/Authentication.php");
require_once("../Database/Insurance.php");
require_once("../Database/Patients.php");

if (isset($_SESSION['EMPLOYEE_ID'])) {
    $dentistID = $_SESSION['EMPLOYEE_ID'];

    if (!isset($_GET['Patient_ID'])) {
        echo "Patient ID not provided.";
        exit();
    }
    
    $patient_ID = intval($_GET['Patient_ID']);
    $insuranceData = $Insurance->oneInsurance($patient_ID);
    $patientData = $Patients->onePatient($patient_ID);
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
    <link rel="stylesheet" href="../Style/Tandarts/insurance.css">
    <title>Profile - Patient</title>
</head>
<body>
<nav id="nav" class="nav"></nav>

    <main>
        <div class="total-insurance">
            <p>Name: <?php echo htmlspecialchars($patientData['PATIENT_FIRSTNAME']) . ' ' . htmlspecialchars($patientData['PATIENT_LASTNAME']); ?></p>

            <div class="insurance-card">
                <span>Insurance Provider:</span>
                <p><?php echo !empty($insuranceData['INSURANCE_PROVIDER']) ? htmlspecialchars($insuranceData['INSURANCE_PROVIDER']) : 'Not provided yet'; ?></p>
            </div>

            <div class="insurance-card">
                <span>Policy Number:</span>
                <p><?php echo !empty($insuranceData['POLICY_NUMBER']) ? htmlspecialchars($insuranceData['POLICY_NUMBER']) : 'Not provided yet'; ?></p>
            </div>

            <div class="insurance-card">
                <span>Coverage Details:</span>
                <p><?php echo !empty($insuranceData['COVERAGE_DETAILS']) ? htmlspecialchars($insuranceData['COVERAGE_DETAILS']) : 'Not provided yet'; ?></p>
            </div>

            <div class="insurance-card">
                <span>Insurance Start Date:</span>
                <p><?php echo !empty($insuranceData['INSURANCE_START_DATE']) ? htmlspecialchars($insuranceData['INSURANCE_START_DATE']) : 'Not provided yet'; ?></p>
            </div>

            <div class="insurance-card">
                <span>Insurance End Date:</span>
                <p><?php echo !empty($insuranceData['INSURANCE_EXPIRY_DATE']) ? htmlspecialchars($insuranceData['INSURANCE_EXPIRY_DATE']) : 'Not provided yet'; ?></p>
            </div>

            <a href="show_patients.php" class="return"><p>Return to patients</p></a>
        </div>
    </main>
</body>
</html>