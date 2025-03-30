<?php
require_once("../Database/session_manager.php");
require_once("../Database/Authentication.php");
require_once("../Database/Tandarts.php");

if (isset($_SESSION['EMPLOYEE_ID'])) {
    $dentistID = $_SESSION['EMPLOYEE_ID'];
} else {
    header("Location: ../Homepage.php");
    exit();
}

$totalPatients = count($Dentists->getAllPatients());
$appointmentsToday = count($Dentists->appointmentsToday($dentistID));
$pendingAppointments = count($Dentists->pendingAppointments($dentistID));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Javascript/dentist_platform_header.js" defer></script>
    <link rel="stylesheet" href="../Style/Tandarts/header.css">
    <link rel="stylesheet" href="../Style/Tandarts/home.css">
    <title>Home</title>
</head>
<body>
    <nav id="nav" class="nav"></nav>
    <main>
        <h1>Welcome to the Dashboard</h1>
        <section class="metrics">
            <div class="metric">Total Patients: <span id="totalPatients"><?php echo $totalPatients; ?></span></div>
            <div class="metric">Scheduled Appointments Today: <span id="appointmentsToday"><?php echo $appointmentsToday; ?></span></div>
            <div class="metric">Pending Appointments: <span id="pendingAppointments"><?php echo $pendingAppointments; ?></span></div>
        </section>
    </main>
</body>
</html>
