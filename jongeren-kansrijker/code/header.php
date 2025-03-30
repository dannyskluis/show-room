<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Dental Practice'; ?></title>
    <link rel="stylesheet" href="styles/header-footer.css"> <!-- Link your CSS file -->
</head>

<body>
    <header>
        <div class="container">
            <!-- Logo Section -->
            <a href="homepage.php">
                <img src="images/logo2.png" alt="Logo" class="logo">
            </a>

            <!-- Navigation Section -->
            <h1>Jongeren Kansrijker</h1>
            <nav>
                <div class="hamburger" onclick="toggleMenu()">
                    &#9776; <!-- Hamburger icon -->
                </div>
                <ul id="menu">
                    <?php if ($isLoggedIn): ?>
                        <li><a href="homepage.php">home</a></li>
                        <li><a href="activity/activity-overzicht.php">activiteiten</a></li>
                        <li><a href="co-workers/co-workers.php">werknemers</a></li>
                        <li><a href="instituut/institutions.php">instituiten</a></li>
                        <li><a href="jongeren/youth.php">jongeren</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.querySelector('.hamburger');
            const menu = document.getElementById('menu');

            hamburger.addEventListener('click', function() {
                menu.classList.toggle('active');
            });
        });
    </script>