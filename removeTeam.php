<?php
    header("Content-type: application/json");
    session_start();

    $teamNumber = $_GET['teamNumber'];

    $dbLocation = $_SESSION['location'];
    $dbUser = $_SESSION['dbUser'];
    $dbPassword = $_SESSION['dbPassword'];
    $dbName = $_SESSION['dbName'];

    $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);

    $conn->query("DELETE FROM Team WHERE TeamNumber = $teamNumber");
    
    echo("{}");
    $conn->close();
?>