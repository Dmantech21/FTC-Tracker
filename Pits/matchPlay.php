<?php
    session_start();

    $dbLocation = $_SESSION['location'];
    $dbUser = $_SESSION['dbUser'];
    $dbPassword = $_SESSION['dbPassword'];
    $dbName = $_SESSION['dbName'];

    $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);
    $results = $conn->query("SELECT * FROM EventMatch AS em JOIN Event AS e ON em.EventId = e.Id WHERE e.Open = 1 AND em.IsComplete = 0 ORDER BY em.MatchNumber ASC;");
    $uncompletedMatchCount = mysqli_num_rows($results);
    $matches = array();
    while($rs = $results->fetch_array(MYSQLI_ASSOC)) {
        $matches[] = $rs;
    }
    $_SESSION['currentMatch'] = $matches[0]['MatchNumber'];
?>
<div class="row">
    <!-- ROW -->
    <div class="column matches"> 
        <!-- LEFT COLUMN -->
        <?php
            $matchesToShow = $uncompletedMatchCount >= 5 ? 5 : $uncompletedMatchCount;
            for($i = 0; $i < $matchesToShow; $i++) {
                $match = $matches[$i];
                echo('<div class="column">');
                    echo('<div class="row" id="match' . $match['MatchNumber'] . '">Match: ' . $match['MatchNumber']);
                    if($i == 0) {
                        echo(' - Current Match');
                    } else if ($i == 1) {
                        echo(' - On Field Waiting');
                    }
                    echo('</div></br>');

                    echo('<div class="row">');
                        echo('<div class="column teamRed">Red1: ' . $match['Red1']);
                        if($match['Red1Queued'] == 1) {
                            echo('&nbsp;<i class="material-icons" >check_circle</i>');
                        }
                        echo('</div>');

                        echo('<div class="column teamBlue">Blue 1: ' . $match['Blue1']);
                        if($match['Blue1Queued'] == 1) {
                            echo('&nbsp;<i class="material-icons" >check_circle</i>');
                        }
                        echo('</div>');

                    echo('</div></br>');

                    echo('<div class="row">');
                        echo('<div class="column teamRed">Red2: ' . $match['Red2']);
                        if($match['Red2Queued'] == 1) {
                            echo('&nbsp;<i class="material-icons" >check_circle</i>');
                        }
                        echo('</div>');
                        echo('<div class="column teamBlue">Blue 2: ' . $match['Blue2']);
                        if($match['Blue2Queued'] == 1) {
                            echo('&nbsp;<i class="material-icons" >check_circle</i>');
                        }
                        echo('</div>');
                    echo('</div>');

                echo('</div></br>');
            }
        ?>
    </div>
    <div>
        <!-- RIGHT COLUMN -->
        <img src="index.png"> 
    </div>
</div>