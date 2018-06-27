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

    $conn->query("DELETE FROM `TeamEvent` WHERE TeamId = $teamId AND EventId = $eventId;");

    echo("{\"DELETE FROM `TeamEvent` WHERE TeamId = $teamId AND EventId = $eventId;\"}");

    $conn->close();
?>