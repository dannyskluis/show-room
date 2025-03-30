<?php
include 'activity-functions.php';

$db = new DB();
$activity = new activity();

$activiteiten = $activity->haalActiviteitenMetDeelnemersOp($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activiteiten Overzicht</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Activiteiten</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="activity-toevoegen.php">Toevoegen</a></li>
                    <li class="nav-item"><a class="nav-link" href="activity-wijzigen.php">Wijzigen</a></li>
                    <li class="nav-item"><a class="nav-link" href="activity-verwijderen.php">Verwijderen</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="activity-overzicht.php">Overzicht</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Overzicht Activiteiten</h1>
        <div class="row">
            <?php foreach ($activiteiten as $activiteit): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($activiteit['activiteit_naam']) ?> (<?= htmlspecialchars($activiteit['datum']) ?>)</h5>
                            <p class="card-text"><?= htmlspecialchars($activiteit['beschrijving']) ?></p>
                            <h6>Deelnemers:</h6>
                            <?php if (!empty($activiteit['deelnemer_naam'])): ?>
                                <ul class="list-unstyled">
                                    <li><?= htmlspecialchars($activiteit['deelnemer_naam']) ?> (<?= htmlspecialchars($activiteit['deelnemer_email']) ?>)</li>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted">Geen deelnemers.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
