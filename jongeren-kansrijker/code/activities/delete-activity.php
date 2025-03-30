<?php
include "ActiviteitenBeheer.php";

if (isset($_GET['id'])) {
    $activiteitenBeheer = new ActiviteitenBeheer();
    $activiteitenBeheer->verwijderActiviteit($_GET['id']);
    header("Location: activities.php");
    exit;
}
?>
