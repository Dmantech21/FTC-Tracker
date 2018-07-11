<?php
    header("Content-type: application/json");
    session_start();

    $red1 = $_GET['red1'];
    $red2 = $_GET['red2'];
    $blue1 = $_GET['blue1'];
    $blue2 = $_GET['blue2'];
    $matchNumber = $_GET['matchNumber'];
    $eventId = $_GET['eventId'];

    $dbLocation = $_SESSION['location'];
    $dbUser = $_SESSION['dbUser'];
    $dbPassword = $_SESSION['dbPassword'];
    $dbName = $_SESSION['dbName'];

    $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);

    $conn->query("INSERT INTO  EventMatch (Id, Red1, Red2, Blue1, Blue2, Red1Queued, Red2Queued, Blue1Queued, Blue2Queued, RedScore, BlueScore, MatchNumber, IsComplete, EventId)
        VALUES (
        null, $red1, $red2, $blue1, $blue2, 0, 0, 0, 0, 0, 0, $matchNumber, 0, $eventId
        );");
    
    echo("{}");
    $conn->close();
?>