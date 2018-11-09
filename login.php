<?php
    session_start();
    header("Content-type: application/json");

    $conn = new mysqli("localhost", "phpmyadmin", "IndianaFIRST", "phpmyadmin");
    $checkLoggedIn = $_GET['checkLoggedIn'];

    if (isset($_SESSION['logged_In']) && $_SESSION['logged_In'] == true && $checkLoggedIn) {
        $userName = $_SESSION['userName'];
         $results = $conn->query("SELECT *
                                  FROM User
                                  WHERE UserName =  '$userName'");
    }
    else {
        $userName = $_GET['userName'];
        $password = $_GET['password'];

         $results = $conn->query("SELECT ID, UserName, Role
                                  FROM User
                                  WHERE UserName =  '$userName'
                                  AND Password =  '$password'");
    }


    $count = mysqli_num_rows($results);
    if ($count == 1) {
        $row = $results->fetch_array(MYSQLI_ASSOC);
        $_SESSION['logged_In'] = true;
        $_SESSION['userName'] = $row['UserName'];
        $_SESSION['Role'] = $row['Role'];
        $_SESSION['timeout'] = time();
        $_SESSION['location'] = "localhost";
        $_SESSION['dbUser'] = "phpmyadmin";
        $_SESSION['dbPassword'] = "IndianaFIRST";
        $_SESSION['dbName'] = "phpmyadmin";

        $json = json_encode($row);
        echo($json);
        $conn->close();

    } else {
        $_SESSION['logged_In'] = false;
        $_SESSION['userName'] = null;
        $_SESSION['Role'] = null;
        $_SESSION['timeout'] = null;
        $_SESSION['location'] = null;
        $_SESSION['dbUser'] = null;
        $_SESSION['dbPassword'] = null;
        $_SESSION['dbName'] = null;
        $error = "Invalid username and password!";
        $conn->close();
    }

    /* Written by Dylan Mangold */
?>
