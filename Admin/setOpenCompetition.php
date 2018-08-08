<?php
    header("Content-type: application/json");
    session_start();

    $eventId = $_GET['eventId'];

    $dbLocation = $_SESSION['location'];
    $dbUser = $_SESSION['dbUser'];
    $dbPassword = $_SESSION['dbPassword'];
    $dbName = $_SESSION['dbName'];

    $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);

    $conn->query("UPDATE Event SET Open = 0;");

    $conn->query("UPDATE Event 
        SET Open = 1
        WHERE Id = '$eventId'");

    echo("{}");

    $conn->close();
?>