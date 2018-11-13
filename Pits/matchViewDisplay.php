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
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Match View Display</title>

	<link rel="stylesheet" type="text/css" href="../main.css">
    <link rel="stylesheet" type="text/css" href="display.css">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>

	<main>

		<?php include '../headerDisplay.php'; ?>

        <?php
            $matchesToShow = $uncompletedMatchCount >= 4 ? 4 : $uncompletedMatchCount;
            for ($i = 0; $i < $matchesToShow; $i++) {
                $matchLoop = $matches[$i];

                echo('<div class="card">');

                    echo('<h3 class="matchTitle">Match ' . $matchLoop['MatchNumber']);
                    if($i == 0) {
                        echo(' - Current Match</h3>');
                    }
                    else if  ($i == 1) {
                        echo(' - On Field Waiting</h3>');
                    }
                    else {
                        echo('</h3>');
                    }

                    echo('<div class="red">');
                        echo('Red 1: ' . $matchLoop['Red1']);
                        echo('<br />');
                        if($matchLoop['Red1Queued']) {
                            echo('<img src="../images/icons8-checkmark-filled-100-white.png" class="checkImg" alt="check">');
                        } else {
                            //do nothing
                        }
                    echo('</div>');//end red1

                    echo('<div class="red">');
                        echo('Red 2: ' . $matchLoop['Red2']);
                        echo('<br />');
                        if($matchLoop['Red2Queued']) {
                            echo('<img src="../images/icons8-checkmark-filled-100-white.png" class="checkImg" alt="check">');
                        } else {
                            //do nothing
                        }
                    echo('</div>');//end red2

                    echo('<div class="blue">');
                        echo('Blue 1: ' . $matchLoop['Blue1']);
                        echo('<br />');
                        if($matchLoop['Blue1Queued']) {
                            echo('<img src="../images/icons8-checkmark-filled-100-white.png" class="checkImg" alt="check">');
                        } else {
                            //do nothing
                        }
                    echo('</div>');//end blue1

                    echo('<div class="blue">');
                        echo('Blue 2: ' . $matchLoop['Blue2']);
                        echo('<br />');
                        if($matchLoop['Blue2Queued']) {
                            echo('<img src="../images/icons8-checkmark-filled-100-white.png" class="checkImg" alt="check">');
                        } else {
                            //do nothing
                        }
                    echo('</div>');//end blue2

                echo('</div>');//end card div
            }//end for loop
        ?>



    </main>

</body>
</html>

<script>
    setInterval(function(){location.reload(); }, 5000);
</script>
