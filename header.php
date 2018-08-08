<div class="header-content">
    <div class="header-title">
        <h1>FTC-Competition Tracker</h1>
    </div>
    <div class="header-right">
        <h4> <?php 
            session_start();
            echo($_SESSION['Role']);
        ?></h4>
        <button type="submit" class="button select save" onclick="logOut()">Logout</button>
    </div>
</div>
<script>
    function logOut() {
        $.get(`../logout.php`, function(result){
            window.location.reload();
        });
    }
</script>
