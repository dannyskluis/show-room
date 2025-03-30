<?php
include "ActiviteitenBeheer.php";

$activiteitenBeheer = new ActiviteitenBeheer();
$activiteiten = $activiteitenBeheer->getAllActiviteiten();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Alle Activiteiten</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Alle Activiteiten</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naam</th>
                    <th>Beschrijving</th>
                    <th>Datum</th>
                    <th>Locatie</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activiteiten as $activiteit) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($activiteit['id']); ?></td>
                        <td><?php echo htmlspecialchars($activiteit['naam']); ?></td>
                        <td><?php echo htmlspecialchars($activiteit['beschrijving']); ?></td>
                        <td><?php echo htmlspecialchars($activiteit['datum']); ?></td>
                        <td><?php echo htmlspecialchars($activiteit['locatie']); ?></td>
                        <td>
                            <a href="edit-activity.php?id=<?php echo $activiteit['id']; ?>" class="btn btn-primary">Bewerken</a>
                            <a href="delete-activity.php?id=<?php echo $activiteit['id']; ?>" class="btn btn-danger">Verwijderen</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="add-activity.php" class="btn btn-primary mb-3">Activiteit Toevoegen</a>
    </div>
</body>
</html>
