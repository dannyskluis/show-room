<?php
require_once("session_manager.php");
include 'db.php';

class Authentication
{

    public $dbh;
    public $patientsTable = "patients";
    public $employeeTable = "employees";

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
    }

    public function patientLogin($email, $password): bool
    {
        $stmt = $this->dbh->execute("SELECT * FROM $this->patientsTable WHERE PATIENT_EMAIL = ?", [$email]);
        $patient = $stmt->fetch();

        if ($patient && password_verify($password, $patient['PATIENT_PASSWORD'])) {

            $_SESSION['PATIENT_ID'] = $patient['PATIENT_ID'];
            return true;
        }

        return false;
    }
    public function employeeLogin($email, $password): bool
    {
        $stmt = $this->dbh->execute("SELECT * FROM $this->employeeTable WHERE EMPLOYEE_WORK_EMAIL = ?", [$email]);
        $employee = $stmt->fetch();

        if ($employee && password_verify($password, $employee['EMPLOYEE_PASSWORD'])) {

            $_SESSION['EMPLOYEE_ID'] = $employee['EMPLOYEE_ID'];
            return true;
        }

        return false;
    }

    public function patientRegister($PATIENT_FIRSTNAME, $PATIENT_LASTNAME, $PATIENT_EMAIL, $PATIENT_PHONENUMBER, $PATIENT_BIRTHDATE, $PATIENT_PASSWORD) {
        $query = 'insert into patients (PATIENT_FIRSTNAME, PATIENT_LASTNAME, PATIENT_EMAIL, PATIENT_PHONENUMBER, PATIENT_BIRTHDATE, PATIENT_PASSWORD) values (?,?,?,?,?,?)';
        return $this->dbh->execute($query, [$PATIENT_FIRSTNAME, $PATIENT_LASTNAME, $PATIENT_EMAIL, $PATIENT_PHONENUMBER, $PATIENT_BIRTHDATE, $PATIENT_PASSWORD]);
    }
}
$myDB = new DB();
$Authentication = new Authentication($myDB);
