<?php 
    if(isset($_POST['pick_team'])){
        $team = $_POST['team'];
        
        setcookie('team_id', $team, time() + (86400 * 30));
        
        ?>
        
        <script>
            window.location ='admin/dashboard';
        </script>
        <?php
    }

 

?>