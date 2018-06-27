<?php
    header("Content-type: application/json");
    session_start();

    $dbLocation = $_SESSION['location'];
    $dbUser = $_SESSION['dbUser'];
    $dbPassword = $_SESSION['dbPassword'];
    $dbName = $_SESSION['dbName'];

    $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);
    $competitionId = $_GET['competitionId'];
    $competitionDate = $_GET['competitionDate'];
    $competitionName = $_GET['competitionName'];
    $currentMatch = $_GET['currentMatch'];

    $results = $conn->query("UPDATE Event SET Name = '$competitionName', Date = '$competitionDate', CurrentMatch = $currentMatch
                             WHERE Id = $competitionId");

    echo("{}");
?>