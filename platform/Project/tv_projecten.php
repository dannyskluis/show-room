<?php

include 'database/db.php';

$db = new DB();

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $zzpr_id = $_POST['zzpr_id'];
    $project_name = $_POST['project_name'];
    $client_id = $_POST['client_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $hourly_rate = $_POST['hourly_rate'];
    $project_status = $_POST['project_status'];

    // Define the SQL query
    $query = "INSERT INTO projects (zzpr_id, project_name, client_id, start_date, end_date, hourly_rate, project_status) 
              VALUES (:zzpr_id, :project_name, :client_id, :start_date, :end_date, :hourly_rate, :project_status)";

    // Bind parameters
    $args = array(
        ':zzpr_id' => $zzpr_id,
        ':project_name' => $project_name,
        ':client_id' => $client_id,
        ':start_date' => $start_date,
        ':end_date' => $end_date,
        ':hourly_rate' => $hourly_rate,
        ':project_status' => $project_status
    );

    // Execute the query
    $result = $db->run($query, $args);

    // Check if the query was successful
    if ($result) {
        echo "Data inserted successfully!";
    } else {
        echo "Error inserting data.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style/tv_projecten.css">
    <link rel="stylesheet" href="style/universal.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">

    <script src="JavaScript/header.js" defer></script>
    <script src="JavaScript/footer.js" defer></script>
</head>

<body>
    <header id="navbar"></header><br>

    <form action="" method="post">
        <input type="number" name="zzpr_id" placeholder="zzpr_id"><br><br>
        <input type="text" name="project_name" placeholder="project_name"><br><br>
        <input type="number" name="client_id" placeholder="client_id"><br><br>
        <input type="date" name="start_date" placeholder="start_date"><br><br>
        <input type="date" name="end_date" placeholder="end_date"><br><br>
        <input type="number" name="hourly_rate" placeholder="hourly_rate"><br><br>
        <select name="project_status">
            <option value="Planned">project status</option>
            <option value="Planned">Planned</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
        </select><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
    <br>
    <footer id="footerbar"></footer>
</body>

</html>