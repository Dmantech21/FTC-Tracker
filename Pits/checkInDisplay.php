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
	<link rel="stylesheet" type="text/css" href="checkInDisplay.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>

	<main>

        <?php include '../headerDisplay.php'; ?>

        <!--
		<header>
			<div class="header-left">
				<img src="../images/FIRST_Horz_RGB.png" width="287" height="75" class="logo"/>
			</div>
			<div class="header-center">
				<h1>FTC Competition Tracker</h1>
				<nav>
					<ul>
						<li>Check In</li> |
						<li>Match View</li>
					</ul>
				</nav>

			</div>
			<div class="header-right">
				<h2>User: <?php echo($_SESSION["Role"])?></h2> FILL IN VARIABLE FOR USER LATER
				<button class="button button-fade" type="submit" onclick="logout()">Log Out</button>
				 DELETE the log out button and make it so that when a user clicks on the name of who's logged in
				it will log out. Makes the UI on this page easy (but still gives functionality to log out)
			</div>
		</header>-->

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
			<tbody>
				<tr>
					<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-black.png" /></td>
					<td></td>
					<td>Smith</td>
					<td></td>
					<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-black.png" /></td>
				</tr>
				<tr>
					<td>Jill</td>
					<td>Smith</td>
					<td>50</td>
					<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-black.png" /></td>
					<td></td>
				</tr>
				<tr>
					<td>Eve</td>
					<td>Jackson</td>
					<td>94</td>
					<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-black.png" /></td>
					<td></td>
				</tr>
				<tr>
					<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-black.png" /></td>
					<td></td>
					<td></td>
					<td>Smith</td>
					<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-black.png" /></td>
				</tr>
				<tr>
					<td>Eve</td>
					<td>Jackson</td>
					<td>94</td>
					<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-black.png" /></td>
					<td></td>
				</tr>
				<tr>
					<td>Eve</td>
					<td>Jackson</td>
					<td>94</td>
					<td><img class="checkImg" src="../images/icons8-checkmark-filled-100-black.png" /></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</main>

</body>
</html>
