<?php
include 'connectie.php';
 
// Initialisatie van variabelen
$searchName = '';
$resultMessage = '';
 
// Verwerken van formulierindiening
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Haal de waarde op uit het formulier
    $searchName = $_POST['searchName'];
 
 
    // Voeg hier de validatie van de ingevoerde gegevens toe
    // ...
 
    // Als er geen fouten zijn, zoek de gegevens in de database
    if (empty($errors)) {
        try {
            // Zoek gegevens in de database op basis van de ingevoerde naam
            if (!empty($searchName)) {
                $sql = "SELECT persons.person_id, persons.firstname, persons.infix, persons.lastname,
                               adressen.adress_id, adressen.firstname AS adres_firstname,
                               adressen.middle_initials, adressen.lastname AS adres_lastname,
                               adressen.mv, adressen.street, adressen.nr,
                               adressen.Add_ AS adres_Add_, adressen.zipcode,
                               adressen.place, adressen.country
                        FROM persons
                        JOIN peoplesadresses ON persons.person_id = peoplesadresses.person_id
                        JOIN adressen ON adressen.adress_id = peoplesadresses.adress_id
                        WHERE CONCAT(persons.firstname, ' ', persons.infix, ' ', persons.person_id, ' ',adressen.zipcode, ' ', adressen.lastname, ' ',adressen.firstname, ' ', adressen.street,' ', persons.lastname,' ', adressen.mv) LIKE :searchName";
            }
           
 
            $stmt = $conn->prepare($sql);
 
    $searchParam = '%' . $searchName . '%';
    $stmt->bindParam(':searchName', $searchParam);
   
 
    $stmt->execute();
 
    // Fetch IDs into an array
   
 
    // Now $personIds contains the IDs from the query result
 
            $stmt->execute();
 
            // Controleer of er resultaten zijn
            if ($stmt->rowCount() > 0) {
                // Haal de resultaten op
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
                // Toon de resultaten
                $resultMessage = "<h3>Resultaten:</h3>";
                foreach ($result as $row) {
                    $resultMessage .= "Persoon ID: " . $row['person_id'] . "<br>";
                    $resultMessage .= "Naam: " . $row['firstname'] . " " . $row['infix'] . " " . $row['lastname'] . "<br>";
                    $resultMessage .= "Adres ID: " . $row['adress_id'] . "<br>";
                    $resultMessage .= "Adres: " . $row['street'] . " " . $row['nr'] . ", " . $row['adres_Add_'] . "<br>";
                    $resultMessage .= "Postcode: " . $row['zipcode'] . "<br>";
                    $resultMessage .= "Plaats: " . $row['place'] . "<br>";
                    $resultMessage .= "Land: " . $row['country'] . "<br><hr>";
                }
            } else {
                $resultMessage = "Geen overeenkomende gegevens gevonden.";
            }
        } catch (PDOException $e) {
            // Toon een foutbericht als er een fout optreedt
            $resultMessage = "Error: " . $e->getMessage();
        }
    } else {
        // Toon foutmeldingen als de ingevoerde gegevens niet correct zijn
        foreach ($errors as $error) {
            $resultMessage .= "<p style='color: red;'>$error</p><br>";
        }
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoekformulier voor gegevens</title>
</head>
<body>
 
<!-- HTML-formulier -->
<!-- HTML-formulier -->
<h2>Zoek Gegevens</h2>
<form method="post" action="">
    <label for="searchName">Zoek op naam:</label>
    <input type="text" name="searchName" id="searchName" value="<?php echo $searchName; ?>">
    <button type="submit">Zoeken</button>
</form>
 
 
<!-- Resultaten weergeven -->
<?php echo $resultMessage; ?>
 
</body>
</html>