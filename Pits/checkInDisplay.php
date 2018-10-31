<?php
        session_start();
        if ($_SESSION['timeout'] + 600 < time()) {
            $_SESSION['logged_In'] = false;
            $_SESSION['userName'] = null;
            $_SESSION['Role'] = null;
            $_SESSION['timeout'] = null;
        } else {
            $_SESSION['timeout'] = time();
            if ((!isset($_SESSION['logged_In']) || $_SESSION['logged_In'] == false) || (!isset($_SESSION['Role']) || $_SESSION['Role'] == 'Admin' || $_SESSION['Role'] == 'Guest')) {
                $_SESSION['timeout'] = null;
            }
        }

        $dbLocation = $_SESSION['location'];
        $dbUser = $_SESSION['dbUser'];
        $dbPassword = $_SESSION['dbPassword'];
        $dbName = $_SESSION['dbName'];
        $role = $_SESSION['Role'];

        $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Check In Display</title>

	<link rel="stylesheet" type="text/css" href="../main.css">
	<link rel="stylesheet" type="text/css" href="display.css">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>

	<main>

        <?php include '../headerDisplay.php'; ?>

		<table id="displayTable">
			<thead>
				<tr>
					<th>Team Number</th>
					<th>Checked-In</th>
					<th>Passed Robot Inspection</th>
					<th>Passed Field Inspection</th>
					<th>Ready For Judging</th>
				</tr>
			</thead>
            <?php
                $results = $conn->query("SELECT * FROM TeamEvent AS te JOIN Event AS e ON te.EventId = e.Id WHERE e.Open = 1 AND (IsCheckedIn = 0 OR PassedRobotInspection = 0 OR PassedFieldInspection = 0 OR ReadyForJudging = 0) ORDER BY te.TeamId ASC;");
                $teams = array();
                while($rs = $results->fetch_array(MYSQLI_ASSOC)) {
                    $teams[] = $rs;
                }

                $rowCount = 0;

                echo('<tbody class="tableBody">');
                foreach($teams as $team) {
                    $rowCount++;
                    echo('<tr>'
                    .'<td>' . $team['TeamId'] . '</td>');

                    if($team['IsCheckedIn'] == 1) {
                        if($rowCount % 2 == 0) {
                            echo('<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-white.png" alt="check"/></td>');
                        } else {
                            echo('<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-black.png" alt="check"/></td>');
                        }
                    } else {
                        echo('<td></td>');
                    }

                    if($team['PassedRobotInspection'] == 1) {
                        if($rowCount % 2 == 0) {
                            echo('<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-white.png" alt="check"/></td>');
                        } else {
                            echo('<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-black.png" alt="check"/></td>');
                        }
                    } else {
                        echo('<td></td>');
                    }

                    if($team['PassedFieldInspection'] == 1) {
                        if($rowCount % 2 == 0) {
                            echo('<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-white.png" alt="check"/></td>');
                        } else {
                            echo('<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-black.png" alt="check"/></td>');
                        }
                    } else {
                        echo('<td></td>');
                    }

                    if($team['ReadyForJudging'] == 1) {
                        if($rowCount % 2 == 0) {
                            echo('<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-white.png" alt="check"/></td>');
                        } else {
                            echo('<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-black.png" alt="check"/></td>');
                        }
                    } else {
                        echo('<td></td>');
                    }

                    echo('</tr>');
                }
                echo('</tbody>');
            ?>
		</table>
	</main>

</body>
</html>
