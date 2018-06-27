<?php
    header("Content-type: application/json");
    session_start();

    $dbLocation = $_SESSION['location'];
    $dbUser = $_SESSION['dbUser'];
    $dbPassword = $_SESSION['dbPassword'];
    $dbName = $_SESSION['dbName'];

    $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);
    $competitionId = $_GET['competitionId'];

    $results = $conn->query("SELECT * FROM TeamEvent WHERE EventId =  $competitionId");
    
    $teams = array();
    while($rs = $results->fetch_array(MYSQLI_ASSOC)) {
        $teams[] = $rs;
    }

    $json = json_encode($teams);
    echo($json);
?>