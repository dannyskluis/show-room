<?php
require_once("session_manager.php");
require_once("db.php");

class Review
{
    private $dbh;
    private $employeeTable = "employees";
    private $appointmentsTable = "appointments";
    private $reviewTable = "employee_reviews";
    private $patientsTable = "patients";

    // Constructor accepts the DB instance
    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh; // Use DB class instance
    }

    // Method to insert a new review into the database
    public function addReview($dentist_id, $patient_id, $appointment_id, $rating, $review_text = '', $review_date)
    {
        try {
            // SQL query to insert review data into the employee_reviews table
            $sql = "INSERT INTO $this->reviewTable 
                    (REVIEW_PATIENT_ID, REVIEW_APPOINTMENT_ID, REVIEW_DATE, RATING, REVIEW_TEXT) 
                    VALUES (:patient_id, :appointment_id, :review_date, :rating, :review_text)";

            // Use the DB class's execute method to insert the data
            $this->dbh->execute($sql, [
                ':patient_id' => $patient_id,
                ':appointment_id' => $appointment_id,
                ':review_date' => $review_date,
                ':rating' => $rating,
                ':review_text' => $review_text
            ]);

            return true; // Review successfully added
        } catch (PDOException $e) {
            // Log or print error if the insertion fails
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

// Instantiate the DB and Review classes
$myDB = new DB('php_dentalpractice'); // Database name specified here
$Review = new Review($myDB);
?>
