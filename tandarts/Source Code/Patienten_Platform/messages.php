<?php
require_once("../Database/session_manager.php");
require_once("../Database/Authentication.php");
require_once("../Database/Tandarts.php");
require_once("../Database/Patients.php");
require_once('../Database/Appointments.php');

$isLoggedIn = isset($_SESSION['PATIENT_ID']);

if (isset($_SESSION['PATIENT_ID'])) {
    $patientID = $_SESSION['PATIENT_ID'];

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $patientID && isset($_POST['patient_comment'])) {
    $patientComment = trim($_POST['patient_comment']);

    $myDb->execute("
        INSERT INTO messages (MESSAGE_PATIENT_ID, MESSAGE_CONTENT, MESSAGE_SENDER, MESSAGE_TIMESTAMP)
        VALUES (?, ?, 'patient', NOW())
    ", [$patientID, $patientComment]);

    header("Location: messages.php");
    exit();
}

$messages = $myDb->execute("
    SELECT m.MESSAGE_PATIENT_ID, m.MESSAGE_EMPLOYEE_ID, m.MESSAGE_CONTENT, m.MESSAGE_SENDER, m.MESSAGE_TIMESTAMP,
           e.EMPLOYEE_FIRSTNAME, e.EMPLOYEE_LASTNAME
    FROM messages m
    LEFT JOIN employees e ON m.MESSAGE_EMPLOYEE_ID = e.EMPLOYEE_ID
    WHERE (MESSAGE_PATIENT_ID = ?)
    ORDER BY MESSAGE_TIMESTAMP ASC
", [$patientID])->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Javascript/patienten_platform_header.js" defer></script>
    <script src="../Javascript/patienten_platform_footer.js" defer></script>
    <link rel="stylesheet" href="../Style/public_header.css">
    <link rel="stylesheet" href="../Style/public_footer.css">
    <link rel="stylesheet" href="../Style/messages.css">
    <title>Messages</title>
</head>
<body>
<nav id="nav" class="nav" data-loggedin="<?php echo $isLoggedIn ? 'true' : 'false'; ?>"></nav>
<script>
    const unreviewedAppointments = <?php echo json_encode($unreviewedAppointments); ?>;
</script>
    <main>
        <div class="message-container">
            <?php
            if (!empty($messages)) {
                foreach ($messages as $message) {
                    $isPatientMessage = $message['MESSAGE_SENDER'] === 'patient';
                    $messageClass = $isPatientMessage ? 'left' : 'right';
                    $senderType = $isPatientMessage ? 'You' : (htmlentities($message['EMPLOYEE_FIRSTNAME']) . ' ' . htmlentities($message['EMPLOYEE_LASTNAME']));
                    
                    echo "<div class='message $messageClass'>";
                    echo "<strong>$senderType:</strong><br>";
                    echo htmlentities($message['MESSAGE_CONTENT']) . "<br>";
                    echo "<span class='message-time'>" . date('Y-m-d H:i:s', strtotime($message['MESSAGE_TIMESTAMP'])) . "</span>";
                    echo "</div>";
                }
            } else {
                echo "<p>No messages found.</p>";
            }
            ?>
        </div>

        <form method="post">
            <label for="patient_comment">Your Message:</label>
            <textarea name="patient_comment" required></textarea><br><br>

            <button type="submit" <?php echo !$isLoggedIn ? 'disabled' : ''; ?>>Send Message</button>
        </form>
    </main>
    <footer id="footer" class="footer"></footer>
</body>

</html>
