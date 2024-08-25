<?php

@include 'database.php';

if (isset($_POST['add_user'])) {
    $user_fullName = isset($_POST['user_fullName']) ? $_POST['user_fullName'] : '';
    $user_adres = isset($_POST['user_adres']) ? $_POST['user_adres'] : '';
    $user_driverLicenseNumber = isset($_POST['user_driverLicenseNumber']) ? $_POST['user_driverLicenseNumber'] : '';
    $user_phoneNumber = isset($_POST['user_phoneNumber']) ? $_POST['user_phoneNumber'] : '';
    $user_email = isset($_POST['user_email']) ? $_POST['user_email'] : '';
    $user_password = isset($_POST['user_password']) ? $_POST['user_password'] : '';
    $user_user_type = isset($_POST['user_user_type']) ? $_POST['user_user_type'] : '';



    if (empty($user_fullName) || empty($user_adres) || empty($user_driverLicenseNumber) || empty($user_phoneNumber) || empty($user_email) || empty($user_password) || empty($user_user_type)) {
        $message[] = 'please fill out all fields';
    } else {
        $insert = "INSERT INTO user_form(fullName, adres, driverLicenseNumber, phoneNumber, email, password, user_type) VALUES('$user_fullName', '$user_adres', '$user_driverLicenseNumber', '$user_phoneNumber', '$user_email', '$user_password', '$user_user_type')";
        $upload = mysqli_query($conn, $insert);
        if ($upload) {
            $message[] = 'car added successfully';
        } else {
            $message[] = 'could not add the car';
        }
    }
}
;

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM user_form WHERE id = $id");
    header('location:user.php');
}
;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <!-- header begint -->

    <header class="header">

        <div id="menu-btn" class="fas fa-bars"></div>

        <nav class="navbar">
            <a href="admin.php">home</a>
            <a href="vehicles.php">vehicles</a>
            <a href="users.php">costumers</a>
            <a href="rentals.php">rentals</a>
            <a href="logout.php">logout</a>
        </nav>

    </header>

    <!-- header eindigt -->
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo 'span class="message">' . $message . '</span>';
        }
    }
    ?>
    <div class="container">

        <div class="admin-car-form-container">

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

                <h3>add a new user</h3>
                <input type="text" placeholder="enter user fullName" name="user_fullName" class="box">
                <input type="text" placeholder="enter user adres" name="user_adres" class="box">
                <input type="number" placeholder="enter user driverLicenseNumber" name="user_driverLicenseNumber"
                    class="box">
                <input type="text" placeholder="enter user phoneNumber" name="user_phoneNumber" class="box">
                <input type="text" placeholder="enter user email" name="user_email" class="box">
                <input type="password" placeholder="enter user password" name="user_password" class="box">
                <h2>user or admin</h2>
                <select class="box" name="user_user_type">
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
                <input type="submit" class="btn" name="add_user" value="add user">
            </form>

        </div>

        <?php

        $select = mysqli_query($conn, "SELECT * FROM user_form");

        ?>

        <div class="car-display">

            <table class="car-display-table">

                <thead>
                    <tr>
                        <th>user fullName</th>
                        <th>user adres</th>
                        <th>user driverLicenseNumber</th>
                        <th>user phoneNumber</th>
                        <th>user email</th>
                        <th>user password</th>
                        <th>user_type</th>
                        <th colspan="2">action</th>
                    </tr>
                </thead>

                <?php

                while ($row = mysqli_fetch_assoc($select)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row['fullName']; ?>
                        </td>
                        <td>
                            <?php echo $row['adres']; ?>
                        </td>
                        <td>
                            <?php echo $row['driverLicenseNumber']; ?>
                        </td>
                        <td>
                            <?php echo $row['phoneNumber']; ?>
                        </td>
                        <td>
                            <?php echo $row['email']; ?>
                        </td>
                        <td>
                            <?php echo $row['password']; ?>
                        </td>
                        <td>
                            <?php echo $row['user_type']; ?>
                        </td>
                        <td>
                            <a href="edituser.php?id=<?php echo $row['id']; ?>" class="btn"><i
                                    class="fas fa-edit"></i>edit</a>

                            <a href="user.php?delete=<?php echo $row['id']; ?>" class="btn"> <i
                                    class="fas fa-delete"></i>delete</a>

                        </td>
                    </tr>



                <?php }
                ; ?>

            </table>

        </div>

    </div>
</body>

</html>