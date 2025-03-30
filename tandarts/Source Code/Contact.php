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
    <title>Contact</title>
    <script src="Javascript/public_header.js" defer></script>
    <script src="Javascript/public_footer.js" defer></script>
    <script src="Javascript/add_appointment_error.js" defer></script>
    <link rel="stylesheet" href="Style/add_appointment_error.css">
    <link rel="stylesheet" href="Style/public_header.css">
    <link rel="stylesheet" href="Style/public_footer.css">
    <link rel="stylesheet" href="Style/Contact.css">
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
            <newisty-contact-us-generator url="https://newisty.com/contact-us-page-generator"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
                <div class="container">
                        <h1>Contact Us - Tiny Tooth Dental</h1>
                        <p>If you have any questions, comments, or concerns related to Tiny Tooth Dental, we are here to help. Our customer support team is available to assist you through multiple channels, so you can choose the one that works best for you.</p>
                
                        <div class="row">
                            <div class="contact-medium">
                                <div class="contact-method">
                                    <i class="contact-method-icon fas fa-envelope"></i>
                                    <span class="contact-method-title">Email Support</span>
                                    <div class="contact-method-description">You can send us an email at <a href="mailto:info@TinyToothDental.nl">info@TinyToothDental.nl</a> and we’ll get back to you as soon as possible. Our team is available to answer your questions and provide assistance with any issues you may be experiencing on Tiny Tooth Dental.</div>
                                </div>
                            </div><div class="contact-medium">
                                <div class="contact-method">
                                    <i class="contact-method-icon fas fa-phone"></i>
                                    <span class="contact-method-title">Phone Support</span>
                                    <div class="contact-method-description">If you prefer to speak with someone directly, you can call us at <a href="tel:+02029485002">+02029485002</a>. Our customer support team is available to take your call 24/7 to assist you with any issues related to Tiny Tooth Dental.</div>
                                </div>
                            </div><div class="contact-medium">
                                <div class="contact-method">
                                    <i class="contact-method-icon fas fa-map-marker-alt"></i>
                                    <span class="contact-method-title">Office Location</span>
                                    <div class="contact-method-description">You are always welcome to visit us at our office. We are located at <b>4FM7+HH Aappilattorq, Groenland</b>. We would love to have a face-to-face conversation with you and show you how we can help you with anything related to Tiny Tooth Dental.</div>
                                </div>
                            </div><div class="contact-medium">
                                <div class="contact-method">
                                    <i class="contact-method-icon fas fa-comments"></i>
                                    <span class="contact-method-title">Live Chat Support</span>
                                    <div class="contact-method-description">Our customer support team is available 24/7 to assist you through our live chat feature on Tiny Tooth Dental. Simply click on the chat icon on the bottom right corner of your screen to start a conversation. Our team is trained to provide quick and efficient assistance with any issues you may be experiencing.</div>
                                </div>
                            </div><div class="contact-medium">
                                <div class="contact-method">
                                    <i class="contact-method-icon fas fa-share"></i>
                                    <span class="contact-method-title">Social Media Support</span>
                                    <div class="contact-method-description">You can also reach out to us through our social media channels.    and <a href="02029485002" class=""><i class="fab fa-whatsapp"></i></a> <a href="whatsapp.com/send?phone=+02029485002&amp;text=Contact with Tiny Tooth Dental">What's App</a> to stay up-to-date with our latest news and updates, and send us a message directly through these platforms to get assistance with Tiny Tooth Dental. Our social media team is available to respond to your inquiries and concerns.</div>
                                </div>
                            </div>
                        </div> <p>We value your feedback and are committed to providing you with the best possible service on Tiny Tooth Dental. If you have any suggestions on how we can improve our website or services, please let us know. Our team is always looking for ways to enhance the customer experience on Tiny Tooth Dental and we appreciate any feedback you can provide.</p>
                
                        <p>Thank you for choosing Tiny Tooth Dental. We look forward to hearing from you!</p>

                    </div>
                </div></newisty-contact-us-generator>
                
        </div>
    </main>

    <footer id="footer" class="footer"></footer>
</body>
</html>