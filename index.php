<?php
    session_start();
    if ($_SESSION['timeout'] + 600 < time()) {
        $_SESSION['logged_In'] = false;
        $_SESSION['userName'] = null;
        $_SESSION['Role'] = null;
        $_SESSION['timeout'] = null;
        //header("Location: ../index.php");
    } else {
        $_SESSION['timeout'] = time();
        if ((!isset($_SESSION['logged_In']) || $_SESSION['logged_In'] == false) || (!isset($_SESSION['Role']) || $_SESSION['Role'] != 'Guest')) {
            $_SESSION['timeout'] = null;
            //header("Location: ../index.php");
        }
    }

    $dbLocation = $_SESSION['location'];
    $dbUser = $_SESSION['dbUser'];
    $dbPassword = $_SESSION['dbPassword'];
    $dbName = $_SESSION['dbName'];
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>

	<main>
		<div id="login">
			<img src="../FTC-Tracker/images/FIRST_HorzRGB_reverse.png" class="logo" alt="FIRST logo"/>
            <br />
			<input type="text" id="user" placeholder="Username"></input>
			<input type="password" id="psw" placeholder="password"></input>
			<br />
			<button class="button button-fade" type="submit" onclick="login()">Login</button>
		</div>
    </main>

</body>
</html>
<script>
        let user;
        $( document ).ready(function() {
            $.get(`./login.php?checkLoggedIn=true`, function(result){
            user = result;
            });
        });

        function login() {
            let oldUser = user;
            let userName = $("#user").val();
            let password = $('#psw').val();
            $.get(`./login.php?checkedLoggedIn=false&userName=${userName}&password=${password}`, function(result){
                user = result;
                if (user !== oldUser) {
                    if (user.Role === 'Admin') {
                        window.location.href = './Admin/admin.php';
                    } else if(user.Role === 'RobotInspector' ||
                            user.Role === 'FieldInspector' ||
                            user.Role === 'Receptionist' ||
                            user.Role === 'Judging') {
                        window.location.href = './BasicUsers/checkInTeams.php';
                    } else if (user.Role === 'Queuer') {
                        window.location.href = './Que/queueingMatches.php';
                    } else if (user.Role === 'Guest') {
                        window.location.href = './Pits/checkInDisplay.php'
                    } else {
                        window.location.reload();
                    }
                }
            });
        }

        function logout() {
            $.get(`./logout.php`, function(result){
            window.location.reload();
            });
        }
        </script>
