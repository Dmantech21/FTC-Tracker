<!DOCTYPE html>
<html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
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
            if ((!isset($_SESSION['logged_In']) || $_SESSION['logged_In'] == false) || (!isset($_SESSION['Role']) || $_SESSION['Role'] != 'Admin')) {
                $_SESSION['timeout'] = null;
                header("Location: ../index.php");
            }
        }

        $dbLocation = $_SESSION['location'];
        $dbUser = $_SESSION['dbUser'];
        $dbPassword = $_SESSION['dbPassword'];
        $dbName = $_SESSION['dbName'];

        $conn = new mysqli($dbLocation, $dbUser, $dbPassword, $dbName);
        $results = $conn->query("SELECT * FROM Team");

        $teams = array();
        while($rs = $results->fetch_array(MYSQLI_ASSOC)) {
            $teams[] = $rs;
        }
    ?>
    <head>
        <title>FTC-Competition Tracker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        <div id="header">
            <div class="header-content">
                <div class="header-title">
                    <h1>FTC-Competition Tracker</h1>
                </div>
                <div class="header-right">
                    <h4> Beta Testing</h4>
                    <h4>Administator</h4>
                </div>
            </div>
        </div>

        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'manage-teams')" id="defaultOpen">Manage Teams</>
            <button class="tablinks" onclick="openTab(event, 'create-competition')" >Create Competition</button>
            <button class="tablinks" onclick="openTab(event, 'edit-competition')">Edit Competition</button>
        </div>

        <div id="manage-teams" class="tabcontent pad-top row">
            <div class="row">
                <div class="remove-teams">
                    <select id="teams">
                        <option value="" disabled selected>Select Team</option>
                        <?php
                            foreach ($teams as $team) {
                                echo ('<option value="' . $team['TeamNumber'] . '">' . $team['Name'] . ': ' . $team['TeamNumber'] . '</option>');
                                $users[] = $rs;
                            }
                        ?>
                    </select>
                    <button class="button" onclick="removeTeam()"> Remove Team </button>
                </div>
                <div class="add-team">
                    <div>
                        <label> Team Number &nbsp; </label>
                        <input type="number" id="teamNumber"></input>
                    </div>
                    </br>
                    <div>
                        <label>Team Name: &nbsp; &nbsp; </label>
                        <input type="text" id="teamName"></input>
                    </div>
                    </br>
                    <button type="submit" class="button save" onclick="saveTeam()">Save</button>
                </div>
            </div>
        </div>

        <div id="create-competition" class="tabcontent">
            <h3 style="rgb(6, 42, 70); text-decoration: none;">Create Competition</h3>
            <div class="row">
                <div class="column teams">
                    <?php
                        foreach ($teams as $team) {
                            echo ('<div><input class="eventTeam" type="checkbox" value="' . $team['TeamNumber'] . '">  &nbsp;' . $team['Name'] . ': ' . $team['TeamNumber'] . '</input> </br></div>');
                            $users[] = $rs;
                        }
                    ?>
                </div>
                <div class="column info">
                    <div>
                        <label>Competition Date: &nbsp;</label>
                        <input type ="date" id="date"></input>
                    </div>
                    </br>
                    <div>
                        <label>Event Name: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
                        <input type ="text" id="eventName"></input>
                    </div>
                    </br>
                    <button type="submit" class="button save" onclick="saveEvent()">Save Competition</button>
                </div>
            </div>
        </div>


        <div id="edit-competition" class="tabcontent">
            <h3 style="rgb(6, 42, 70); text-decoration: none;">Edit Competition </h3>
            <p style="rgb(6, 42, 70); text-decoration: none;">Add/Remove Teams or Import Matches </p>
            <div class="editCompetitions">
                <select id="teams">
                    <option value="" disabled selected>Select Team</option>
                    <?php
                        // $results = $conn->query("SELECT su.Name, su.Login_Name, su.ID FROM SanD_Student_User su JOIN SanD_Section s ON su.Section_ID = s.ID Where s.Open = true AND su.Name != 'Admin'");
                        // $users = array();
                        // while ($rs = $results->fetch_array(MYSQLI_ASSOC)) {
                        //     echo ('<option value="' . $rs["ID"] . '">' . $rs["Name"] . '</option>');
                        //     $users[] = $rs;
                        // }
                    ?>
                </select>
                <button class="button" onclick="deleteUser()"> Remove Team </button>
            </div>
        </div>

        <script>
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

            function saveTeam() {
                let teamNumber = $('#teamNumber').val();
                let teamName = $('#teamName').val();
                $.get(`./createTeam.php?teamNumber=${teamNumber}&teamName=${teamName}`, function(result){
                    window.location.reload();
                });
            }

            function removeTeam() {
                let teamNumber = $('#teams option:selected').val();
                $.get(`./removeTeam.php?teamNumber=${teamNumber}`, function(result){
                    window.location.reload();
                });
            }

            function saveEvent() {
                let teams = $("input:checked");
                let date = $("#date").val();
                let eventName = $("#eventName").val();
                let eventId = null;
                
                if (teams.length > 0 && eventName !== '' && date !== '') {
                    $.get(`./createEvent.php?date=${date}&eventName=${eventName}`, function(result){
                        eventId = result.Id;
                        for(let i = 0; i < teams.length; i++) {
                            let teamNumber = teams[i]['value'];

                            $.get(`./createTeamEvent.php?teamId=${teamNumber}&eventId=${eventId}`, function(result){
                                window.location.reload();
                            });
                        }
                    });
                }
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>
    </body>
</html>