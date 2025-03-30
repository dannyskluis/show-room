<?php
require '../database/db.php';
require_once("../session_manager.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
    $password = htmlspecialchars($_POST['password']);

    $db = new DB();

    // Zoek in klanten
    $stmt = $db->execute("SELECT klant_id, voornaam, wachtwoord FROM klanten WHERE e_mail = ?", [$email]);
    $klant = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($klant && password_verify($password, $klant['wachtwoord'])) {
        // Store klant_id in the session
        $_SESSION['user_id'] = $klant['klant_id']; // klant_id stored in session
        $_SESSION['role'] = 'klant'; // Store role as 'klant'
        
        // Redirect to homepage after successful login
        header('Location: ../index.php');
        exit;
    }

    // Zoek in medewerkers (for employee login)
    $stmt = $db->execute("SELECT medewerker_id, naam, wachtwoord, rol FROM medewerkers WHERE e_mail = ?", [$email]);
    $medewerker = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($medewerker && password_verify($password, $medewerker['wachtwoord'])) {
        // Store medewerker_id and role in session
        $_SESSION['user_id'] = $medewerker['medewerker_id']; // medewerker_id stored in session
        $_SESSION['role'] = $medewerker['rol']; // Store employee role

        // Redirect to homepage after successful login
        header('Location: ../index.php');
        exit;
    }

    // If login fails for both customer and employee
    echo "Ongeldige inloggegevens";
}

?>

<?php include '../components/header.php'; ?>

<div class="container">
    <main>
        <form class="formulier" method="POST">
            <div class="formulier">
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="password" placeholder="Wachtwoord" required>
                <button type="submit">Inloggen</button>
            </div>
        </form>
    </main>
</div>

<?php include '../components/footer.php'; ?>
