<?php
require_once("../Database/session_manager.php");
require_once("../Database/Authentication.php");
require_once("../Database/Tandarts.php");
require_once("../Database/Patients.php");
require_once('../Database/Appointments.php');

$isLoggedIn = isset($_SESSION['PATIENT_ID']);

if (isset($_SESSION['PATIENT_ID'])) {
    $patientID = $_SESSION['PATIENT_ID'];
    $patientData = $Patients->onePatient($patientID);
    $appointmentsData = $Patients->appointmentsOfPatient($patientID);
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
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <script src="../Javascript/patienten_platform_header.js" defer></script>
    <script src="../Javascript/patienten_platform_footer.js" defer></script>
    <link rel="stylesheet" href="../Style/public_header.css">
    <link rel="stylesheet" href="../Style/public_footer.css">
    <link rel="stylesheet" href="../Style/history_appointments.css">
</head>

<body>
<nav id="nav" class="nav" data-loggedin="<?php echo $isLoggedIn ? 'true' : 'false'; ?>"></nav>
<script>
    const unreviewedAppointments = <?php echo json_encode($unreviewedAppointments); ?>;
</script>
<main>
    <br>
    <h1>Appointments</h1>
    <table>
        <thead>
            <tr>
                <th>Appointment ID</th>
                <th>Dentist</th>
                <th>Patient</th>
                <th>Date & Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through and display each finished appointment
            foreach ($appointmentsData as $appointment) {
                echo "<tr>";
                echo "<td data-label='Appointment ID'>" . $appointment['APPOINTMENT_ID'] . "</td>";
                echo "<td data-label='Dentist'>" . $appointment['EMPLOYEE_FIRSTNAME'] . ' ' . $appointment['EMPLOYEE_LASTNAME'] . "</td>";
                echo "<td data-label='Patient'>" . $appointment['PATIENT_FIRSTNAME'] . ' ' . $appointment['PATIENT_LASTNAME'] . "</td>";
                echo "<td data-label='Date & Time'>" . date('Y-m-d H:i', strtotime($appointment['APPOINTMENT_DATETIME'])) . "</td>";
                echo "<td data-label='Status'>" . $appointment['APPOINTMENT_STATUS'] . "</td>";
                echo "<td>";
                if ($appointment['APPOINTMENT_STATUS'] !== 'Cancelled' && $appointment['APPOINTMENT_STATUS'] !== 'Active' && $appointment['APPOINTMENT_STATUS'] !== 'Done') {
                    echo "<a href='edit_afspraak.php?id=" . $appointment['APPOINTMENT_ID'] . "' class='btn btn-edit'>Edit</a> ";
                    echo "<a href='details_afspraak.php?id=" . $appointment['APPOINTMENT_ID'] . "' class='btn btn-detail'>Details</a> ";
                    echo "<a href='cancel_appointment.php?id=" . $appointment['APPOINTMENT_ID'] . "' class='btn btn-cancel' onclick='return confirm(\"Are you sure you want to cancel this appointment?\");'>Cancel</a>";
                } else {
                    echo "<a href='details_afspraak.php?id=" . $appointment['APPOINTMENT_ID'] . "' class='btn btn-detail'>Details</a> ";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</main>


    
<footer id="footer" class="footer"></footer>
</body>

</html>