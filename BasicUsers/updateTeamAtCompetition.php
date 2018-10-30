<?php
    session_start();
    header("Content-type: application/json");

    $eventId = $_GET['competitionId'];
    $teamId = $_GET['teamId'];
    $attribute = $_GET['attribute'];

    $dbLocation = $_SESSION['location'];
    $dbUser = $_SESSION['dbUser'];
    $dbPassword = $_SESSION['dbPassword'];
    $dbName = $_SESSION['dbName'];

    $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);

    $result = $conn->query("UPDATE TeamEvent SET $attribute = 1 WHERE TeamId = $teamId AND EventId = $eventId;");

    echo("{}");

    $conn->close();
?>
