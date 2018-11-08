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

        <div class="card-holder">
            <?php

                $matchesToShow = $uncompletedMatchCount >= 4 ? 4 : $uncompletedMatchCount;
                for($i = 0; $i < $matchesToShow; $i++) {

                    $matchLoop=$matches[$i];

                    echo('<div class="card slot' . $matchLoop['MatchNumber'] . '">');

                        echo('<div class="container">');
                            echo('<h3 class="titleMatch">Match ' . $matchLoop['MatchNumber']);
                            if($i == 0) {
                                echo(' - Current Match');
                            } else if ($i == 1) {
                                echo(' - On Field Waiting ');
                            }echo('</h3>');

                            echo('<div class="teamRed red1">');
                                echo('Red 1: ' . $matchLoop['Red1']);
                                echo('<br>');
                                if($matchLoop['Red1Queued'] == 1) {
                                    echo('<img src="../images/icons8-checkmark-filled-100-white.png" class="checkImg" alt="check">');
                                }
                            echo('</div>');//end teamRed red1

                            echo('<div class="teamRed red2">');
                                echo('Red 1: ' . $matchLoop['Red2']);
                                echo('<br>');
                                if($matchLoop['Red2Queued'] == 1) {
                                    echo('<img src="../images/icons8-checkmark-filled-100-white.png" class="checkImg" alt="check">');
                                }
                            echo('</div>');//end teamRed red2

                            echo('<div class="teamBlue blue1">');
                                echo('Blue 1: ' . $matchLoop['Blue1']);
                                echo('<br>');
                                if($matchLoop['Blue1Queued'] == 1) {
                                    echo('<img src="../images/icons8-checkmark-filled-100-white.png" class="checkImg" alt="check">');
                                }
                            echo('</div>');//end teamBlue blue1

                            echo('<div class="teamBlue blue2">');
                                echo('Blue 2: ' . $matchLoop['Blue2']);
                                echo('<br>');
                                if($matchLoop['Blue2Queued'] == 1) {
                                    echo('<img src="../images/icons8-checkmark-filled-100-white.png" class="checkImg" alt="check">');
                                }
                            echo('</div>');//end teamBlue blue1

                        echo ('</div>');//end container

                    echo('</div>');//end card and card-holder



                } //end for loop

            ?><!-- end php script-->
        </div><!-- end card-holder -->


    </main>

</body>
</html>
