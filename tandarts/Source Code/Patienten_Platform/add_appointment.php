<?php
session_start();
include '../Database/db.php'; // Ensure the DB class is included
require_once "../Emails sender/AppointmentConfirmationEmail.php";
require_once('../Database/Appointments.php');

$patientID = $_SESSION['PATIENT_ID'] ?? null;
$isLoggedIn = isset($_SESSION['PATIENT_ID']);

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_first_name = $_POST['employee_first_name'];
    $patient_id = $patientID; // Use session data directly
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $patient_comment = $_POST['patient_comment'];

    $appointment_status = 'Scheduled'; // Default status
    $appointment_datetime = $appointment_date . ' ' . $appointment_time;

    // Check if employee exists
    $employee = $myDb->execute("SELECT EMPLOYEE_ID FROM employees WHERE EMPLOYEE_FIRSTNAME = ?", [$employee_first_name])->fetch();
    if (!$employee) {
        die("Error: Employee does not exist.");
    }
    $employee_id = $employee['EMPLOYEE_ID'];

    // Check if the selected date and time are already booked for the same dentist
    $appointment_check = $myDb->execute("SELECT * FROM appointments WHERE APPOINTMENT_DATETIME = ? AND APPOINTMENT_EMPLOYEE_ID = ? AND APPOINTMENT_STATUS IN ('Scheduled', 'Confirmed')", [$appointment_datetime, $employee_id]);
    if ($appointment_check->rowCount() > 0) {
        die("Error: This appointment date and time is already taken for this dentist.");
    }

    // Insert the appointment
    $sql = "INSERT INTO appointments 
            (APPOINTMENT_EMPLOYEE_ID, APPOINTMENT_PATIENT_ID, APPOINTMENT_DATETIME, APPOINTMENT_PATIENT_COMMENT, APPOINTMENT_STATUS) 
            VALUES (?, ?, ?, ?, ?)";
    $myDb->execute($sql, [$employee_id, $patient_id, $appointment_datetime, $patient_comment, $appointment_status]);

    $appointment_id = $myDb->lastInsertId();
    echo "Appointment booked successfully!";
    sendAppointmentEmail($patientID, $appointment_id);
    header("Location: history_appointments.php?booking=successful");
    exit();
}

// Fetch existing appointments to disable booked times based on employee and date
$appointment_date = $_GET['appointment_date'] ?? null;
$selected_employee_firstname = $_GET['employee_first_name'] ?? null;
$booked_times = [];

