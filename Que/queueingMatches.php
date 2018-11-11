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
        if ((!isset($_SESSION['logged_In']) || $_SESSION['logged_In'] == false) || (!isset($_SESSION['Role']) || $_SESSION['Role'] != 'Queuer')) {
            $_SESSION['timeout'] = null;
            header("Location: ../index.php");
        }
    }

    $dbLocation = $_SESSION['location'];
    $dbUser = $_SESSION['dbUser'];
    $dbPassword = $_SESSION['dbPassword'];
    $dbName = $_SESSION['dbName'];

    $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Queueing Matches</title>

    <link rel="stylesheet" type="text/css" href="../main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

    <main>
        <?php include '../headerBasic.php'; ?>
        <?php
            $results = $conn->query("SELECT * FROM EventMatch AS em JOIN Event AS e ON em.EventId = e.Id WHERE e.Open = 1 AND em.IsComplete = 0 ORDER BY em.MatchNumber ASC;");
            $matches = array();
            while($rs = $results->fetch_array(MYSQLI_ASSOC)) {
                $matches[] = $rs;
            }
            foreach($matches as $matchLoop) {

                echo('<div class="card">');
                    echo('<h2>Match ' . $matchLoop['MatchNumber'] . '</h2>');
                    //red1
                    echo('<div class="red team">');
                        echo('Red 1: ' . $matchLoop['Red1']);
                    echo('</div>');//end class red team
                    echo('<div class="check">');
                    if($matchLoop['Red1Queued'] == 1) {
                        echo('<img src="../images/icons8-checkmark-filled-100-white.png" class="checkImg" alt="check">');
                    } else {
                        echo('<button class="btnBlue btnBlue-fade" type="submit" onclick="queueTeam(\'Red1Queued\', ' . $matchLoop['MatchNumber'] . ', ' . $matchLoop['EventId'] . ')">Check In</button>');
                    }//end if Red1Queued
                    echo('</div>');//end check

                    //red2
                    echo('<div class="red team">');
                        echo('Red 2: ' . $matchLoop['Red2']);
                    echo('</div>');//end class red team
                    echo('<div class="check">');
                    if($matchLoop['Red2Queued'] == 1) {
                        echo('<img src="../images/icons8-checkmark-filled-100-white.png" class="checkImg" alt="check">');
                    } else {
                        echo('<button class="btnBlue btnBlue-fade" type="submit" onclick="queueTeam(\'Red2Queued\', ' . $matchLoop['MatchNumber'] . ', ' . $matchLoop['EventId'] . ')">Check In</button>');
                    }//end if Red2Queued
                    echo('</div>');//end check

                    //blue1
                    echo('<div class="blue team">');
                        echo('Blue 1: ' . $matchLoop['Blue1']);
                    echo('</div>');//end class blue team
                    echo('<div class="check">');
                    if($matchLoop['Blue1Queued'] == 1) {
                        echo('<img src="../images/icons8-checkmark-filled-100-white.png" class="checkImg" alt="check">');
                    } else {
                        echo('<button class="btnBlue btnBlue-fade" type="submit" onclick="queueTeam(\'Blue1Queued\', ' . $matchLoop['MatchNumber'] . ', ' . $matchLoop['EventId'] . ')">Check In</button>');
                    }//end if Blue1Queued
                    echo('</div>');//end check

                    //blue2
                    echo('<div class="blue team">');
                        echo('Blue 2: ' . $matchLoop['Blue2']);
                    echo('</div>');//end class blue team
                    echo('<div class="check">');
                    if($matchLoop['Blue2Queued'] == 1) {
                        echo('<img src="../images/icons8-checkmark-filled-100-white.png" class="checkImg" alt="check">');
                    } else {
                        echo('<button class="btnBlue btnBlue-fade" type="submit" onclick="queueTeam(\'Blue2Queued\', ' . $matchLoop['MatchNumber'] . ', ' . $matchLoop['EventId'] . ')">Check In</button>');
                    }//end if Blue2Queued
                    echo('</div>');//end check

                    //completeMatch
                    echo('<div class="completeMatch">');
                        echo('<button class="btnBlue btnBlue-fade" type="submit">Complete Match</button>');
                    echo('</div>');//end completeMatch

                echo('</div>');//end div card

            }//end foreach loop
        ?>
    </main>

</body>
</html>

<script>

    function queueTeam(attribute, matchNumber, eventId) {
        $.get(`./updateMatch.php?matchNumber=${matchNumber}&attribute=${attribute}&eventId=${eventId}`, function(result) {
            window.location.reload();
        });
    }

    function completeMatch(eventId, matchNumber) {
        $.get(`./completeMatch.php?matchNumber=${matchNumber}&eventId=${eventId}`, function(result) {
            window.location.reload();
        });
    }
</script>
