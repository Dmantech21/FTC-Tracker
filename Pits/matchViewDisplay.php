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
	<title>Match Play Display</title>

	<link rel="stylesheet" type="text/css" href="main.css">
<!-- 	<link rel="stylesheet" type="text/css" href="matchPlayDisplay.css">-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>

	<main>

		<?php include '../headerDisplay.php'; ?>


    </main>

</body>
</html>
