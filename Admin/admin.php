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
        <div id="header"></div>
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
                    <button class="button delete" onclick="removeTeam()"> Remove Team </button>
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
                    <button type="submit" class="button select save" onclick="saveTeam()">Save</button>
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
                    <button type="submit" class="button select save" onclick="saveEvent()">Save Competition</button>
                </div>
            </div>
        </div>


        <div id="edit-competition" class="tabcontent">
            <h3 style="rgb(6, 42, 70); text-decoration: none;">Edit Competition </h3>
            <p style="rgb(6, 42, 70); text-decoration: none;">Add/Remove Teams or Import Matches </p>
            <div class="row">
                <div class="teams column">
                    <?php
                        $results = $conn->query("SELECT * FROM Event WHERE Open = 1");
                        $rs = $results->fetch_array(MYSQLI_ASSOC);
                        echo('<div><label> Active Competition: ' . $rs["Name"] . '</div></br>');
                    ?>
                    <select id="competitions">
                        <option value="null" disabled selected>Select Competition</option>
                        <?php
                            $results = $conn->query("SELECT * FROM Event");
                            $events = array();
                            while ($rs = $results->fetch_array(MYSQLI_ASSOC)) {
                                echo ("<option value='{\"Id\": " . $rs["Id"] . ", \"Name\": \"" . $rs["Name"] .  "\", \"Date\": \"" . $rs["Date"] . "\", \"CurrentMatch\":" . $rs["CurrentMatch"] . "}'>" . $rs["Name"] . "</option>");
                                $events[] = $rs;
                            }
                        ?>
                    </select>
                    <button class="button select teams" onclick="loadCompetition()"> Select Competition </button>
                    <button class="button select teams" onclick="openCompetition()"> Open Competition </button>
                </div>
            
                <div class="row info">
                    <div id="competitionTeams" class="teams">
                        <?php
                            foreach ($teams as $team) {
                                echo ('<div><input onChange="updateCompetition(' . $team["TeamNumber"] . ')" class="eventTeam" id="' . $team["TeamNumber"] . '" type="checkbox" value="' . $team['TeamNumber'] .'">  &nbsp;' . $team['Name'] . ': ' . $team['TeamNumber'] . '</input> </br></div>');
                                $users[] = $rs;
                            }
                        ?>
                    </div>
                    <div id="competitionData" class="info">
                        <div>
                            <label>Competition Date: &nbsp;</label>
                            <input type ="date" id="editEventDate"></input>
                        </div>
                        </br>
                        <div>
                            <label>Event Name: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
                            <input type ="text" id="editEventName"></input>
                        </div>
                        </br>
                        <label class="button select"><input type="file" name="fileToUpload" id="fileToUpload" class="button select save"/>Select Match File</label>
                        <button class="button select" onclick="uploadFile()">Upload File</button>
                        </br>
                        <button type="submit" class="button select" onclick="updateEvent()">Save Competition</button>
                        </br>
                        <label id="status"></label>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#header').load('../header.php');

            document.getElementById('fileToUpload').onchange = function(){
                let fileName = document.getElementById('fileToUpload').files[0].name;
                $('#status')[0].innerText = `${fileName} Selected`;
            };
            
            function uploadFile(){
                var file = document.getElementById('fileToUpload').files[0];
                let competition = JSON.parse($('#competitions option:selected').val());
                if(competition == null) {
                    $('#status')[0].innerText = 'Please Select Competition To Add Matches To';
                    return;
                }
                if(file == null) {
                    $('#status')[0].innerText = 'Please Choose A File To Upload';
                    return;
                }
                var reader = new FileReader();
                reader.onload = function(progressEvent){
                    var lines = this.result.split('\n');
                    for(var line = 0; line < lines.length; line++){
                        let arr = lines[line].split('|');
                        $.get(`./createMatch.php?red1=${arr[5]}&red2=${arr[6]}&blue1=${arr[8]}&blue2=${arr[9]}&matchNumber=${line+1}&eventId=${competition.Id}`, function(result){});
                            $('#status')[0].innerText = `Match ${line+1} Created!`;
                    }
                };
                reader.readAsText(file);
            };

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

            function updateEvent() {
                let competition = JSON.parse($('#competitions option:selected').val())
                let competitionId = competition.Id;

                let newDate = $('#editEventDate').val();
                let newName = $('#editEventName').val();

                $.get(`./updateCompetition.php?competitionId=${competitionId}&competitionDate=${newDate}&competitionName=${newName}&currentMatch=${competition.CurrentMatch}`, function(result) {});
            }

            function loadCompetition() {
                let competition = JSON.parse($('#competitions option:selected').val())
                let competitionId = competition.Id;
                $.get(`./getTeamsAtCompetition.php?competitionId=${competitionId}`, function(result) {
                    let selectedTeams = result;
                    let children = $("#competitionTeams")[0].children;
                    for(let team of selectedTeams) {
                        if($(`#${team.TeamId}`).length > 0) {
                            $(`#${team.TeamId}`)[0].checked = true;
                        }
                    };
                });

                $('#editEventDate').val(competition.Date);
                $('#editEventName').val(competition.Name);

                let newDate = $('#editEventDate').val();
                let newName = $('#editEventName').val();
            }

            function updateCompetition(teamId) {
                let checked = $(`#${teamId}`)[0].checked;
                let event = JSON.parse($('#competitions option:selected').val())
                let eventId = event.Id;
                if (checked) {
                    $.get(`./createTeamEvent.php?teamId=${teamId}&eventId=${eventId}`, function(result){});
                } else {
                    $.get(`./removeTeamEvent.php?teamId=${teamId}&eventId=${eventId}`, function(result){});
                }
            }

            function openCompetition() {
                let event = JSON.parse($('#competitions option:selected').val())
                let eventId = event.Id;
                
                $.get(`./setOpenCompetition.php?eventId=${eventId}`, function(result){
                    window.location.reload();
                });
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>
    </body>
</html>