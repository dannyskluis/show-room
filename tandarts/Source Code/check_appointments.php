<?php
require_once("database/session_manager.php");
require_once("Database/db.php");

$dbh = new DB();
$appointmentsTable = "appointments";

while (true) {
    $currentDateTime = new DateTime();

    // Select appointments that are not Done or Cancelled
    $query = "SELECT * FROM $appointmentsTable WHERE APPOINTMENT_STATUS NOT IN ('Done', 'Cancelled')";
    $appointments = $dbh->execute($query)->fetchAll();

    foreach ($appointments as $appointment) {
        $appointmentDateTime = new DateTime($appointment['APPOINTMENT_DATETIME']);
        
        $activeInterval = clone $appointmentDateTime;
        $activeInterval->add(new DateInterval('PT30M'));

        // Format current time for output
        $formattedCurrentTime = $currentDateTime->format('Y-m-d H:i:s');

        if ($currentDateTime >= $appointmentDateTime && $currentDateTime <= $activeInterval) {
            if ($appointment['APPOINTMENT_STATUS'] != 'Active') {
                $updateQuery = "UPDATE $appointmentsTable SET APPOINTMENT_STATUS = 'Active' WHERE APPOINTMENT_ID = ?";
                $dbh->execute($updateQuery, [$appointment['APPOINTMENT_ID']]);
                echo "[$formattedCurrentTime] Appointment ID {$appointment['APPOINTMENT_ID']} status updated to Active.\n";
            }
        } 
        elseif ($currentDateTime > $activeInterval) {
            if ($appointment['APPOINTMENT_STATUS'] != 'Done') {
                $updateQuery = "UPDATE $appointmentsTable SET APPOINTMENT_STATUS = 'Done' WHERE APPOINTMENT_ID = ?";
                $dbh->execute($updateQuery, [$appointment['APPOINTMENT_ID']]);
                echo "[$formattedCurrentTime] Appointment ID {$appointment['APPOINTMENT_ID']} status updated to Done.\n";
            }
        }
    }

    sleep(60);
}
