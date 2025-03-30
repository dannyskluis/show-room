<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require_once("../Database/Patients.php");
require_once("../Database/Appointments.php");
require_once("identification.php");

function sendAppointmentEmail($patient_ID, $appointment_id) {
    global $Patients, $appointment, $identityUsername, $identityPassword;
    $patientData = $Patients->onePatient($patient_ID);
    $appointmentData = $appointment->oneAppointment($appointment_id);

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $identityUsername;
        $mail->Password   = $identityPassword;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('vazodevelopment@gmail.com', 'Tiny Tooth Dental');
        $mail->addAddress($patientData['PATIENT_EMAIL']);
        $mail->addEmbeddedImage('../fotos/Logo.png', 'logo_cid');

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Your Appointment Confirmation (ID: $appointment_id)";
        $mail->Body = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
                .container { background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
                .header { background-color: #28a745; color: #ffffff; padding: 10px; text-align: center; border-radius: 10px 10px 0 0; }
                .logo { width: 100px; height: auto; margin-bottom: 10px; }
                .content { padding: 20px; font-size: 16px; }
                .footer { margin-top: 20px; text-align: center; font-size: 12px; color: #888888; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <img src="cid:logo_cid" alt="Tiny Tooth Dental Logo" class="logo" />
                    <h1>Appointment Confirmation</h1>
                </div>
                <div class="content">
                    <p>Dear <strong>' . htmlspecialchars($patientData['PATIENT_FIRSTNAME']) . ' ' . htmlspecialchars($patientData['PATIENT_LASTNAME']) . '</strong>,</p>
                    <p>We are pleased to inform you that your appointment has been scheduled successfully.</p>
                    <p><strong>Appointment Details:</strong></p>
                    <ul>
                        <li><strong>Datetime:</strong> ' . date('Y-m-d H:i', strtotime($appointmentData['APPOINTMENT_DATETIME'])) . '</li>
                        <li><strong>Location:</strong> Tiny Tooth Dental</li>
                    </ul>
                    <p>If you have any questions or need to reschedule, feel free to contact us at vazodevelopment@gmail.com or at the website.</p>
                    <p>Thank you for choosing our services. We look forward to seeing you!</p>
                </div>
                <div class="footer">
                    <p>Best regards,</p>
                    <p>Tiny Tooth Dental</p>
                </div>
            </div>
        </body>
        </html>';

        $mail->AltBody = 'Appointment Confirmation

        Dear ' . $patientData['PATIENT_FIRSTNAME'] . ' ' . $patientData['PATIENT_LASTNAME'] . ',

        We are pleased to inform you that your appointment has been scheduled successfully.

        Appointment Details:
        Datetime: ' . date('Y-m-d H:i', strtotime($appointmentData['APPOINTMENT_DATETIME'])) . '
        Location: Tiny Tooth Dental

        If you have any questions or need to reschedule, feel free to contact us at vazodevelopment@gmail.com or at the website.

        Thank you for choosing our services. We look forward to seeing you!

        Best regards,
        Tiny Tooth Dental';

        $mail->send();
        return 'Message has been sent';
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
