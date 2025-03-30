<?php
include 'activity-functions.php';

$db = new DB();
$activity = new activity();

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $beschrijving = $_POST['beschrijving'];
    $datum = $_POST['datum'];
    $activity->voegActiviteitToe($db, $naam, $beschrijving, $datum);
    $message = "Activiteit succesvol toegevoegd!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activiteit Toevoegen</title>
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
                    <li class="nav-item"><a class="nav-link active" href="activity-toevoegen.php">Toevoegen</a></li>
                    <li class="nav-item"><a class="nav-link" href="activity-wijzigen.php">Wijzigen</a></li>
                    <li class="nav-item"><a class="nav-link" href="activity-verwijderen.php">Verwijderen</a></li>
                    <li class="nav-item"><a class="nav-link" href="activity-overzicht.php">Overzicht</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Activiteit Toevoegen</h1>

        <?php if (!empty($message)): ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="bg-light p-4 rounded shadow-sm">
            <div class="mb-3">
                <label for="naam" class="form-label">Naam:</label>
                <input type="text" class="form-control" id="naam" name="naam" required>
            </div>
            <div class="mb-3">
                <label for="beschrijving" class="form-label">Beschrijving:</label>
                <textarea class="form-control" id="beschrijving" name="beschrijving" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="datum" class="form-label">Datum:</label>
                <input type="date" class="form-control" id="datum" name="datum" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Toevoegen</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
