<?php
    header("Content-type: application/json");
    session_start();

    $eventId = $_GET['eventId'];
    $matchNumber = $_GET['matchNumber'];
    $attribute = $_GET['attribute'];

    $dbLocation = $_SESSION['location'];
    $dbUser = $_SESSION['dbUser'];
    $dbPassword = $_SESSION['dbPassword'];
    $dbName = $_SESSION['dbName'];

    $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);

    $result = $conn->query("UPDATE EventMatch SET $attribute = 1 WHERE MatchNumber = $matchNumber AND EventId = $eventId;");

    echo("{}");

    $conn->close();
    //Written by Dylan Mangold
?>
