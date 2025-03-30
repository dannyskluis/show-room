<?php
require_once("session_manager.php");
require_once('db.php');

class Education
{

    public $dbh;
    public $videoTable = "education_video";
    public $articleTable = "education_articles";
    public $questionsTable = "education_questions";
    public $downloadTable = "education_downloadable";

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
    }

    // Method to fetch all videos
    public function getVideos()
    {
        $sql = "SELECT * FROM $this->videoTable";
        $stmt = $this->dbh->execute($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to fetch all articles
    public function getArticles()
    {
        $sql = "SELECT * FROM $this->articleTable";
        $stmt = $this->dbh->execute($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to fetch all downloadable resources
    public function getDownloads()
    {
        $sql = "SELECT * FROM $this->downloadTable";
        $stmt = $this->dbh->execute($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to fetch all FAQ questions and answers
    public function getQuestions()
    {
        $sql = "SELECT * FROM $this->questionsTable";
        $stmt = $this->dbh->execute($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
$myDB = new DB();
$Education = new Education($myDB);
