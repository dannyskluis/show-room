<?php
require_once("../Database/session_manager.php");
require_once("../Database/Authentication.php");
require_once("../Database/Patients.php");

if (isset($_SESSION['EMPLOYEE_ID'])) {
    $dentistID = $_SESSION['EMPLOYEE_ID'];

    $patientsData = $Patients->allPatients();
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
    <link rel="stylesheet" href="../Style/Tandarts/patients.css">
    <title>Profile - Patient</title>
</head>
<body>
<nav id="nav" class="nav"></nav>

<main>
    <!-- Desktop View: Table List -->
    <div class="total-profile desktop-view">
        <h1>Patient Profiles</h1>
        <div class="profile">
            <?php if (!empty($patientsData)): ?>
                <table>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phonenumber</th>
                        <th>Birthdate</th>
                        <th>Action</th>
                    </tr>

                    <?php foreach ($patientsData as $patientData): ?>
                        <tr>
                            <td data-label="First Name"><?php echo $patientData['PATIENT_FIRSTNAME']; ?></td>
                            <td data-label="Last Name"><?php echo $patientData['PATIENT_LASTNAME']; ?></td>
                            <td data-label="Email"><?php echo $patientData['PATIENT_EMAIL']; ?></td>
                            <td data-label="Phonenumber"><?php echo $patientData['PATIENT_PHONENUMBER']; ?></td>
                            <td data-label="Birthdate"><?php echo $patientData['PATIENT_BIRTHDATE']; ?></td>
                            <td data-label="Action">
                                <a href="show_patients_insurance.php?Patient_ID=<?php echo $patientData['PATIENT_ID']; ?>">See Insurance details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No patients found.</p>
            <?php endif; ?>
        </div>
        <a href="dentists_platform_home.php"><p>Return to homepage</p></a>
    </div>

    <!-- Mobile View: Card List -->
    <div class="total-profile mobile-view">
        <h1>Patient Profiles</h1>
        <div class="profile">
            <?php if (!empty($patientsData)): ?>
                <?php foreach ($patientsData as $patientData): ?>
                    <div class="card">
                        <h2><?php echo $patientData['PATIENT_FIRSTNAME'] . ' ' . $patientData['PATIENT_LASTNAME']; ?></h2>
                        <p><strong>Email:</strong> <?php echo $patientData['PATIENT_EMAIL']; ?></p>
                        <p><strong>Phone:</strong> <?php echo $patientData['PATIENT_PHONENUMBER']; ?></p>
                        <p><strong>Birthdate:</strong> <?php echo $patientData['PATIENT_BIRTHDATE']; ?></p>
                        <a href="show_patients_insurance.php?Patient_ID=<?php echo $patientData['PATIENT_ID']; ?>">See Insurance details</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No patients found.</p>
            <?php endif; ?>
        </div>
        <a href="dentists_platform_home.php"><p>Return to homepage</p></a>
    </div>
</main>

</body>
</html>