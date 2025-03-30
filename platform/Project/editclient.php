<?php
require 'database/user.php';
$zzpId = $_SESSION['zzpr_id'];
$id = intval($_GET['id']);
$client = $user->oneclient($id);

if (isset($_POST['submit'])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $clients = $user->editClient($firstname, $lastname, $email, $phone_number, $id);
    header("location:clients.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style/tv_projecten.css">
    <link rel="stylesheet" href="style/universal.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">

    <script src="JavaScript/header.js" defer></script>
    <script src="JavaScript/footer.js" defer></script>
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label for="firstname">First name:</label><br>
        <input type="text" name="firstname" value="<?php echo $client['firstname']; ?>"><br><br>
        <label for="lastname">Last name:</label><br>
        <input type="text" name="lastname" value="<?php echo $client['lastname']; ?>"><br><br>
        <label for="email">email:</label><br>
        <input type="email" name="email" value="<?php echo $client['email']; ?>"><br><br>
        <label for="phone_number">phone_number:</label><br>
        <input type="number" name="phone_number" value="<?php echo $client['phone_number']; ?>"><br><br>
        <input type="submit" name="submit">
    </form>
</body>

</html>