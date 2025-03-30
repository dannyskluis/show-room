<?php
require_once("session_manager.php");
require_once("db.php");

class Patients
{
    public $dbh;
    public $patientsTable = "patients";
    public $appointmentsTable = "appointments";
    public $employeeTable = "employees";

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
    }

    // Get data for one patient based on the patient ID
    public function onePatient($id)
    {
        $query = "SELECT * FROM $this->patientsTable WHERE PATIENT_ID = ?";
        return $this->dbh->execute($query, [$id])->fetch();
    }

    // Update patient profile
    public function updatePatient($patientID, $firstname, $lastname, $email, $phonenumber, $birthdate, $password)
    {
        $query = "UPDATE $this->patientsTable 
                  SET PATIENT_FIRSTNAME = ?, PATIENT_LASTNAME = ?, PATIENT_EMAIL = ?, PATIENT_PHONENUMBER = ?, PATIENT_BIRTHDATE = ?,PATIENT_PASSWORD = ?
                  WHERE PATIENT_ID = ?";
        
        return $this->dbh->execute($query, [$firstname, $lastname, $email, $phonenumber, $birthdate, $password, $patientID]);
    }

    // Validate and process edit form submission
    public function validateAndProcessEditForm($formData, $patientID)
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
            $password = $this->getCurrentPassword($patientID);
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        $updateSuccessful = $this->updatePatient($patientID, $firstname, $lastname, $email, $phonenumber, $birthdate, $password);

        if ($updateSuccessful) {
            header("Location: ../Patienten_Platform/profielbeheer.php");
            exit();
        } else {
            return "Failed to update profile. Please try again.";
        }
    }

    // Retrieve the current password from the database
    public function getCurrentPassword($patientID)
    {
        $query = "SELECT PATIENT_PASSWORD FROM $this->patientsTable WHERE PATIENT_ID = ?";
        $result = $this->dbh->execute($query, [$patientID])->fetch();
        return $result['PATIENT_PASSWORD'];
    }

    public function allPatients() {
        return $this->dbh->execute("SELECT * from $this->patientsTable")->fetchAll();
    }

    public function appointmentsOfPatient($id) {
        $query = "SELECT a.*, p.PATIENT_FIRSTNAME, p.PATIENT_LASTNAME, 
                         d.EMPLOYEE_FIRSTNAME, d.EMPLOYEE_LASTNAME
                  FROM $this->appointmentsTable a
                  JOIN $this->patientsTable p ON a.APPOINTMENT_PATIENT_ID = p.PATIENT_ID
                  JOIN $this->employeeTable d ON a.APPOINTMENT_EMPLOYEE_ID = d.EMPLOYEE_ID
                  WHERE a.APPOINTMENT_PATIENT_ID = ?
                  ORDER BY a.APPOINTMENT_DATETIME DESC";
        return $this->dbh->execute($query, [$id])->fetchAll();
    }

    public function oneAppointmentOfPatient($appointmentID, $patientID)
    {
        $query = "SELECT a.*, p.PATIENT_FIRSTNAME, p.PATIENT_LASTNAME, 
                         d.EMPLOYEE_FIRSTNAME, d.EMPLOYEE_LASTNAME
                  FROM $this->appointmentsTable a
                  JOIN $this->patientsTable p ON a.APPOINTMENT_PATIENT_ID = p.PATIENT_ID
                  JOIN $this->employeeTable d ON a.APPOINTMENT_EMPLOYEE_ID = d.EMPLOYEE_ID
                  WHERE a.APPOINTMENT_ID = ? AND a.APPOINTMENT_PATIENT_ID = ?";
        return $this->dbh->execute($query, [$appointmentID, $patientID])->fetch();
    } 
    
}

$myDB = new DB();
$Patients = new Patients($myDB);
