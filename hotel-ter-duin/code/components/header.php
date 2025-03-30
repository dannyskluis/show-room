<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Ter Duin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<?php
define('BASE_URL', 'http://localhost/drempeltoets-danny-meijer/hotel-ter-duin/code'); // Pas dit aan naar jouw domeinnaam of rootmap
?>

<body>
    <header>
        <div class="container">
            <a href="../index.php" class="logo">
                <img src="assets/images/logo.png" alt="Hotel Ter Duin" onerror="this.src='../assets/images/logo.png'">
            </a>
            <nav>
                <a href="<?= BASE_URL ?>/index.php">Home</a>
                <a href="<?= BASE_URL ?>/public/contact.php">Contact</a>

                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="<?= BASE_URL ?>/auth/registreren.php">Registreren</a>
                    <a href="<?= BASE_URL ?>/auth/login.php">Inloggen</a>
                <?php else: ?>
                    <?php if ($_SESSION['role'] === 'klant'): ?>
                        <a href="<?= BASE_URL ?>/klant/reservering.php">Reserveren</a>
                        <a href="<?= BASE_URL ?>/klant/overzicht.php">Overzicht</a>
                    <?php elseif ($_SESSION['role'] === 'admin'): ?>
                        <a href="<?= BASE_URL ?>/medewerker/reservering_overzicht.php">Reservering Overzicht</a>
                    <?php endif; ?>
                    <a href="<?= BASE_URL ?>/auth/logout.php">Uitloggen</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>