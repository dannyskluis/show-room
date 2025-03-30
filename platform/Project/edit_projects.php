<?php
require 'database/user.php';
$zzpId = $_SESSION['zzpr_id'];
$id = intval($_GET['id']);
$project = $user->oneProject($id);

if (isset($_POST['submit'])) {
    $project_name = $_POST["project_name"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $hourly_rate = $_POST["hourly_rate"];
    $project_status = $_POST["project_status"];
    $user = $user->editProject($project_name, $start_date, $end_date, $hourly_rate, $project_status, $id);
    header("location:projects.php");
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
    <form method="POST">
        <label for="project_name">Project name:</label><br>
        <input type="text" name="project_name" value="<?php echo $project['project_name']; ?>"><br><br>
        <label for="start_date">Start Date:</label><br>
        <input type="date" name="start_date" value="<?php echo $project['start_date']; ?>"><br><br>
        <label for="end_date">End Date:</label><br>
        <input type="date" name="end_date" value="<?php echo $project['end_date']; ?>"><br><br>
        <label for="hourly_rate">Hourly Rate:</label><br>
        <input type="int" name="hourly_rate" value="<?php echo $project['hourly_rate']; ?>"><br><br>
        <label for="project_status">Project Status:</label><br>
        <select name="project_status">
        <option value="Planned">Planned</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
        </select>
            <input type="submit" id="submit" name="submit">
    </form>
</body>

</html>