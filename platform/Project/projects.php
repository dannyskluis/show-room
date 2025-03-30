<?php
require 'database/user.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style/universal.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/tables.css">
    <script src="JavaScript/header.js" defer></script>
    <script src="JavaScript/footer.js" defer></script>
</head>

<body>
    <header id="navbar"></header>

    <!-- De table div word hier aangemaakt  -->
    <div id="project_table">
        <h2 class="panel-title">Projects</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Project name</th>
                <th col="2" >Client naam</th>
                <th>start date</th>
                <th>end datum</th>
                <th>Hourly rate</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>

            <tr> <?php
                // De info word opgehaald uit de DB via een functie en dan uitgeprint in de table.
                    $clients = $user->getClientsForLoggedInZZP($_SESSION['zzpr_id']);
                    $projects = $user->allProjects($_SESSION['zzpr_id']);
                    if ($projects && $clients) {
                        foreach ($projects as $project) { ?>
                        <td><?php echo $project['project_id'] ?></td>
                        <td><?php echo $project['project_name']?></td>
                        <?php
                        // Loop through clients to find the matching client
                        foreach ($clients as $client) {
                            if ($client['client_id'] == $project['client_id']) {
                                echo '<td>' . $client['firstname'] . ' ' .  $client['lastname'] . '</td>';
                                break;
                            }
                        }?>
                        <td><?php echo $project['start_date'] ?></td>
                        <td><?php echo $project['end_date'] ?></td>
                        <td><?php echo $project['hourly_rate'] ?></td>
                        <td><?php echo $project['project_status'] ?></td>
                        <td><a href="edit_projects.php?id=<?php echo $project['project_id']; ?>"><button>Edit</button></a></td>
                        <td><a class="delete" href="delete_project.php?id=<?php echo $project['project_id']; ?>">delete</a></td>
            </tr> <?php }
            }?>

        </table>
    </div>
    
    <a href="tv_projecten.php"><button>Add Project</button></a>


    <footer id="footerbar"></footer>
</body>

</html>