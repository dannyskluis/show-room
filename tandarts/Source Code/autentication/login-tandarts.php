<?php
include '../Database/Authentication.php';

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
    $password = htmlspecialchars($_POST['wachtwoord']);

    if ($email === false) {
        $errorMessage = "Invalid email address";
    } else {
        try {
            $dentistExist = $Authentication->employeeLogin($email, $password);

            if ($dentistExist) {
                header("Location: ../tandarts_Platform/dentists_platform_home.php?logged_in");
                exit();
            } else {
                $errorMessage = "Incorrect email or password";
            }
        } catch (Exception $e) {
            $errorMessage = 'Error: ' . $e->getMessage();
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/loginDentist.css">
    <title>Login - Dentist</title>
</head>

<body>
    <h1>Login - Dentist</h1>
    <?php if ($errorMessage !== ''): ?>
            <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="wachtwoord" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">inloggen</button>
    </form>
</body>

</html>