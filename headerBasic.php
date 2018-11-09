<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<header>
    <div class="header-left">
        <img src="../images/FIRST_HorzRGB_reverse.png" class="logo"/>
    </div>
    <div class="header-center">
        <h1>FTC Competition Tracker</h1>

    </div>
    <div class="header-right">
        <h2>User: <?php echo($_SESSION["Role"])?></h2>
        <button class="button button-fade" type="submit" onclick="logOut()">Log Out</button>
        <!-- DELETE the log out button and make it so that when a user clicks on the name of who's logged in,
        it will log out. Makes the UI on this page easy (but still gives functionality to log out) -->
    </div>
</header>
</html>


<script>
    function logOut() {

        $.get(`../logout.php`, function(result){
            window.location.reload();
        });
    }
</script>
