<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once("../Database/Patients.php");
require_once("../Database/Appointments.php");
require_once("identification.php");
require '../vendor/autoload.php';

function sendAppointmentCancelEmail($patient_ID, $appointment_id) {
    global $Patients, $appointment, $identityUsername, $identityPassword;

    $patientData = $Patients->onePatient($patient_ID);
    $appointmentData = $appointment->oneAppointment($appointment_id);

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $identityUsername; // SMTP username
        $mail->Password   = $identityPassword; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('vazodevelopment@gmail.com', 'Tiny Tooth Dental');
        $mail->addAddress($patientData['PATIENT_EMAIL']);
        $mail->addEmbeddedImage('../fotos/Logo.png', 'logo_cid');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Appointment Cancellation';
        $mail->Body = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    padding: 20px;
                }
                .container {
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                }
                .header {
                    background-color: #dc3545;
                    color: #ffffff;
                    padding: 10px;
                    text-align: center;
                    border-radius: 10px 10px 0 0;
                }
                .footer {
                    margin-top: 20px;
                    text-align: center;
                    font-size: 12px;
                    color: #888888;
                }
                .logo { width: 100px; height: auto; margin-bottom: 10px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <img src="cid:logo_cid" alt="Tiny Tooth Dental Logo" class="logo" />
                    <h1>Appointment Cancellation</h1>
                </div>
                <div class="content">
                    <p>Dear <strong>' . htmlspecialchars($patientData['PATIENT_FIRSTNAME']) . ' ' . htmlspecialchars($patientData['PATIENT_LASTNAME']) . '</strong>,</p>
                    <p>We regret to inform you that your appointment scheduled for:</p>
                    <p><strong>Appointment Details:</strong></p>
                    <ul>
                        <li><strong>Datetime:</strong> ' . date('Y-m-d H:i', strtotime($appointmentData['APPOINTMENT_DATETIME'])) . '</li>
                        <li><strong>Location:</strong> Tiny Tooth Dental</li>
                    </ul>
                    <p>has been <strong>canceled</strong>.</p>
                    <p>We apologize for any inconvenience this may have caused. If you would like to reschedule your appointment, please contact us at your earliest convenience.</p>
                    <p>If you have any questions or need further assistance, feel free to contact us at vazodevelopment@gmail.com or at the website.</p>
                </div>
                <div class="footer">
                    <p>Best regards,</p>
                    <p>Tiny Tooth Dental</p>
                </div>
            </div>
        </body>
        </html>';

        $mail->AltBody = 'Appointment Cancellation

        Dear ' . $patientData['PATIENT_FIRSTNAME'] . ' ' . $patientData['PATIENT_LASTNAME'] . ',

        We regret to inform you that your appointment scheduled for:

        Appointment Details:
        Datetime: ' . date('Y-m-d H:i', strtotime($appointmentData['APPOINTMENT_DATETIME'])) . '
        Location: Tiny Tooth Dental

        has been canceled.

        We apologize for any inconvenience this may have caused. If you would like to reschedule your appointment, please contact us at your earliest convenience.

        If you have any questions or need further assistance, feel free to contact us at vazodevelopment@gmail.com or at the website.

        Best regards,
        Tiny Tooth Dental';

        $mail->send();
        return 'Message has been sent';
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
