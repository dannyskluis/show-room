<?php
require_once("../Database/session_manager.php");
require_once("../Database/Authentication.php");
require_once("../Database/Appointments.php");
require_once "../Emails sender/AppointmentCancellationEmail.php";

$isLoggedIn = isset($_SESSION['PATIENT_ID']);
$patientID = $_SESSION['PATIENT_ID'] ?? null;
if (!$isLoggedIn) {
    header("Location: ../Homepage.php?error=login");
    exit();
}

$appointmentID = $_GET['id'] ?? null;

if ($appointmentID) {
    $myDB = new DB();
    $appointment = new Appointments($myDB);

    $appointmentData = $appointment->oneAppointment($appointmentID);

    if ($appointmentData) {
        $query = "UPDATE " . $appointment->appointmentsTable . " SET APPOINTMENT_STATUS = 'Cancelled' WHERE APPOINTMENT_ID = ?";
        $myDB->execute($query, [$appointmentID]);
        
        $_SESSION['CANCEL_SUCCESS'] = "Appointment canceled successfully.";
        sendAppointmentCancelEmail($patientID, $appointmentID);
        header("Location: history_appointments.php?booking=succesfull");
        exit();
    } else {
        $_SESSION['CANCEL_ERROR'] = "Appointment not found.";
    }
} else {
    $_SESSION['CANCEL_ERROR'] = "No appointment ID specified.";
}

header("Location: history_appointments.php");
exit();
?>
