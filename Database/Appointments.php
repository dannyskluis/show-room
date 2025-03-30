<?php
require_once("session_manager.php");
require_once("db.php");

class Appointments
{
    public $dbh;
    public $appointmentsTable = "appointments";
    public $reviewsTable = "employee_reviews";

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
    }

    // Get all the insurance information for a user by their patient ID
    public function oneAppointment($id)
    {
        $query = "SELECT * FROM $this->appointmentsTable WHERE APPOINTMENT_ID = ?";
        return $this->dbh->execute($query, [$id])->fetch();
    }

    public function onePatient($id)
    {
        $query = "SELECT * FROM $this->appointmentsTable WHERE APPOINTMENT_PATIENT_ID = ?";
        return $this->dbh->execute($query, [$id])->fetch();
    }

    public function submitReview($patientID, $appointmentID, $rating, $reviewText)
    {
        $query = "INSERT INTO $this->reviewsTable (REVIEW_PATIENT_ID, REVIEW_APPOINTMENT_ID, REVIEW_DATE, RATING, REVIEW_TEXT) VALUES (?, ?, NOW(), ?, ?)";
        return $this->dbh->execute($query, [$patientID, $appointmentID, $rating, $reviewText]);
    }

    public function getUnreviewedAppointments($patientID) {
        $query = "
            SELECT a.APPOINTMENT_ID, a.APPOINTMENT_DATETIME, a.APPOINTMENT_STATUS 
            FROM appointments a
            LEFT JOIN $this->reviewsTable r ON a.APPOINTMENT_ID = r.REVIEW_APPOINTMENT_ID
            WHERE a.APPOINTMENT_PATIENT_ID = ? 
            AND r.REVIEW_ID IS NULL 
            AND a.APPOINTMENT_STATUS = 'Done'
        ";
    
        $appointments = $this->dbh->execute($query, [$patientID])->fetchAll(PDO::FETCH_ASSOC);
    
        // Format the appointment datetime to include time (excluding seconds)
        foreach ($appointments as &$appointment) {
            // Format as 'Y-m-d H:i'
            $appointment['APPOINTMENT_DATETIME'] = date('Y-m-d H:i', strtotime($appointment['APPOINTMENT_DATETIME']));
        }
    
        return $appointments;
    }

    // Nieuwe methode om behandelaars op te halen
    public function getBehandelaars()
    {
        $query = "SELECT EMPLOYEE_ID, EMPLOYEE_FIRSTNAME, EMPLOYEE_LASTNAME FROM employees";
        return $this->dbh->execute($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Voorbeeld van het maken van een instantie
$myDB = new DB();
$appointment = new Appointments($myDB);
