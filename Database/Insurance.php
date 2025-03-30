<?php
require_once("session_manager.php");
require_once("db.php");

class Insurance
{
    public $dbh;
    public $insuranceTable = "insurance_details";

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
    }

    // Get all the insurance information for a user by their patient ID
    public function oneInsurance($id)
    {
        $result = $this->dbh->execute("SELECT * FROM $this->insuranceTable WHERE INSURANCE_ID = ?", [$id])->fetch();

        if (!$result) {
            return [
                'INSURANCE_PROVIDER' => '',
                'POLICY_NUMBER' => '',
                'COVERAGE_DETAILS' => '',
                'INSURANCE_START_DATE' => '',
                'INSURANCE_EXPIRY_DATE' => ''
            ];
        }

        return $result;
    }

    // Update the insurance information for a user by their patient ID
    public function updateInsurance($patientID, $provider, $policyNumber, $coverageDetails, $startDate, $endDate)
    {
        $query = "UPDATE $this->insuranceTable 
                  SET INSURANCE_PROVIDER = ?, POLICY_NUMBER = ?, COVERAGE_DETAILS = ?, INSURANCE_START_DATE = ?, INSURANCE_EXPIRY_DATE = ?
                  WHERE INSURANCE_ID = ?";
        return $this->dbh->execute($query, [$provider, $policyNumber, $coverageDetails, $startDate, $endDate, $patientID]);
    }

    // Insert new insurance details
    public function insertInsurance($patientID, $provider, $policyNumber, $coverageDetails, $startDate, $expiryDate)
    {
        $query = "INSERT INTO $this->insuranceTable (INSURANCE_PATIENT_ID, INSURANCE_PROVIDER, POLICY_NUMBER, COVERAGE_DETAILS, INSURANCE_START_DATE, INSURANCE_EXPIRY_DATE)
                  VALUES (?, ?, ?, ?, ?, ?)";
        
        return $this->dbh->execute($query, [$patientID, $provider, $policyNumber, $coverageDetails, $startDate, $expiryDate]);
    }

    // Validate and process the insurance form
    public function validateAndProcessEditInsuranceForm($formData, $patientID)
    {
        $provider = $formData['provider'];
        $policyNumber = $formData['policynumber'];
        $coverageDetails = $formData['coveragedetails'];
        $startDate = $formData['insurancestartdate'];
        $endDate = $formData['insuranceenddate'];

        if (empty($provider) || empty($policyNumber) || empty($coverageDetails) || empty($startDate) || empty($endDate)) {
            return "All fields are required.";
        }

        if ($endDate < $startDate) {
            return "End date cannot be before the start date.";
        }

        $insuranceDetails = $this->oneInsurance($patientID);

        if (!empty($insuranceDetails['INSURANCE_PROVIDER'])) {
            $updateSuccessful = $this->updateInsurance($patientID, $provider, $policyNumber, $coverageDetails, $startDate, $endDate);
        } else {
            $updateSuccessful = $this->insertInsurance($patientID, $provider, $policyNumber, $coverageDetails, $startDate, $endDate);
        }

        if ($updateSuccessful) {
            header("Location: ../Patienten_Platform/profielbeheer.php");
            exit();
        } else {
            return "Failed to update insurance information. Please try again.";
        }
    }
}

$myDB = new DB();
$Insurance = new Insurance($myDB);
