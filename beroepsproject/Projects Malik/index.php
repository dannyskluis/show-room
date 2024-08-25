<?php

$host = "localhost:3306";
$dbname = "nextlogic";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] == "logHours") {
        logHours($pdo);
    } elseif ($_POST["action"] == "markProjectAsDeleted") {
        $projectIdToDelete = $_POST["projectIdToDelete"];
        markProjectAsDeleted($pdo, $projectIdToDelete);
    } elseif ($_POST["action"] == "markUserAsDeleted") {
        $userIdToDelete = $_POST["userIdToDelete"];
        markUserAsDeleted($pdo, $userIdToDelete);
    }
}


function logHours($pdo) {
    $projectCode = $_POST["projectSelect"];
    $logDate = $_POST["logDate"];
    $hoursWorked = $_POST["hoursWorked"];
    $comments = $_POST["comments"];

    $stmt = $pdo->prepare("SELECT ID FROM projects WHERE Code = :code");
    $stmt->bindParam(":code", $projectCode);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $projectID = $row["ID"];
        $userID = 1; 

        $stmt = $pdo->prepare("INSERT INTO loggedhours (ProjectID, UserID, LogDate, HoursWorked, Comments)
                               VALUES (:projectID, :userID, :logDate, :hoursWorked, :comments)");

        $stmt->bindParam(":projectID", $projectID);
        $stmt->bindParam(":userID", $userID);
        $stmt->bindParam(":logDate", $logDate);
        $stmt->bindParam(":hoursWorked", $hoursWorked);
        $stmt->bindParam(":comments", $comments);

        $stmt->execute();

        echo "Hours logged successfully!";
    } else {
        echo "Project not found!";
    }
}


function markProjectAsDeleted($pdo, $projectId) {
    $stmt = $pdo->prepare("UPDATE projects SET Active = 0 WHERE ID = :projectId");
    $stmt->bindParam(":projectId", $projectId);
    $stmt->execute();
    echo "Project marked as deleted successfully!";
}

function markUserAsDeleted($pdo, $userId) {
    $stmt = $pdo->prepare("UPDATE users SET Active = 0 WHERE ID = :userId");
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();
    echo "User marked as deleted successfully!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Hours</title>
</head>
<body>
<style>
        body {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 20px;
        }

        h2 {
            color: #007BFF;
        }

        form {
            width: 40%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        select,
        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            width: 40%;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }

        h1 {
            color: #007BFF;
        }
        .centerr{
            width: 40%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            
        }
        </style>
    <h2>Log Hours</h2>
    

    <form action="" method="post">
        <input type="hidden" name="action" value="logHours">
        <label for="projectSelect">Select Project:</label>
        <select name="projectSelect" required>
            <?php
            $stmt = $pdo->prepare("SELECT ID, ActualTitle FROM projects WHERE Active = 1");
            $stmt->execute();
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($projects as $project) {
                echo "<option value='{$project['Code']}'>{$project['ActualTitle']}</option>";
            }
            ?>
        </select><br>

        <label for="logDate">Log Date:</label>
        <input type="date" name="logDate" required><br>

        <label for="hoursWorked">Hours Worked:</label>
        <input type="number" name="hoursWorked" step="0.5" required><br>

        <label for="comments">Comments:</label>
        <textarea name="comments"></textarea><br>

        <input type="submit" value="Submit">
    </form>

    <form action="" method="post">
        <input type="hidden" name="action" value="markProjectAsDeleted">
        <label for="projectIdToDelete">Project ID to Delete:</label>
        <input type="number" name="projectIdToDelete" required>
        <input type="submit" value="Mark Project as Deleted">
    </form>


    <form action="" method="post">
        <input type="hidden" name="action" value="markUserAsDeleted">
        <label for="userIdToDelete">User ID to Delete:</label>
        <input type="number" name="userIdToDelete" required>
        <input type="submit" value="Mark User as Deleted">
    </form>
<div class="centerr">
    <h1>Projecten:</h1>
    <ul>
        <?php
        $stmt = $pdo->prepare("SELECT * FROM projects WHERE Active = 1");
        $stmt->execute();
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($projects as $project) {
            echo "<li>{$project['ActualTitle']} (Code: {$project['Code']})</li>";
        }
        ?>
    </ul>

    <h1>Users:</h1>
    <ul>
        <?php
        $stmt = $pdo->prepare("SELECT * FROM users WHERE Active = 1");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            echo "<li>{$user['Name']} (ID: {$user['ID']})</li>";
        }
        ?>
    </ul>
</div>
</body>
</html>

