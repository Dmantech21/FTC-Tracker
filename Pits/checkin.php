<table class="tableBodyScroll">
    <thead>
        <tr>
            <th style="text-align:center;">Team Number</th>
            <th style="text-align:center;">Checked-In</th>
            <th style="text-align:center;">Passed Robot Inspection</th>
            <th style="text-align:center;">Passed Field Inspection</th>
            <th style="text-align:center;">Ready For Judging</th>
        </tr>
    </thead>
    
    <?php
        session_start();

        $dbLocation = $_SESSION['location'];
        $dbUser = $_SESSION['dbUser'];
        $dbPassword = $_SESSION['dbPassword'];
        $dbName = $_SESSION['dbName'];

        $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);
        
        $results = $conn->query("SELECT * FROM TeamEvent AS te JOIN Event AS e ON te.EventId = e.Id WHERE e.Open = 1 AND (IsCheckedIn = 0 OR PassedRobotInspection = 0 OR PassedFieldInspection = 0 OR ReadyForJudging = 0) ORDER BY te.TeamId ASC;");
        $teams = array();
        while($rs = $results->fetch_array(MYSQLI_ASSOC)) {
            $teams[] = $rs;
        }
	echo('<tbody class="tableBody">');
        foreach($teams as $team) {
            echo('<tr>'
                    .'<td>' . $team['TeamId'] . '</td>');

            if($team['IsCheckedIn'] == 1) {
                echo('<td><i class="material-icons" >check_circle</i></td>');
            } else {
                echo('<td></td>'); 
            }

            if($team['PassedRobotInspection'] == 1) {
                echo('<td><i class="material-icons" >check_circle</i></td>');
            } else {
                echo('<td></td>'); 
            }

            if($team['PassedFieldInspection'] == 1) {
                echo('<td><i class="material-icons" >check_circle</i></td>');
            } else {
                echo('<td></td>'); 
            }

            if($team['ReadyForJudging'] == 1) {
                echo('<td><i class="material-icons" >check_circle</i></td>');
            } else {
                echo('<td></td>'); 
            }

            echo('</tr>');
        }
	echo('</tbody>');
    ?>
</table>

<script>
    setTimeout(() => { 
            let y = 550;
            $('.tableBody').animate({scrollTop: y},13000);
        }, 2000);
    setInterval(function () {
        setTimeout(() => { 
            let y = 550;
            $('.tableBody').animate({scrollTop: y},13000);
        }, 2000);
    }
    , 15000);
</script>
