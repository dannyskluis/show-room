<?php
require 'database/user.php';
$zzpId = $_SESSION['zzpr_id'];
$clients = $user->getClientsForLoggedInZZP($zzpId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Overview</title>
    <link rel="stylesheet" href="style/universal.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/tables.css">
    <script src="JavaScript/header.js" defer></script>
    <script src="JavaScript/footer.js" defer></script>
    <script src="JavaScript/clients.js" defer></script>
</head>
<body>
    <header id="navbar"></header>

    <main>
        <section id="client-section">
            <h1>Client Overview</h1>
            <div id="client-list">
                <?php if (!empty($clients)) : ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phonenumber</th>
                    </tr>
                    <?php foreach ($clients as $client) : ?>
                        <tr>
                            <td><?php echo $client['client_id']; ?></td>
                            <td><?php echo $client['firstname'] . ' ' . $client['lastname']; ?></td>
                            <td><?php echo $client['email']; ?></td>
                            <td><?php echo $client['phone_number']; ?></td>
                            <td><a href="editclient.php?id=<?php echo $client['client_id']; ?>">Edit</a></td>
                            <td><a href="delete_client.php?id=<?php echo $client['client_id']; ?>">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <?php else : ?>
                    <p>No clients found.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
    
    <footer id="footerbar"></footer>
</body>
</html>
