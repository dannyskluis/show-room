<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Carrentall Zoekpagina</title>
</head>
<body>

<div class="container mt-4">
    <h2>Zoek Auto</h2>
    <form action="" method="post">
        <div class="input-group">
            <input type="text" name="searchTerm" class="form-control" placeholder="Voer zoekterm in">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Zoeken</button>
            </div>
        </div>
    </form>

    <?php
    include 'connectie.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Hier voeg je de zoekfunctionaliteit toe op basis van de post-gegevens
        $searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

        // Voer de zoekopdracht uit en toon de resultaten
        $stmt = $conn->prepare("
            SELECT rentals.rental_id, cars.license_plate, cars.brand, cars.model, cars.type, rentals.rental_date, rentals.return_date, rentals.is_paid
            FROM rentals
            JOIN cars ON rentals.car_id = cars.car_id
            WHERE cars.license_plate LIKE :searchTerm
            OR cars.brand LIKE :searchTerm
            OR cars.model LIKE :searchTerm
            OR cars.type LIKE :searchTerm
            OR rentals.rental_date LIKE :searchTerm

        ");

        $searchTerm = "%$searchTerm%"; // Voeg wildcards toe voor een deel van de zoekterm
        $stmt->bindParam(':searchTerm', $searchTerm);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Toon de resultaten in een Bootstrap-tabel
        if (!empty($result)) {
            echo "<table class='table table-bordered mt-4'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>Rental ID</th>
                            <th>License Plate</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Type</th>
                            <th>Rental Date</th>
                            <th>Return Date</th>
                            <th>Is Paid</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($result as $row) {
                echo "<tr>
                        <td>".$row["rental_id"]."</td>
                        <td>".$row["license_plate"]."</td>
                        <td>".$row["brand"]."</td>
                        <td>".$row["model"]."</td>
                        <td>".$row["type"]."</td>
                        <td>".$row["rental_date"]."</td>
                        <td>".$row["return_date"]."</td>
                        <td>".($row["is_paid"] == 1 ? "Yes" : "No")."</td>
                      </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<div class='mt-4'>Geen resultaten gevonden</div>";
        }
    }
    ?>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
