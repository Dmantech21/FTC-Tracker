<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Check In</title>
	<link rel="stylesheet" type="text/css" href="../main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>

	<main>
		<header>
			<div class="header-left">
				<img src="../images/FIRST_HorzRGB_reverse.png" width="287" height="75" class="logo" alt="FIRST logo"/>
			</div>
			<div class="header-center">
				<h1>FTC Competition Tracker</h1>
			</div>
			<div class="header-right">
				<h2>User: <?php echo($_SESSION["Role"]);?></h2> <!-- FILL IN VARIABLE FOR USER LATER-->
				<button class="button button-fade" type="submit" onclick="logout()">Log Out</button>
			</div>
		</header>

		<select>
			<option>535</option>
			<option>5125</option>
			<option>2154</option>
			<option>1551</option>
			<option>951</option>
		</select>

		<div style="margin: 20px;" >
			<table id="timeStampTable" >
				<thead>
					<tr>
						<th>Team Number</th>
						<th>Team Name</th>
						<th>Time Checked In</th>
					</tr>
					<tr>
						<td> 535</td>
						<td>Tobor</td>
						<td>8:00a</td>
					</tr>
					<tr>
						<td>3537</td>
						<td>Mecha-Hampsters</td>
						<td>8:21a</td>
					</tr>
					<tr>
						<td> 535</td>
						<td>Tobor</td>
						<td>8:00a</td>
					</tr>
					<tr>
						<td>3537</td>
						<td>Mecha-Hampsters</td>
						<td>8:21a</td>
					</tr>
				</thead>
			</table>
		</div>


    </main>

</body>
</html>
