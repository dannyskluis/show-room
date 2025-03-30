<?php
require_once("session_manager.php");
require_once("db.php");
class Dentists
{

    public $dbh;
    public $employeeTable = "employees";
    public $appointmentsTable = "appointments";

    public $patientsTable = "patients";

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
    }

    public function oneEmployee($id)
    {
        return $this->dbh->execute("SELECT * from $this->employeeTable where EMPLOYEE_ID = $id")->fetch();
    }

    public function appointmentsOfDentist($id) {
        $query = "SELECT a.*, p.PATIENT_FIRSTNAME, p.PATIENT_LASTNAME 
              FROM $this->appointmentsTable a
              JOIN $this->patientsTable p ON a.APPOINTMENT_PATIENT_ID = p.PATIENT_ID
              WHERE a.APPOINTMENT_EMPLOYEE_ID = ?";
        return $this->dbh->execute($query, [$id])->fetchAll();
    }

    // Update patient profile
    public function updateDentist($dentistID, $firstname, $lastname, $email, $phonenumber, $birthdate, $password)
    {
        $query = "UPDATE $this->employeeTable
                SET EMPLOYEE_FIRSTNAME = ?, EMPLOYEE_LASTNAME = ?, EMPLOYEE_PRIVATE_EMAIL = ?, EMPLOYEE_PHONENUMBER = ?, EMPLOYEE_BIRTHDAY = ?, EMPLOYEE_PASSWORD = ?
                WHERE EMPLOYEE_ID = ?";
        
        return $this->dbh->execute($query, [$firstname, $lastname, $email, $phonenumber, $birthdate, $password, $dentistID]);
    }


    // Validate and process edit form submission
    public function validateAndProcessEditForm($formData, $dentistID)
    {
        $firstname = $formData['firstname'];
        $lastname = $formData['lastname'];
        $email = $formData['email'];
        $phonenumber = $formData['phonenumber'];
        $birthdate = $formData['dateofbirth'];
        $password = $formData['password'];
        $confirmPassword = $formData['confirm_password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email address!";
        }

        if (!empty($password) && $password !== $confirmPassword) {
            return "Passwords do not match!";
        }

        if (empty($password)) {
            $password = $this->getCurrentPassword($dentistID);
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        $updateSuccessful = $this->updateDentist($dentistID, $firstname, $lastname, $email, $phonenumber, $birthdate, $password);

        if ($updateSuccessful) {
            header("Location: ../tandarts_platform/profielbeheer.php");
            exit();
        } else {
            return "Failed to update profile. Please try again.";
        }
    }

    // Retrieve the current password from the database
    public function getCurrentPassword($dentistID)
    {
        $query = "SELECT EMPLOYEE_PASSWORD FROM $this->employeeTable WHERE EMPLOYEE_ID = ?";
        $result = $this->dbh->execute($query, [$dentistID])->fetch();
        return $result['EMPLOYEE_PASSWORD'];
    }

    public function getAllPatients()
    {
        $query = "SELECT * FROM $this->patientsTable";
        return $this->dbh->execute($query)->fetchAll();
    }

    // Get appointments for today that are scheduled
    public function appointmentsToday($dentistID)
    {
        $today = date('Y-m-d');
        $query = "SELECT * FROM $this->appointmentsTable 
                  WHERE APPOINTMENT_EMPLOYEE_ID = ? AND DATE(APPOINTMENT_DATETIME) = ? AND APPOINTMENT_STATUS = 'Scheduled'";
        return $this->dbh->execute($query, [$dentistID, $today])->fetchAll();
    }

    // Get pending appointments
    public function pendingAppointments($dentistID)
    {
        $query = "SELECT * FROM $this->appointmentsTable 
                  WHERE APPOINTMENT_EMPLOYEE_ID = ? AND APPOINTMENT_STATUS = 'Scheduled'";
        return $this->dbh->execute($query, [$dentistID])->fetchAll();
    }

    public function updateDentistComment($appointmentID, $comment)
    {
        $query = "UPDATE $this->appointmentsTable 
                  SET APPOINTMENT_EMPLOYEE_COMMENT = ? 
                  WHERE APPOINTMENT_ID = ?";
        return $this->dbh->execute($query, [$comment, $appointmentID]);
    }

    public function sendMessage($patientID, $dentistID, $messageContent)
    {
        $query = "INSERT INTO messages (MESSAGE_PATIENT_ID, MESSAGE_EMPLOYEE_ID, MESSAGE_CONTENT, MESSAGE_SENDER, MESSAGE_TIMESTAMP)
                VALUES (?, ?, ?, 'employee', NOW())";
        
        try {
            return $this->dbh->execute($query, [$patientID, $dentistID, $messageContent]);
        } catch (Exception $e) {
            error_log("Error in sendMessage: " . $e->getMessage());
            return false; // Indicate failure
        }
    }


}
$myDB = new DB();
$Dentists = new Dentists($myDB);