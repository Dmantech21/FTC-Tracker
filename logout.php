<?php
    session_start();
    $_SESSION['logged_In'] = false;
    $_SESSION['userName'] = null;
    $_SESSION['Role'] = null;
    $_SESSION['timeout'] = null;
    session_destroy();
?>
