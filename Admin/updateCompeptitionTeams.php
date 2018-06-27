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

    $result = $conn->query("SELECT * From TeamEvent WHERE TeamId = $teamId AND EventId = $eventId);");

    $rows = mysql_num_rows($result);

    if ($rows == 0)
    {
        $conn->query("INSERT INTO TeamEvent (EventId, TeamId)
            VALUES (
            $eventId, $teamId
            );");
    }
    
    echo("{}");

    $conn->close();
?>