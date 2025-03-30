<?php
require_once("../Database/session_manager.php");
require_once("../Database/Authentication.php");
require_once("../Database/Insurance.php");
require_once("../Database/Patients.php");
require_once("../Database/Appointments.php");

$isLoggedIn = isset($_SESSION['PATIENT_ID']);

if (isset($_SESSION['PATIENT_ID'])) {
    $patientID = $_SESSION['PATIENT_ID'];
} else {
    $_SESSION['LOGIN_ERROR'] = true;
    header("Location: ../Homepage.php?error=login");
    exit();
}

$appointment_id = $_GET['id'] ?? null;
$rating = '';
$review_text = '';
$message = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];

    if (empty($rating) || !in_array($rating, ['0', '1', '2', '3', '4', '5'])) {
        $message = "Please select a valid rating.";
    } elseif (empty($review_text)) {
        $message = "Please enter your review.";
    } else {
        if ($appointment->submitReview($patientID, $appointment_id, $rating, $review_text)) {
            $message = "Thank you for your review!";
            header("Location: ../Homepage.php?review=succesfull");
            exit();
        } else {
            $message = "There was an error submitting your review. Please try again.";
        }
    }
}

$unreviewedAppointments = [];
if (isset($_SESSION['PATIENT_ID'])) {
    // Only fetch unreviewed appointments if the patient is logged in
    $patientID = $_SESSION['PATIENT_ID'];
    $unreviewedAppointments = $appointment->getUnreviewedAppointments($patientID);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Review</title>
    <script src="../Javascript/patienten_platform_header.js" defer></script>
    <script src="../Javascript/patienten_platform_footer.js" defer></script>
    <link rel="stylesheet" href="../Style/public_header.css">
    <link rel="stylesheet" href="../Style/public_footer.css">
    <link rel="stylesheet" href="../Style/review.css">
</head>
<body>
<nav id="nav" class="nav" data-loggedin="<?php echo $isLoggedIn ? 'true' : 'false'; ?>"></nav>
<script>
    const unreviewedAppointments = <?php echo json_encode($unreviewedAppointments); ?>;

    const stars = document.querySelectorAll('.star-rating input');

stars.forEach((star) => {
    star.addEventListener('mouseover', () => {
        const ratingValue = star.value;
        stars.forEach((s) => {
            s.nextElementSibling.style.color = s.value <= ratingValue ? '#0056b3' : '#ccc';
        });
    });

    star.addEventListener('mouseout', () => {
        stars.forEach((s) => {
            s.nextElementSibling.style.color = s.checked ? '#007bff' : '#ccc';
        });
    });
});

</script>
<main>
    <br>
    <h1>Submit Your Review</h1>
    <P class="appoinment_id"><?php echo "Appointment Id #" . $appointment_id; ?></P>

    <?php if (!empty($message)): ?>
        <p class="appoinment_id"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="star-rating">
            <input type="radio" id="star5" name="rating" value="5" required>
            <label for="star5" class="star">★</label>
            <input type="radio" id="star4" name="rating" value="4" required>
            <label for="star4" class="star">★</label>
            <input type="radio" id="star3" name="rating" value="3" required>
            <label for="star3" class="star">★</label>
            <input type="radio" id="star2" name="rating" value="2" required>
            <label for="star2" class="star">★</label>
            <input type="radio" id="star1" name="rating" value="1" required>
            <label for="star1" class="star">★</label>
        </div>
        <br>

        <label for="review_text">Review:</label><br>
        <textarea name="review_text" id="review_text" rows="5" required></textarea>
        <br><br>

        <input type="submit" value="Submit Review">
    </form>
</main>

    
    <footer id="footer" class="footer"></footer>
</body>
</html>
