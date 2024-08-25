<?php

@include 'database.php';

if (isset($_POST['add_car'])) {
    $car_Merk = isset($_POST['car_Merk']) ? $_POST['car_Merk'] : '';
    $car_Model = isset($_POST['car_Model']) ? $_POST['car_Model'] : '';
    $car_Jaar = isset($_POST['car_Jaar']) ? $_POST['car_Jaar'] : '';
    $car_Kenteken = isset($_POST['car_Kenteken']) ? $_POST['car_Kenteken'] : '';
    $car_Beschikbaarheid = isset($_POST['car_beschikbaarheid']) ? $_POST['car_beschikbaarheid'] : '';
    $car_image = isset($_FILES['car_Image']['name']) ? $_FILES['car_Image']['name'] : '';

    if (empty($car_Merk) || empty($car_Model) || empty($car_Jaar) || empty($car_Kenteken) || empty($car_Beschikbaarheid) || empty($car_image)) {
        $message[] = 'please fill out all fields';
    } else {
        $insert = "INSERT INTO cars(merk, model, Jaar, kenteken, beschikbaarheid, image) VALUES('$car_Merk', '$car_Model', '$car_Jaar', '$car_Kenteken', '$car_Beschikbaarheid', '$car_image')";
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
    mysqli_query($conn, "DELETE FROM cars WHERE id = $id");
    header('location:vehicles.php');
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
            <a href="user.php">costumers</a>
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

                <h3>add a new car</h3>
                <input type="text" placeholder="enter car merk" name="car_Merk" class="box">
                <input type="text" placeholder="enter car model" name="car_Model" class="box">
                <input type="number" placeholder="enter car jaar" name="car_Jaar" class="box">
                <input type="text" placeholder="enter car kenteken" name="car_Kenteken" class="box">
                <h2>is the car available</h2>
                <select class="box" name="car_beschikbaarheid">
                    <option value="ja">ja</option>
                    <option value="nee">nee</option>
                </select>
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="car_Image" class="box">
                <input type="submit" class="btn" name="add_car" value="add car">
            </form>

        </div>

        <?php

        $select = mysqli_query($conn, "SELECT * FROM cars");

        ?>

        <div class="car-display">

            <table class="car-display-table">

                <thead>
                    <tr>
                        <th>car image</th>
                        <th>car merk</th>
                        <th>car model</th>
                        <th>car jaar</th>
                        <th>car kenteken</th>
                        <th>car beschikbaarheid</th>
                        <th colspan="2">action</th>
                    </tr>
                </thead>

                <?php

                while ($row = mysqli_fetch_assoc($select)) {
                    ?>
                    <tr>
                        <td>
                            <!-- Display the car image -->
                            <img src="fotos/<?php echo $row['image']; ?>" alt="Car Image" width="100" height="100">
                        </td>
                        <td>
                            <?php echo $row['merk']; ?>
                        </td>
                        <td>
                            <?php echo $row['model']; ?>
                        </td>
                        <td>
                            <?php echo $row['jaar']; ?>
                        </td>
                        <td>
                            <?php echo $row['kenteken']; ?>
                        </td>
                        <td>
                            <?php echo $row['beschikbaarheid']; ?>
                        </td>
                        <td>
                            <a href="update.php?id=<?php echo $row['id']; ?>" class="btn"> <i
                                    class="fas fa-edit"></i>edit</a>
                            <a href="vehicles.php?delete=<?php echo $row['id']; ?>" class="btn"> <i
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