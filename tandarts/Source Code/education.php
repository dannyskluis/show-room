<?php
require_once("Database/session_manager.php");
require_once('Database/Authentication.php');
require_once('Database/Appointments.php');
require_once('Database/Education.php');

$isLoggedIn = isset($_SESSION['PATIENT_ID']) || isset($_SESSION['EMPLOYEE_ID']);

$showLoginError = false;
if (isset($_SESSION['LOGIN_ERROR'])) {
    $showLoginError = true;
    unset($_SESSION['LOGIN_ERROR']);
}

$unreviewedAppointments = [];
if (isset($_SESSION['PATIENT_ID'])) {
    // Only fetch unreviewed appointments if the patient is logged in
    $patientID = $_SESSION['PATIENT_ID'];
    $unreviewedAppointments = $appointment->getUnreviewedAppointments($patientID);
}

$videos = $Education->getVideos();
$articles = $Education->getArticles();
$downloads = $Education->getDownloads();
$questions = $Education->getQuestions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access to Educational Materials on Oral Health</title>
    <script src="Javascript/public_header.js" defer></script>
    <script src="Javascript/public_footer.js" defer></script>
    <script src="Javascript/add_appointment_error.js" defer></script>
    <link rel="stylesheet" href="Style/add_appointment_error.css">
    <link rel="stylesheet" href="Style/public_header.css">
    <link rel="stylesheet" href="Style/public_footer.css">
    <link rel="stylesheet" href="Style/education.css">
</head>
<body>
<div id="loginModal" class="modal" style="display: <?php echo $showLoginError ? 'block' : 'none'; ?>;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>You must log in first to access this page.</p>
    </div>
</div>

<nav id="nav" class="nav" data-loggedin="<?php echo $isLoggedIn ? 'true' : 'false'; ?>"></nav>

<script>
    const unreviewedAppointments = <?php echo json_encode($unreviewedAppointments); ?>;
</script>

<main>
    <div class="container">
        <h1>Access to Educational Materials on Oral Health</h1>
        <p>Welcome to our educational page about oral health. Here you will find videos, articles, and other useful information to help you improve your oral health.</p>

        <!-- Video Section -->
        <h2>Videos on Oral Health</h2>
        <div class="video">
            <?php
            if (!empty($videos)) {
                foreach ($videos as $video) {
                    echo "<p><strong>{$video['VIDEO_TITLE']}</strong><br><a href=\"{$video['VIDEO_LINK']}\">Watch video</a></p>";
                }
            } else {
                echo "<p>No videos available at the moment.</p>";
            }
            ?>
        </div>

        <!-- Articles Section -->
        <h2>Articles and Information Pages</h2>
        <div class="article">
            <?php
            if (!empty($articles)) {
                foreach ($articles as $article) {
                    echo "<p><a href=\"{$article['ARTICLE_LINK']}\">{$article['ARTICLE_TITLE']}</a></p>";
                }
            } else {
                echo "<p>No articles available at the moment.</p>";
            }
            ?>
        </div>

        <!-- Downloadable Resources Section -->
        <h2>Downloadable Information</h2>
        <div class="downloads">
            <?php
            if (!empty($downloads)) {
                foreach ($downloads as $download) {
                    echo "<p class='article'><a href=\"{$download['DOWNLOAD_PATH']}\">{$download['DOWNLOAD_TITLE']}</a></p>";
                }
            } else {
                echo "<p>No downloadable information available at the moment.</p>";
            }
            ?>
        </div>

        <!-- FAQ Section -->
        <h2>Frequently Asked Questions (FAQ)</h2>
        <div class="faq">
            <?php
            if (!empty($questions)) {
                foreach ($questions as $faq) {
                    echo "<div class=\"faq-item\"><strong>{$faq['QUESTION_TITLE']}</strong><br>{$faq['QUESTION_ANSWER']}</div>";
                }
            } else {
                echo "<p>No FAQs available at the moment.</p>";
            }
            ?>
        </div>
    </div>
</main>

<footer id="footer" class="footer"></footer>
</body>
</html>

