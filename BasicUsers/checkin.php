<!DOCTYPE html>
<html lang="en">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./checkin.css">
    <?php
        session_start();
        if ($_SESSION['timeout'] + 600 < time()) {
            $_SESSION['logged_In'] = false;
            $_SESSION['userName'] = null;
            $_SESSION['Role'] = null;
            $_SESSION['timeout'] = null;
            header("Location: ../index.php");
        } else {
            $_SESSION['timeout'] = time();
            if ((!isset($_SESSION['logged_In']) || $_SESSION['logged_In'] == false) || (!isset($_SESSION['Role']) || $_SESSION['Role'] == 'Admin' || $_SESSION['Role'] == 'Guest')) {
                $_SESSION['timeout'] = null;
                header("Location: ../index.php");
            }
        }

        $dbLocation = $_SESSION['location'];
        $dbUser = $_SESSION['dbUser'];
        $dbPassword = $_SESSION['dbPassword'];
        $dbName = $_SESSION['dbName'];
        $role = $_SESSION['Role'];

        $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);
    ?>
    <head>
        <title>FTC-Competition Tracker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div id="header"></div>
        <div class="center">
            <?php
                $result = $conn->query("SELECT Id FROM Event WHERE Open = 1;");
                $rs = $result->fetch_array(MYSQLI_ASSOC);
                $competitionId = $rs["Id"];
            ?>
            <select id="teams">
                <option value="" disabled selected>Select Team</option>teams
                <?php
                    if($role === 'RobotInspector') {
                        $attribute = 'PassedRobotInspection';
                    } else if ($role === 'FieldInspector') {
                        $attribute = 'PassedFieldInspection';
                    } else if ($role === 'Receptionist') {
                        $attribute = 'IsCheckedIn';
                    } else if ($role === 'Judging') {
                        $attribute = 'ReadyForJudging';
                    } else {
                        $attribute = '1';
                    }

                    $results = $conn->query("SELECT Team.TeamNumber, Team.Name FROM TeamEvent JOIN (Team, Event) ON (Team.TeamNumber = TeamEvent.TeamId AND TeamEvent.EventId = Event.Id) WHERE Event.Open = 1 AND TeamEvent." . $attribute . " = 0;");
                    $teams = array();
                    while ($rs = $results->fetch_array(MYSQLI_ASSOC)) {
                        echo ("<option value='" . $rs["TeamNumber"] . "'>" .  $rs["TeamNumber"] . " - " . $rs["Name"] . "</option>");
                        $teams[] = $rs;
                    }  
                ?>
            </select>
            <button class="button select" onclick="updateTeamAtEvent()"> Approve Team </button>
        </div>
        <script>
            $('#header').load('../header.php');

            function updateTeamAtEvent() {
                let team = $('#teams option:selected').val();
                $.get(`./updateTeamAtCompetition.php?competitionId=<?php echo($competitionId)?>&teamId=${team}&attribute=<?php echo($attribute)?>`, function(result) {
                    window.location.reload();
                });
            }
        </script>
    </body>
</html> 
