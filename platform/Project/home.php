<?php

require 'database/user.php';

if (!$user->isLoggedIn()) {
    header("Location: login.php");
    exit();
}
$zzprInfo = $user->onezzpr($_SESSION['zzpr_id']);

// Fetch projects in progress within the next 30 days
$currentDate = date('Y-m-d');
$endDateLimit = date('Y-m-d', strtotime($currentDate . '+30 days'));

$projectsInProgress = $user->getProjectsInProgress($currentDate, $endDateLimit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="style/universal.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <script src="JavaScript/header.js" defer></script>
    <script src="JavaScript/footer.js" defer></script>
</head>
<body>
    <header id="navbar"></header>

    <main>
        <h1>Welcome <?php echo $zzprInfo['firstname'] . " " . $zzprInfo['lastname']; ?>!</h1>
        <a href="projects.php">Projects</a>

        <div class="progresstable">
            <table border="1">
                <thead>
                    <tr>
                        <th>My Agenda</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projectsInProgress as $project): ?>
                        <tr>
                            <td class="progresstablediv">
                                <p class="enddate"><?php echo $project['end_date']; ?></p>
                                <?php
                                // Get client name based on client_id
                                $clientInfo = $user->oneclient($project['client_id']);
                                ?>

                                <p class="clientname"><?php echo $clientInfo['firstname'] . ' ' . $clientInfo['lastname']; ?></p>
                                <p class="projectname"><?php echo $project['project_name']; ?></p>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer id="footerbar"></footer>
</body>
</html>