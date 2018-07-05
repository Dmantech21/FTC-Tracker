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
            header("Location: ../../index.php");
        } else {
            $_SESSION['timeout'] = time();
            if ((!isset($_SESSION['logged_In']) || $_SESSION['logged_In'] == false) || (!isset($_SESSION['Role']) || $_SESSION['Role'] == 'Admin' || $_SESSION['Role'] == 'Guest')) {
                $_SESSION['timeout'] = null;
                header("Location: ../../index.php");
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
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        <div id="header">
            <div class="header-content">
                <div class="header-title">
                    <h1>FTC-Competition Tracker</h1>
                </div>
                <div class="header-right">
                    <h4> Beta Testing</h4>
                    <h4><?php echo($role);?></h4>
                </div>
            </div>
        </div>

        <div>
            <select id="teams">
                <option value="" disabled selected>Select Team</option>
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
                    $results = $conn->query("SELECT * FROM TeamEvent WHERE" . $attribute . "= 0;");
                    $events = array();
                    while ($rs = $results->fetch_array(MYSQLI_ASSOC)) {
                        echo ("<option value='{\"Id\": " . $rs["Id"] . ", \"Name\": \"" . $rs["Name"] .  "\", \"Date\": \"" . $rs["Date"] . "\", \"CurrentMatch\":" . $rs["CurrentMatch"] . "}'>" . $rs["Name"] . "</option>");
                        $events[] = $rs;
                    }
                ?>
            </select>
            <button class="button select" onclick="loadCompetition()"> Select Competition </button>
        </div>
        <script>
            function updateTeamAtCompetition() {
                // let competition = JSON.parse($('#competitions option:selected').val())
                // let competitionId = competition.Id;
                // $.get(`./getTeamsAtCompetition.php?competitionId=${competitionId}`, function(result) {
                //     let teams = result;
                //     console.log(teams)
                //     let children = $("#competitionTeams")[0].children;
                //     for(let team of selectedTeams) {
                //         if($(`#${team.TeamId}`).length > 0) {
                //             $(`#${team.TeamId}`)[0].checked = true;
                //         }
                //     };
                // });

                // $('#editEventDate').val(competition.Date);
                // $('#editEventName').val(competition.Name);

                // let newDate = $('#editEventDate').val();
                // let newName = $('#editEventName').val();
            }
        </script>
    </body>
</html> 