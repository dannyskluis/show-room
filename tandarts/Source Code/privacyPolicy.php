<?php
require_once("Database/session_manager.php");
require_once('Database/Authentication.php');
require_once('Database/Appointments.php');

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
    <script src="Javascript/public_header.js" defer></script>
    <script src="Javascript/public_footer.js" defer></script>
    <script src="Javascript/add_appointment_error.js" defer></script>
    <link rel="stylesheet" href="Style/add_appointment_error.css">
    <link rel="stylesheet" href="Style/public_header.css">
    <link rel="stylesheet" href="Style/public_footer.css">
    <link rel="stylesheet" href="Style/privacyPolicy.css">
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
        <div class="everything">
            <p><b>Last updated:</b> 27 September, 2024</p>

            <h2><strong>Privacy Policy for Tiny Tooth Dental</strong></h2>

            <p>At Tiny Tooth Dental, accessible from <a href="Homepage.php">https://TinyToothDental.nl</a>, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by Tiny Tooth Dental and how we use it.</p>

            <p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to <a href="mailto:info@TinyToothDental.nl">Contact Us by E-mail</a>.</p>

            <p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in Tiny Tooth Dental. This policy does not applicable to any information collected offline or via channels other than this website.</p>

            <h2><strong>Consent</strong></h2>

            <p>By using our website, you hereby consent to our Privacy Policy and agree to its <a href="Terms.html" title="Terms.html">https://TinyToothDental.nl/Terms</a>.</p>

            <h2><strong>Information we collect</strong></h2>

            <p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>

            <p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>

            <p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>

            <h2><strong>How we use your information</strong></h2>

            <p>We use the information we collect in various ways, including:</p>

            <p>Provide, operate, and maintain our website</p>

            <p>Improve, personalize, and expand our website</p>

            <p>Understand and analyze how you use our website</p>

            <p>Develop new products, services, features, and functionality Communicate with you, either directly or through one of our partners, including for customer service.</p>

            <p>To provide you with updates and other information relating to the website, and for marketing and promotional purposes</p>

            <p>Send you emails.</p>

            <p>Find and prevent fraud.</p>

            <h2><strong>Log Files</strong></h2>

            <p>Tiny Tooth Dental follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and are a part of hosting services' analytics. The information collected by log files includes internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information.</p><h2><strong>CCPA Privacy Rights (Do Not Sell My Personal Information)</strong></h2>

            <p>Under the CCPA, among other rights, California consumers have the right to:</p>

            <p>Request that a business that collects a consumer's personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>

            <p>Request that a business delete any personal data about the consumer that a business has collected.</p>

            <p>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</p>

            <p>If you make a request, we have 30 Days to respond to you.</p>

            <p>If you would like to exercise any of these rights, please <a href="mailto:info@TinyToothDental.nl">Contact Us by E-mail</a>.</p>

            <h2><strong>GDPR Data Protection Rights</strong></h2>

            <p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>

            <p>The right to access: You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>

            <p>The right to rectification: You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>

            <p>The right to erasure: You have the right to request that we erase your personal data, under certain conditions.</p>

            <p>The right to restrict processing: You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>

            <p>The right to object to processing: You have the right to object to our processing of your personal data, under certain conditions.</p>

            <p>The right to data portability: You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>

            <p>If you make a request, we have 30 Days to respond to you. If you would like to exercise any of these rights, please <a href="mailto:info@TinyToothDental.nl">Contact Us by E-mail</a>.</p>

            <h2><strong>Children's Information</strong></h2>

            <p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>

            <p>Tiny Tooth Dental does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>

            <h2><strong>Revisions to our Privacy Policy</strong></h2>

            <p>We reserve the right to edit this privacy policy or any part of it from time to time. We may notify you or not. Please review the policy periodically for changes.</p>


        </div>
    </main>

    <footer id="footer" class="footer"></footer>
</body>
</html>