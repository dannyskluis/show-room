<?php

include "../../Database/Authentication.php";

if (isset($_POST['knopje'])) {
    $PATIENT_FIRSTNAME = $_POST['PATIENT_FIRSTNAME'];
    $PATIENT_LASTNAME = $_POST['PATIENT_LASTNAME'];
    $PATIENT_EMAIL = $_POST['PATIENT_EMAIL'];
    $PATIENT_PHONENUMBER = $_POST['PATIENT_PHONENUMBER'];
    $PATIENT_BIRTHDATE = $_POST['PATIENT_BIRTHDATE'];
    $PATIENT_PASSWORD = $_POST['PATIENT_PASSWORD'];
    $hashed_password = password_hash($PATIENT_PASSWORD, PASSWORD_DEFAULT);

    $result = $Authentication->patientRegister($PATIENT_FIRSTNAME, $PATIENT_LASTNAME, $PATIENT_EMAIL, $PATIENT_PHONENUMBER, $PATIENT_BIRTHDATE, $hashed_password);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <label for="PATIENT_FIRSTNAME">PATIENT_FIRSTNAME</label><br>
        <input type="text" name="PATIENT_FIRSTNAME" valeu="PATIENT_FIRSTNAME">

        <br>

        <label for="PATIENT_LASTNAME">PATIENT_LASTNAME</label><br>
        <input type="text" name="PATIENT_LASTNAME" valeu="PATIENT_LASTNAME">

        <br>

        <label for="PATIENT_EMAIL">PATIENT_EMAIL</label><br>
        <input type="email" name="PATIENT_EMAIL" id="PATIENT_EMAIL" valeu="PATIENT_EMAIL">


        <br>

        <label for="PATIENT_PHONENUMBER">PATIENT_PHONENUMBER</label><br>
        <input type="phone" name="PATIENT_PHONENUMBER" valeu="PATIENT_PHONENUMBER">

        <br>

        <label for="PATIENT_BIRTHDATE">PATIENT_BIRTHDATE</label><br>
        <input type="date" name="PATIENT_BIRTHDATE" valeu="PATIENT_BIRTHDATE">

        <br>

        <label for="PATIENT_PASSWORD">PATIENT_PASSWORD</label><br>
        <input type="text" name="PATIENT_PASSWORD" valeu="PATIENT_PASSWORD">



        <input type="submit" name="knopje">
    </form>


</body>

</html>