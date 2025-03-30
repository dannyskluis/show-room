<?php
session_start();
require_once 'connection.php';

// Use the $myDb instance to fetch data
$query = "SELECT * FROM institutions ORDER BY created_at DESC";
$institutions = $myDb->fetchAll($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituten Overzicht</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            text-align: center;
        }

        a:hover {
            background-color: #45a049;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background-color: #f9f9f9;
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .buttons {
            display: flex;
            gap: 10px;
        }

        .delete-btn, .edit-btn, .back-btn {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-btn {
            background-color: #f44336;
        }

        .delete-btn:hover, .edit-btn:hover, .back-btn:hover {
            background-color: #555;
        }

        .delete-btn {
            background-color: #f44336;
        }

        .back-btn {
            background-color: #2196F3;
            text-align: center;
        }

        .back-btn:hover {
            background-color: #1976D2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Instituten Overzicht</h1>
        <a href="./add-institution.php">Nieuw Instituut Toevoegen</a>
        <a href="./../homepage.php" class="back-btn">Terug naar Homepage</a>
        <ul id="institutions-list">
            <?php foreach ($institutions as $institution): ?>
                <li id="institution-<?= htmlspecialchars($institution['id']) ?>">
                    <div>
                        <strong><?= htmlspecialchars($institution['name']) ?></strong>
                        <p><?= htmlspecialchars($institution['address']) ?></p>
                        <p><?= htmlspecialchars($institution['description']) ?></p>
                    </div>
                    <div class="buttons">
                        <a href="edit-institution.php?id=<?= htmlspecialchars($institution['id']) ?>" class="edit-btn">Bewerken</a>
                        <button class="delete-btn" data-id="<?= htmlspecialchars($institution['id']) ?>">Verwijderen</button>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script>
        $(document).ready(function () {
            $('.delete-btn').click(function () {
                const institutionId = $(this).data('id');
                const listItem = $(`#institution-${institutionId}`);

                if (confirm('Weet je zeker dat je dit instituut wilt verwijderen?')) {
                    $.ajax({
                        url: 'delete-institution.php',
                        type: 'POST',
                        data: { id: institutionId },
                        success: function (response) {
                            try {
                                const result = JSON.parse(response);
                                if (result.success) {
                                    listItem.remove();
                                } else {
                                    alert('Fout bij het verwijderen van het instituut: ' + result.error);
                                }
                            } catch (e) {
                                alert('Ongeldig antwoord van de server.');
                            }
                        },
                        error: function () {
                            alert('Er is een probleem opgetreden. Probeer het opnieuw.');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
