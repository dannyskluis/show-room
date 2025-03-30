<?php
session_start();
if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
    header("Location:user-login.php");
    exit();
}
include '../header.php';
include 'user.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User View</title>
    <link rel="stylesheet" href="../style/User/view.css">

</head>
<body>
<div class="container">
    <h3><?php echo "Welcome ". $_SESSION['naam']; ?></h3>
    <?php if ($_SESSION['rol'] == 'docent') { ?>
    <?php } ?>

    <?php if ($_SESSION['rol'] == 'docent') { ?>
    <table class="table">
        <tr>
            <th>id</th>
            <th>naam</th>
            <th>email</th>
            <th>password</th>
            <th colspan="2">action</th>
        </tr>
        <?php 
            $users = new User($myDb);
            try {
                $result = $users->getUsersByRole('student');
                if ($result) {
                    if (count($result) > 0) {
                        foreach ($result as $row) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['naam']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['password']; ?></td>
                                <td><a href="user-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a></td>
                                <td><a href="user-delete.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Delete</a></td>
                            </tr>
                        <?php }
                    } else {
                        echo "<tr><td colspan='7'>No students found.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Query returned no results.</td></tr>";
                }
            } catch (Exception $e) {
                echo '<tr><td colspan="7">Error: ' . $e->getMessage() . '</td></tr>';
            }
        ?>
    </table>
    <?php } ?>
</div>
</body>
</html>
<?php
include '../footer.php';
?>
   