if ($appointment_date && $selected_employee_firstname) {
    $employee = $myDb->execute("SELECT EMPLOYEE_ID FROM employees WHERE EMPLOYEE_FIRSTNAME = ?", [$selected_employee_firstname])->fetch();
    $employee_id = $employee['EMPLOYEE_ID'] ?? null;

    if ($employee_id) {
        $booked_times_query = $myDb->execute(
            "SELECT TIME(APPOINTMENT_DATETIME) as appointment_time 
                                              FROM appointments 
                                              WHERE DATE(APPOINTMENT_DATETIME) = ? 
                                              AND APPOINTMENT_EMPLOYEE_ID = ? 
                                              AND APPOINTMENT_STATUS IN ('Scheduled', 'Confirmed')",
            [$appointment_date, $employee_id]
        );
        $booked_times = $booked_times_query->fetchAll(PDO::FETCH_COLUMN);
    }
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
    <title>Book Appointment</title>
    <script src="../Javascript/patienten_platform_header.js" defer></script>
    <script src="../Javascript/patienten_platform_footer.js" defer></script>
    <link rel="stylesheet" href="../Style/public_header.css">
    <link rel="stylesheet" href="../Style/public_footer.css">
    <link rel="stylesheet" href="../Style/appointment.css">
</head>

<body>
        <script>
            window.onload = function() {
                var today = new Date();
                var tomorrow = new Date(today);
                tomorrow.setDate(today.getDate() + 1); // Set minimum date to tomorrow

                var tomorrowStr = tomorrow.toISOString().split('T')[0];
                document.getElementsByName("appointment_date")[0].setAttribute('min', tomorrowStr);

                // When the appointment date changes, check available times
                document.getElementsByName('appointment_date')[0].addEventListener('change', function() {
                    var selectedDate = this.value;
                    var selectedEmployee = document.getElementsByName('employee_first_name')[0].value;
                    if (selectedEmployee) {
                        window.location.href = '?appointment_date=' + selectedDate + '&employee_first_name=' + selectedEmployee;
                    }
                });

                // When the employee changes, reload to show available times
                document.getElementsByName('employee_first_name')[0].addEventListener('change', function() {
                    var selectedEmployee = this.value;
                    var selectedDate = document.getElementsByName('appointment_date')[0].value;
                    if (selectedDate) {
                        window.location.href = '?appointment_date=' + selectedDate + '&employee_first_name=' + selectedEmployee;
                    }
                });
            };
        </script>

        <nav id="nav" class="nav" data-loggedin="<?php echo $isLoggedIn ? 'true' : 'false'; ?>"></nav>
        <br>
        <script>
            const unreviewedAppointments = <?php echo json_encode($unreviewedAppointments); ?>;
        </script>

        <main>
            <h2>Book an Appointment</h2>
            <?php if (!$patientID): ?>
                <p style="color: red;" class="errorlogin">Note: You need to be logged in to book an appointment.</p>
            <?php endif; ?>

            <form method="post" action="">
                <label for="employee_first_name">Select Employee:</label>
                <select name="employee_first_name" required>
                    <?php
                    // Fetch employee first and last names from the database
                    $employees = $myDb->execute("SELECT * FROM employees WHERE EMPLOYEE_FUNCTION = 'Doctor'")->fetchAll();
                    foreach ($employees as $employee) {
                        $fullName = $employee['EMPLOYEE_FUNCTION'] . ' ' . $employee['EMPLOYEE_FIRSTNAME'] . ' ' . $employee['EMPLOYEE_LASTNAME'];
                        $selected = ($selected_employee_firstname == $employee['EMPLOYEE_FIRSTNAME']) ? 'selected' : '';
                        echo "<option value='" . $employee['EMPLOYEE_FIRSTNAME'] . "' $selected>" . $fullName . "</option>";
                    }
                    ?>
                </select><br><br>

                <label for="appointment_date">Appointment Date:</label>
                <input type="date" name="appointment_date" value="<?php echo isset($appointment_date) ? $appointment_date : ''; ?>" required><br><br>

                <label for="appointment_time">Appointment Time:</label>
                <select name="appointment_time" required>
                    <?php
                    // Available time slots
                    $time_slots = [
                        "08:00:00" => "08:00 AM",
                        "08:30:00" => "08:30 AM",
                        "09:00:00" => "09:00 AM",
                        "09:30:00" => "09:30 AM",
                        "10:00:00" => "10:00 AM",
                        "10:30:00" => "10:30 AM",
                        "11:00:00" => "11:00 AM",
                        "11:30:00" => "11:30 AM",
                        "12:00:00" => "12:00 PM",
                        "12:30:00" => "12:30 PM",
                        "13:00:00" => "01:00 PM",
                        "13:30:00" => "01:30 PM",
                        "14:00:00" => "02:00 PM",
                        "14:30:00" => "02:30 PM",
                        "15:00:00" => "03:00 PM",
                        "15:30:00" => "03:30 PM",
                        "16:00:00" => "04:00 PM",
                        "16:30:00" => "04:30 PM"
                    ];

                    // Disable already booked times for the selected dentist
                    foreach ($time_slots as $time_value => $time_display) {
                        $disabled = in_array($time_value, $booked_times) ? 'disabled' : '';
                        echo "<option value='$time_value' $disabled>$time_display</option>";
                    }
                    ?>
                </select><br><br>

                <label for="patient_comment">Patient Comment:</label>
                <textarea name="patient_comment"></textarea><br><br>

                <button type="submit" <?php echo !$patientID ? 'disabled' : ''; ?>>Book Appointment</button>
            </form>
        </main>
    <footer id="footer" class="footer"></footer>
</body>

</html>

