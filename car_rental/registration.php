<?php

@include 'database.php';

if (isset($_POST['submit'])) {

    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $adres = mysqli_real_escape_string($conn, $_POST['adres']);
    $driverLicenseNumber = mysqli_real_escape_string($conn, $_POST['driverLicenseNumber']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $confirmPassword = md5($_POST['confirmPassword']);
    $user_type = $_POST['user_type'];

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {

        $error[] = 'user already exist!';

    } else {

        if ($pass != $confirmPassword) {
            $error[] = 'password not matched!';
        } else {
            $insert = "INSERT INTO user_form(fullName, adres, driverLicenseNumber, phoneNumber, email, password, user_type) VALUES('$fullName','$adres','$driverLicenseNumber','$phoneNumber','$email','$pass','$user_type')";
            mysqli_query($conn, $insert);
            header('location:index.php');
        }
    }

}
;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha385-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi">
    <link rel="stylesheet" href="registration.css">
</head>

<body>
    <div class="container">
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullName" placeholder="fullName">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="adres" placeholder="adres">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="driverLicenseNumber" placeholder="driverLicenseNumber">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="phoneNumber" placeholder="phoneNumber">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirmPassword" placeholder="confirmPassword">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" name="submit" value="register">
            </div>
        </form>
    </div>
</body>

</html>