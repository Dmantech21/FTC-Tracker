<!DOCTYPE html>
<html lang="en">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./index.css">
    <body>
        <?php
        session_start();
        $conn = new mysqli("localhost", "phpmyadmin", "canonRebelt1i", "phpmyadmin");

        if ($_SESSION['timeout'] + 600 < time()) {
            $_SESSION['logged_In'] = false;
            $_SESSION['userName'] = null;
            $_SESSION['Role'] = null;
            $_SESSION['timeout'] = null;
        } else {
            $_SESSION['timeout'] = time();
        }
        ?>
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
                        window.location.href = './BasicUsers/checkin.php';
                    } else if (user.Role === 'Queuer') {
                        window.location.href = './Queueing/queueing.php';
                    } else if (user.Role === 'Guest') {
                        window.location.href = './Pits/competition.php'
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
        <div class="login" flex>
            <div>
                <label class="large-font"> User Name: &nbsp; </label>
                <input class="medium-font" type="text" id="user"></input>
            </div>
            </br>
            <div>
                <label class="large-font">Password: &nbsp; &nbsp; </label>
                <input class="medium-font" type="password" id="psw"></input>
            </div>
            </br>
            <button class="button" type="submit" onclick="login()">Login</button>
        </div>
    </body>
</html>
