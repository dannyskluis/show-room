<?php
require_once("../Database/session_manager.php");
require_once("../Database/Authentication.php");
require_once("../Database/Tandarts.php");
require_once("../Database/Patients.php");

if (isset($_SESSION['EMPLOYEE_ID'])) {
    $dentistID = $_SESSION['EMPLOYEE_ID'];

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
    <link rel="stylesheet" href="../Style/Tandarts/appointments.css">
    <title>Dentist - Appointments</title>
</head>
<body>
    <nav id="nav" class="nav"></nav>

    <main>
        <div class="total-profile">
            <div class="profile">
                <?php if (!empty($appointmentsData)): ?>
                    <table border="1">
                        <tr>
                            <th>Patient name</th>
                            <th>Date and time</th>
                            <th>Patient comment</th>
                            <th>Dentist comment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($appointmentsData as $appoinmentData): ?>
                            <tr>
                                <td><?php echo $appoinmentData['PATIENT_FIRSTNAME'] . ' ' . $appoinmentData['PATIENT_LASTNAME']; ?></td>
                                <td><?php echo $appoinmentData['APPOINTMENT_DATETIME']; ?></td>
                                <td><?= !empty($appoinmentData['APPOINTMENT_PATIENT_COMMENT']) ? $appoinmentData['APPOINTMENT_PATIENT_COMMENT'] : 'No comment'; ?></td>
                                <td><?= !empty($appoinmentData['APPOINTMENT_EMPLOYEE_COMMENT']) ? $appoinmentData['APPOINTMENT_EMPLOYEE_COMMENT'] : 'No comment'; ?></td>
                                <td><?php echo $appoinmentData['APPOINTMENT_STATUS']; ?></td>
                                <td>
                                    <?php
                                        $url = "show_appointment.php?Appointment_ID=" . $appoinmentData['APPOINTMENT_ID'];
                                        echo "<a href='$url'>See Appointment details</a>";
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <p>No appointments found.</p>
                <?php endif; ?>
                
                <!-- Mobile Card View -->
                <?php foreach ($appointmentsData as $appoinmentData): ?>
                    <div class="appointment-card">
                        <h3>Patient: <?php echo $appoinmentData['PATIENT_FIRSTNAME'] . ' ' . $appoinmentData['PATIENT_LASTNAME']; ?></h3>
                        <p><strong>Date and Time:</strong> <?php echo $appoinmentData['APPOINTMENT_DATETIME']; ?></p>
                        <p><strong>Patient Comment:</strong> <?= !empty($appoinmentData['APPOINTMENT_PATIENT_COMMENT']) ? $appoinmentData['APPOINTMENT_PATIENT_COMMENT'] : 'No comment'; ?></p>
                        <p><strong>Dentist Comment:</strong> <?= !empty($appoinmentData['APPOINTMENT_EMPLOYEE_COMMENT']) ? $appoinmentData['APPOINTMENT_EMPLOYEE_COMMENT'] : 'No comment'; ?></p>
                        <p><strong>Status:</strong> <?php echo $appoinmentData['APPOINTMENT_STATUS']; ?></p>
                        <a href="show_appointment.php?Appointment_ID=<?php echo $appoinmentData['APPOINTMENT_ID']; ?>">See Appointment details</a>
                    </div>
                <?php endforeach; ?>
            </div>
            <a href="dentists_platform_home.php" class="return"><p>Return to homepage</p></a>
        </div>
    </main>
</body>
</html>