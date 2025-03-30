<?php
require_once("../Database/session_manager.php");
require_once("../Database/Authentication.php");
require_once("../Database/Appointments.php");
require_once("../Database/Patients.php");
require_once("../Database/Tandarts.php");

if (isset($_SESSION['EMPLOYEE_ID'])) {
    $dentistID = $_SESSION['EMPLOYEE_ID'];

    if (!isset($_GET['Appointment_ID'])) {
        echo "Appointment ID not provided.";
        exit();
    }
    
    $appointment_ID = intval($_GET['Appointment_ID']);
    $patientAppointmentData = $appointment->oneAppointment($appointment_ID);
    $patient_ID = $patientAppointmentData['APPOINTMENT_PATIENT_ID'];
    $patientData = $Patients->onePatient($patient_ID);
    $appointmentData = $appointment->oneAppointment($appointment_ID);

if (isset($_POST['save_comment'])) {
    $dentistComment = htmlspecialchars($_POST['dentist_comment']);
    
    if ($appointmentData['APPOINTMENT_STATUS'] === 'Cancelled') {
        echo "You cannot add or edit a comment for a cancelled appointment.";
        exit();
    }

    $Dentists->updateDentistComment($appointment_ID, $dentistComment);

    header("Location: show_appointment.php?Appointment_ID=$appointment_ID");
    exit();
}


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
    <link rel="stylesheet" href="../Style/Tandarts/appointment_details.css">
    <title>Profile - Appointment</title>
</head>
<body>
<nav id="nav" class="nav"></nav>

<main>
    <div class="total-appointment">
        <div class="appointment">
            <h3>Patient Details:</h3>
            <p>Name: <?php echo $patientData['PATIENT_FIRSTNAME'] . ' ' . $patientData['PATIENT_LASTNAME']; ?></p>
            <p>Email: <?php echo $patientData['PATIENT_EMAIL']; ?></p>
            <p>Phone Number: <?php echo $patientData['PATIENT_PHONENUMBER']; ?></p>

            <div class="appointment-details">
                <h3>Appointment Details:</h3>
                <p>Appointment Time: 
                    <?php echo date('Y-m-d H:i', strtotime($appointmentData['APPOINTMENT_DATETIME'])); ?>
                </p>
                <p>Patient Note: 
                    <?php echo !empty($appointmentData['APPOINTMENT_PATIENT_COMMENT']) ? htmlspecialchars($appointmentData['APPOINTMENT_PATIENT_COMMENT']) : 'Not provided'; ?>
                </p>
                <p>Dentist Note: 
                    <?php echo !empty($appointmentData['APPOINTMENT_EMPLOYEE_COMMENT']) ? htmlspecialchars($appointmentData['APPOINTMENT_EMPLOYEE_COMMENT']) : 'Not provided'; ?>
                </p>
                <p>Appointment Status: 
                    <?php echo $appointmentData['APPOINTMENT_STATUS']; ?>
                </p>
            </div>
                <?php if ($appointmentData['APPOINTMENT_STATUS'] !== 'Cancelled') : ?>
                    <h3>Add/Edit Dentist Comment:</h3>
                    <form method="POST" action="show_appointment.php?Appointment_ID=<?php echo $appointment_ID; ?>">
                        <textarea name="dentist_comment" rows="4" cols="50"><?php echo htmlspecialchars($appointmentData['APPOINTMENT_EMPLOYEE_COMMENT']); ?></textarea><br>
                        <button type="submit" name="save_comment">Save Comment</button>
                    </form>
                <?php else : ?>
                    <br>
                    <p class="noComment">The appointment has been cancelled. You cannot add or edit comments.</p>
                <?php endif; ?>
        </div>
        <a href="appointments.php">Return to appointments</a>
    </div>
</main>
    <!-- hier footer -->
</body>
</html>