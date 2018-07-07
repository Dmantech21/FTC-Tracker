<?php
    header("Content-type: application/json");
    session_start();

    $date = $_GET['date'];
    $eventName = $_GET['eventName'];

    $dbLocation = $_SESSION['location'];
    $dbUser = $_SESSION['dbUser'];
    $dbPassword = $_SESSION['dbPassword'];
    $dbName = $_SESSION['dbName'];

    $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);

    $conn->query("INSERT INTO Event (Id, Name, Date, CurrentMatch, Open)
        VALUES (
        null, '$eventName', '$date', 0, 0
        );");

    $results = $conn->query("SELECT * FROM Event 
        WHERE Name = '$eventName'");
    
    $row = $results->fetch_array(MYSQLI_ASSOC);

    $json = json_encode($row);
    echo($json);

    $conn->close();
?>