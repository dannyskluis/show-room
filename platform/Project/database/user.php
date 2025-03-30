<?php

require 'db.php';
class User {

    public $table = 'zzprs';
    public $clients = 'clients';
    public $project = 'projects';

    public $dbh;

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
        session_start();
    }

    // function to hash password
    public function hash($password) : string 
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function generateCsrfToken() : string
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    // function that gets one zzpr from the id
    public function onezzpr($id) : array 
    {
        return $this->dbh->run("SELECT * from $this->table where zzpr_id = $id")->fetch();
    }

    public function oneclient($id) : array 
    {
        return $this->dbh->run("SELECT * from $this->clients where client_id = $id")->fetch();
    }
    public function editClient($firstname,$lastname,$email,$phone_number, $id) 
    {
        return $this->dbh->run("UPDATE $this->clients SET firstname='$firstname', lastname='$lastname', email='$email', phone_number ='$phone_number' WHERE client_id = $id");
    }

    public function editProject($project_name,$start_date,$end_date,$hourly_rate, $project_status,$id) 
    {
        return $this->dbh->run("UPDATE $this->project SET project_name='$project_name', start_date='$start_date', end_date='$end_date', hourly_rate ='$hourly_rate', project_status='$project_status' WHERE project_id = $id");
    }

    // function to get all the projects that from now till 30 days that are in progress  or not started yet
    public function getProjectsInProgress($startDate, $endDate): array
    {
        try {
            $stmt = $this->dbh->run("SELECT * FROM projects WHERE start_date <= ? AND end_date >= ?", [$endDate, $startDate]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            die("Query error: " . $e->getMessage());
        }
    }
    public function allProjects($id) : array 
    {
        return $this->dbh->run("SELECT * from $this->project where zzpr_id = $id")->fetchAll();
    }
    public function oneProject($id) : array 
    {
        return $this->dbh->run("SELECT * from $this->project where project_id = $id")->fetch();
    }

        public function getClientsForLoggedInZZP($zzpId)
    {
        // Voer een query uit om alle clients op te halen die gekoppeld zijn aan projecten van de ingelogde ZZP'er
        $query = "SELECT DISTINCT c.* 
                FROM clients c
                JOIN projects p ON c.client_id = p.client_id
                WHERE p.zzpr_id = :zzpId";

        // Gebruik parameterbinding om SQL-injectie te voorkomen
        $params = [':zzpId' => $zzpId];

        // Voer de query uit en haal de resultaten op
        $result = $this->dbh->run($query, $params)->fetchAll();

        // Retourneer de resultaten als een array
        return $result;
    }


    public function deleteproject($project_id) {
        $this->dbh->run("DELETE FROM $this->project WHERE project_id = ?", [$project_id]);
    }

    // function to login user
    public function login($email, $password): bool
    {
        try {
            $stmt = $this->dbh->run("SELECT * FROM $this->table WHERE email = ?", [$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['zzpr_id'] = $user['zzpr_id'];
                return true;
            }
        } catch (PDOException $e) {
            die("Login error: " . $e->getMessage());
        }

        return false;
    }

    // function that per page needs to check if the zzper is logged in
    public function isLoggedIn(): bool
    {
        return isset($_SESSION['zzpr_id']);
    }

    public function logout() : void
    {
        session_destroy();
        session_start();
    }
    public function deleteclient($client_id) {
        $this->dbh->run("DELETE FROM $this->clients WHERE client_id = ?", [$client_id]);
    }

}

$db = new DB();
$user = new User($db);
