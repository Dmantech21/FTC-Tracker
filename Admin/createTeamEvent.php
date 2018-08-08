<?php
    header("Content-type: application/json");
    session_start();

    $teamId = $_GET['teamId'];
    $eventId = $_GET['eventId'];

    $dbLocation = $_SESSION['location'];
    $dbUser = $_SESSION['dbUser'];
    $dbPassword = $_SESSION['dbPassword'];
    $dbName = $_SESSION['dbName'];

    $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);

    $conn->query("INSERT INTO TeamEvent (EventId, TeamId, IsCheckedIn, PassedRobotInspection, PassedFieldInspection, ReadyForJudging)
        VALUES (
        $eventId, $teamId, 0, 0, 0, 0
        );");

    echo("{}");

    $conn->close();
?>