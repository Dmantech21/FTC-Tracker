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
    //  $results = $conn->query("SELECT su.ID, su.Name
    //  FROM SanD_Student_User su
    //  JOIN SanD_Section s ON su.Section_ID = s.ID
    //  WHERE s.Open =1
    //  AND su.Name != 'Admin'");

    // $students = array();
    // while($rs = $results->fetch_array(MYSQLI_ASSOC)) {
    //     $students[] = $rs;
    // }
    ?>
    <head>
        <title>FTC-Competition Tracker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="admin.css">
        <link rel="stylesheet" href="createTeams.css">
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

        <div class="main">

        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'manage-teams')" id="defaultOpen">Manage Teams</>
            <button class="tablinks" onclick="openTab(event, 'create-competition')" >Create Competition</button>
            <button class="tablinks" onclick="openTab(event, 'edit-competition')">Edit Competition</button>
        </div>

        <div id="manage-teams" class="tabcontent">
            Team Info Here
        </div>

        <div id="create-competition" class="tabcontent">
            <h3 style="rgb(6, 42, 70); text-decoration: none;">Create Competition</h3>
            <p style="rgb(6, 42, 70); text-decoration: none;"> Add New Team For Competitions </p>
            <div class="create-new-team">
                Do Stuff Here
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
            $(document).ready(function() {
                $(".list-item_CT").draggable({helper:"clone"});
                $(".list-item ui-draggable_CT").draggable({helper:"clone"});
                $(".dropped-item_CT").draggable({helper:"clone"});
                $(".other-item_CT").draggable({helper:"clone"});

                $(".students_CT").droppable({
                    accept:".list-item_CT",
                    drop:function(ev, ui){
                    let droppedItem = $(ui.draggable).clone();
                    droppedItem.switchClass("dropped-item_CT", "list-item_CT");
                    $(this).append(droppedItem);
                    }
                });

                $(".block_CT").droppable({
                    accept:".list-item_CT",
                    drop:function(ev, ui){
                    if ($(this)[0].childNodes.length < 5){
                        let droppedItem = $(ui.draggable).clone();
                        let idToRemove = droppedItem[0].innerHTML;
                        $(ui.draggable).attr('id',idToRemove);
                        let nodeToRemove = document.getElementById(idToRemove);
                        nodeToRemove.parentNode.removeChild(nodeToRemove);
                        droppedItem.switchClass("list-item_CT", "dropped-item_CT");
                        $(this).append(droppedItem);
                        }
                    }
                });
            });

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
        <script>
            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>

    </body>
</html>