<?php
require_once("../Database/session_manager.php");
require_once("../Database/Authentication.php");
require_once("../Database/Tandarts.php");
require_once("../Database/Patients.php");
require_once('../Database/Appointments.php');

$isLoggedIn = isset($_SESSION['PATIENT_ID']);
$appointmentID = $_GET['id'] ?? null;

if (isset($_SESSION['PATIENT_ID'])) {
    $patientID = $_SESSION['PATIENT_ID'];
    $patientData = $Patients->onePatient($patientID);
    $appointmentData = $Patients->oneAppointmentOfPatient($appointmentID, $patientID);
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
    <title>Appointment Details</title>
    <script src="../Javascript/patienten_platform_header.js" defer></script>
    <script src="../Javascript/patienten_platform_footer.js" defer></script>
    <link rel="stylesheet" href="../Style/public_header.css">
    <link rel="stylesheet" href="../Style/public_footer.css">
    <link rel="stylesheet" href="../Style/details_afspraak.css">
</head>

<body>
<nav id="nav" class="nav" data-loggedin="<?php echo $isLoggedIn ? 'true' : 'false'; ?>"></nav>
<script>
    const unreviewedAppointments = <?php echo json_encode($unreviewedAppointments); ?>;
</script>
<main>
    <br>
    <h1>Appointment Details</h1>
    
    <?php if ($appointmentData): ?>
    <div class="appointment-details">
        <h2>Details for Appointment #<?php echo $appointmentData['APPOINTMENT_ID']; ?></h2>
        <p><strong>Dentist:</strong> <?php echo $appointmentData['EMPLOYEE_FIRSTNAME'] . ' ' . $appointmentData['EMPLOYEE_LASTNAME']; ?></p>
        <p><strong>Patient:</strong> <?php echo $appointmentData['PATIENT_FIRSTNAME'] . ' ' . $appointmentData['PATIENT_LASTNAME']; ?></p>
        <p><strong>Date & Time:</strong> <?php echo date('Y-m-d H:i', strtotime($appointmentData['APPOINTMENT_DATETIME'])); ?></p>
        <p><strong>Status:</strong> <?php echo $appointmentData['APPOINTMENT_STATUS']; ?></p>
        <p><strong>Patient Comment:</strong> <span class="comment patient-comment"><?php echo $appointmentData['APPOINTMENT_PATIENT_COMMENT']; ?></span></p>
        <p><strong>Dentist Comment:</strong> <span class="comment dentist-comment"><?php echo $appointmentData['APPOINTMENT_EMPLOYEE_COMMENT']; ?></span></p>
        <a href="history_appointments.php" class="return">Return to appointments</a><br>
    </div>

    <?php else: ?>
        <p>No appointment found with the provided ID.</p>
    <?php endif; ?>
</main>

<footer id="footer" class="footer"></footer>
</body>

</html>
