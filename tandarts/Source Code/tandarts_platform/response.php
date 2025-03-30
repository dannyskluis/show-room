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

$patients = $myDb->execute("
    SELECT DISTINCT p.PATIENT_ID, p.PATIENT_FIRSTNAME, p.PATIENT_LASTNAME
    FROM messages m
    JOIN patients p ON m.MESSAGE_PATIENT_ID = p.PATIENT_ID
")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dentistComment = trim($_POST['dentist_comment']);
    $patientID = $_POST['patient_id'];

    error_log("Submitting message: Dentist ID = $dentistID, Patient ID = $patientID, Message = $dentistComment");

    if (!empty($dentistComment) && filter_var($patientID, FILTER_VALIDATE_INT) && $dentistID) {
        try {
            $result = $Dentists->sendMessage($patientID, $dentistID, $dentistComment);
            
            if ($result) {
                header("Location: response.php?patient_id=$patientID");
                exit();
            } else {
                echo "<p>Error: Unable to insert the message.</p>";
            }
        } catch (Exception $e) {
            echo "<p>Error sending message: " . htmlentities($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p>Error: Invalid patient ID or empty message. Dentist ID is " . htmlentities($dentistID) . "</p>";
    }
}



$patientID = $_GET['patient_id'] ?? null;

if ($patientID) {
    $messages = $myDb->execute("
    SELECT m.*, e.EMPLOYEE_FIRSTNAME, e.EMPLOYEE_LASTNAME
    FROM messages m
    LEFT JOIN employees e ON m.MESSAGE_EMPLOYEE_ID = e.EMPLOYEE_ID
    WHERE m.MESSAGE_PATIENT_ID = ?
    ORDER BY m.MESSAGE_TIMESTAMP ASC
", [$patientID])->fetchAll();

} else {
    $messages = [];
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Javascript/dentist_platform_header.js" defer></script>
    <link rel="stylesheet" href="../Style/Tandarts/header.css">
    <link rel="stylesheet" href="../Style/Tandarts/response.css">
    <title>Respond to Patient</title>
</head>
<body>
<nav id="nav" class="nav"></nav>
    <main>
        <div class="sidebar">
            <h3>Patients</h3>
            <?php
            if (!empty($patients)) {
                foreach ($patients as $patient) {
                    echo "<a href='response.php?patient_id=" . htmlentities($patient['PATIENT_ID']) . "'>";
                    echo htmlentities($patient['PATIENT_FIRSTNAME']) . " " . htmlentities($patient['PATIENT_LASTNAME']);
                    echo "</a>";
                }
            } else {
                echo "<p>No patients found.</p>";
            }
            ?>
        </div>

        <div class="message-container">
            <?php
            if (!empty($messages)) {
                foreach ($messages as $message) {
                    $isPatientMessage = $message['MESSAGE_SENDER'] == 'patient';
                    $isDentistMessage = $message['MESSAGE_SENDER'] == 'employee';
                    $messageClass = $isPatientMessage ? 'left' : ($isDentistMessage ? 'right' : 'coworker');
                    $senderType = $isPatientMessage ? 'Patient' : htmlentities($message['EMPLOYEE_FIRSTNAME'] . ' ' . $message['EMPLOYEE_LASTNAME']);
                    echo "<div class='message $messageClass'>";
                    echo "<strong>$senderType</strong><br>";
                    echo htmlentities($message['MESSAGE_CONTENT']) . "<br>";
                    echo "<span class='message-time'>" . date('Y-m-d H:i:s', strtotime($message['MESSAGE_TIMESTAMP'])) . "</span>";
                    echo "</div>";
                }
            } else {
                echo "<p>No messages found.</p>";
            }
            ?>
        </div>

        <?php if ($patientID): ?>
        <form method="post" action="">
            <input type="hidden" name="patient_id" value="<?php echo htmlentities($patientID); ?>">
            <label for="dentist_comment">Your Response:</label>
            <textarea name="dentist_comment" rows="4" required></textarea>
            <button type="submit">Send Response</button>
        </form>
        <?php endif; ?>
    </main>
</body>
</html>
