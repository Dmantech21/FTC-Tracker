<?php
    session_start();
    $_SESSION['currentUser'];

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" type="text/css" href="display.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <header>
		<div class="header-left">
			<img src="FIRST_Horz_RGB.png"class="logo" alt="FIRST logo"/>
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
			<h2><?php echo($_SESSION['currentUser'])?></h2>
			<button class="button button-fade" type="submit" onclick="logout()">Log Out</button>
			<!-- DELETE the log out button and make it so that when a user clicks on the name of who's logged in,
			it will log out. Makes the UI on this page easy (but still gives functionality to log out) -->
		</div>
	</header>
</body>
</html>
