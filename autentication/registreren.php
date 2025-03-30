<?php
include "../Database/Authentication.php";

if (isset($_POST['knopje'])) {
    $PATIENT_FIRSTNAME = $_POST['PATIENT_FIRSTNAME'];
    $PATIENT_LASTNAME = $_POST['PATIENT_LASTNAME'];
    $PATIENT_EMAIL = $_POST['PATIENT_EMAIL'];
    $PATIENT_PHONENUMBER = $_POST['PATIENT_PHONENUMBER'];
    $PATIENT_BIRTHDATE = $_POST['PATIENT_BIRTHDATE'];
    $PATIENT_PASSWORD = $_POST['PATIENT_PASSWORD'];
    $hashed_password = password_hash($PATIENT_PASSWORD, PASSWORD_DEFAULT);

    $result = $Authentication->patientRegister($PATIENT_FIRSTNAME, $PATIENT_LASTNAME, $PATIENT_EMAIL, $PATIENT_PHONENUMBER, $PATIENT_BIRTHDATE, $hashed_password);
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../Style/register.css">
</head>

<body>
    <main>
        <form action="" method="post">
            <h2>Register - Patient</h2>
            <label for="PATIENT_FIRSTNAME">Firstname</label>
            <input type="text" name="PATIENT_FIRSTNAME" value="" required>

            <label for="PATIENT_LASTNAME">Lastname</label>
            <input type="text" name="PATIENT_LASTNAME" value="" required>

            <label for="PATIENT_EMAIL">Email</label>
            <input type="email" name="PATIENT_EMAIL" value="" required>

            <label for="PATIENT_PHONENUMBER">Phonenumber</label>
            <input type="tel" name="PATIENT_PHONENUMBER" value="" required>

            <label for="PATIENT_BIRTHDATE">Date of Birth</label>
            <input type="date" name="PATIENT_BIRTHDATE" value="" max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" required>

            <label for="PATIENT_PASSWORD">Password</label>
            <input type="password" name="PATIENT_PASSWORD" value="" required>

            <input type="submit" name="knopje" value="Register">
        </form>
    </main>
    
</body>

</html>
