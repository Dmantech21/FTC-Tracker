<?php
    header("Content-type: application/json");
    session_start();

    $teamNumber = $_GET['teamNumber'];
    $teamName = $_GET['teamName'];

    $dbLocation = $_SESSION['location'];
    $dbUser = $_SESSION['dbUser'];
    $dbPassword = $_SESSION['dbPassword'];
    $dbName = $_SESSION['dbName'];

    $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);

    $conn->query("INSERT INTO  Team (TeamNumber, Name)
        VALUES (
        $teamNumber, '$teamName'
        );");
    
    echo("{}");
    $conn->close();
?>