<?php
require_once("Database/session_manager.php");
require_once('Database/Authentication.php');
require_once('Database/Appointments.php');

$isLoggedIn = isset($_SESSION['PATIENT_ID']) || isset($_SESSION['EMPLOYEE_ID']);

$showLoginError = false;
if (isset($_SESSION['LOGIN_ERROR'])) {
    $showLoginError = true;
    unset($_SESSION['LOGIN_ERROR']);
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
    <title>About Us</title>
    <script src="Javascript/public_header.js" defer></script>
    <script src="Javascript/public_footer.js" defer></script>
    <script src="Javascript/add_appointment_error.js" defer></script>
    <link rel="stylesheet" href="Style/add_appointment_error.css">
    <link rel="stylesheet" href="Style/public_header.css">
    <link rel="stylesheet" href="Style/public_footer.css">
    <link rel="stylesheet" href="Style/aboutUs.css">
</head>
<body>
<div id="loginModal" class="modal" style="display: <?php echo $showLoginError ? 'block' : 'none'; ?>;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>You must log in first to access this page.</p>
    </div>
</div>
    <nav id="nav" class="nav" data-loggedin="<?php echo $isLoggedIn ? 'true' : 'false'; ?>"></nav>

<script>
    const unreviewedAppointments = <?php echo json_encode($unreviewedAppointments); ?>;
</script>

    <main>
        <div class="everything">
            <h1>About <b>Tiny Tooth Dental</b></h1>
            <p> Welcome to <b>Tiny Tooth Dental</b> where we share information related to Dentist practise. We're dedicated to providing you the very best information and knowledge of the above mentioned topics.</p>
            
            <p>We hope you found all of the information on <b>Tiny Tooth Dental</b> helpful, as we love to share them with you.</p>
            
            <p>If you require any more information or have any questions about our site, please feel free to contact us by email at <b>info@TinyToothDental.nl</b>.</p>
        </div>
    </main>

    <footer id="footer" class="footer"></footer>
</body>
</html>