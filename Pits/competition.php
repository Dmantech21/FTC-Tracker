<!DOCTYPE html>
<html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?php
        session_start();
        if ($_SESSION['timeout'] + 600 < time()) {
            $_SESSION['logged_In'] = false;
            $_SESSION['userName'] = null;
            $_SESSION['Role'] = null;
            $_SESSION['timeout'] = null;
            header("Location: ../index.php");
        } else {
            $_SESSION['timeout'] = time();
            if ((!isset($_SESSION['logged_In']) || $_SESSION['logged_In'] == false) || (!isset($_SESSION['Role']) || $_SESSION['Role'] != 'Guest')) {
                $_SESSION['timeout'] = null;
                header("Location: ../index.php");
            }
        }

        $dbLocation = $_SESSION['location'];
        $dbUser = $_SESSION['dbUser'];
        $dbPassword = $_SESSION['dbPassword'];
        $dbName = $_SESSION['dbName'];
    ?>
    <head>
        <title>FTC-Competition Tracker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="competition.css">
    </head>
    <body>
        <div id="header"></div>
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'check-in')" id="defaultOpen">Check-In</button>
            <button class="tablinks" onclick="openTab(event, 'match-view')" >Match View</button>
        </div>

        <div id="check-in" class="tabcontent pad-top row"> </div>
        <div id="match-view" class="tabcontent pad-top row"> </div>

        <script>
            $('#header').load('../header.php');

            $('#check-in').load('checkin.php');
            setInterval(function () {
                $('#check-in').load('checkin.php');
            }, 15000);

            $('#match-view').load('matchPlay.php');
            setInterval(function () {
                $('#match-view').load('matchPlay.php');
            }, 10000);
            
            document.getElementById("defaultOpen").click();

            function openTab(evt, cityName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>
    </body>
</html>
