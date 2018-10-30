<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<header>
    <div class="header-left">
        <img src="../images/FIRST_Horz_RGB.png" class="logo"/>
    </div>
    <div class="header-center">
        <h1>FTC Competition Tracker</h1>
        <nav>
            <ul>
                <a href="../Pits/checkInDisplay.php"><li>Check In</li></a> |
                <a href="../Pits/matchViewDisplay.php"><li>Match View</li></a>
            </ul>
        </nav>

    </div>
    <div class="header-right">
        <h2>User: <?php echo($_SESSION["Role"])?></h2>
        <button class="button button-fade" type="submit" onclick="logout()">Log Out</button>
        <!-- DELETE the log out button and make it so that when a user clicks on the name of who's logged in,
        it will log out. Makes the UI on this page easy (but still gives functionality to log out) -->
    </div>
</header>
</html>
