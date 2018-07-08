<!DOCTYPE html>
<html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
    ?>
    <head>
        <title>FTC-Competition Tracker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="queueing.css">
    </head>
    <body>
        <div id="header"></div>
        <table class="tableBodyScroll">
            <thead>
                <tr>
                    <th style="text-align:center;">Match Number</th>
                    <th style="text-align:center;">Red 1</th>
                    <th style="text-align:center;">Red 2</th>
                    <th style="text-align:center;">Blue 1</th>
                    <th style="text-align:center;">Blue 2</th>
                    <th style="text-align:center;">Complete Match</th>
                </tr>
                <?php
                    session_start();

                    $dbLocation = $_SESSION['location'];
                    $dbUser = $_SESSION['dbUser'];
                    $dbPassword = $_SESSION['dbPassword'];
                    $dbName = $_SESSION['dbName'];
            
                    $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);
                    
                    $results = $conn->query("SELECT * FROM EventMatch AS em JOIN Event AS e ON em.EventId = e.Id WHERE e.Open = 1 AND em.IsComplete = 0 ORDER BY em.MatchNumber ASC;");
                    $matches = array();
                    while($rs = $results->fetch_array(MYSQLI_ASSOC)) {
                        $matches[] = $rs;
                    }
            
                    foreach($matches as $match) {
                        echo('<tr>'
                                .'<td>' . $match['MatchNumber'] . '</td>');
            
                        if($match['Red1Queued'] == 1) {
                            echo('<td>' . $match["Red1"] . '<div><i class="material-icons" >check_circle</i></div></td>');
                        } else {
                            echo('<td>' . $match["Red1"] . '<div><button type="submit" class="button select save" onclick="queueTeam(\'Red1Queued\', ' . $match['MatchNumber'] . ', ' . $match['EventId'] . ')">Check in</button></div></td>'); 
                        }
            
                        if($match['Red2Queued'] == 1) {
                            echo('<td>' . $match["Red2"] . '<div><i class="material-icons" >check_circle</i></div></td>');
                        } else {
                            echo('<td>' . $match["Red2"] . '<div><button type="submit" class="button select save" onclick="queueTeam(\'Red2Queued\', ' . $match['MatchNumber'] . ', ' . $match['EventId'] . ')">Check in</button></div></td>'); 
                        }
            
                        if($match['Blue1Queued'] == 1) {
                            echo('<td>' . $match["Blue1"] . '<div><i class="material-icons" >check_circle</i></div></td>');
                        } else {
                            echo('<td>' . $match["Blue1"] . '<div><button type="submit" class="button select save" onclick="queueTeam(\'Blue1Queued\', ' . $match['MatchNumber'] . ', ' . $match['EventId'] . ')">Check in</button></div></td>'); 
                        }
            
                        if($match['Blue2Queued'] == 1) {
                            echo('<td>' . $match["Blue2"] . '<div><i class="material-icons" >check_circle</i></div></td>');
                        } else {
                            echo('<td>' . $match["Blue2"] . '<div><button type="submit" class="button select save" onclick="queueTeam(\'Blue2Queued\', ' . $match['MatchNumber'] . ', ' . $match['EventId'] . ')">Check in</button></div></td>'); 
                        }
                            echo('<td align="center"><button type="submit" class="button select save" onclick="completeMatch(' . $match['EventId'] . ', ' . $match['MatchNumber'] . ')">Complete Match</button></td>');
            
                        echo('</tr>');
                    }
                ?>
            </thead>
        </table>
        <script>
            $('#header').load('../header.php');

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
    </body>
</html>