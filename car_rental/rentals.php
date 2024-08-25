<?php
@include 'database.php';

// Fetch rental information from the database
$selectRentals = mysqli_query($conn, "SELECT rentals.*, user_form.fullName AS userName, cars.merk, cars.model FROM rentals
                                        INNER JOIN user_form ON rentals.user_id = user_form.id
                                        INNER JOIN cars ON rentals.car_id = cars.id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Overview</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <!-- header begins -->
    <header class="header">
        <div id="menu-btn" class="fas fa-bars"></div>
        <nav class="navbar">
            <a href="admin.php">home</a>
            <a href="vehicles.php">vehicles</a>
            <a href="user.php">customers</a>
            <a href="rentals.php">rentals</a>
            <a href="logout.php">logout</a>
        </nav>
    </header>
    <!-- header ends -->

    <div class="container">
        <div class="car-display">
            <h2>Rental Overview</h2>
            <table class="car-display-table">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Car Merk</th>
                        <th>Car Model</th>
                        <th>Rental Start Date</th>
                        <th>Rental End Date</th>
                        <th>Rental Cost</th>
                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_assoc($selectRentals)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row['userName']; ?>
                        </td>
                        <td>
                            <?php echo $row['merk']; ?>
                        </td>
                        <td>
                            <?php echo $row['model']; ?>
                        </td>
                        <td>
                            <?php echo $row['start_date']; ?>
                        </td>
                        <td>
                            <?php echo $row['end_date']; ?>
                        </td>
                        <td>
                            <?php echo $row['rental_cost']; ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>