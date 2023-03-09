<?php
$status_msg='';
        
    if(isset($_POST['create_team'])){
        
        $team_exist_query = mysqli_query($conn, "SELECT * FROM teams WHERE name='$team_name'");
        $team_exist = mysqli_num_rows($team_exist_query);
        
        if($team_exist > 0){
            $status_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i> The team ' . $team_name .' already exists
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }else{
             mysqli_query($conn, "INSERT INTO teams (team_id, name, location, date_created) VALUES ('$team_id', '$team_name', '$location', '$current_date_time')");
        
        $get_admin_team = mysqli_query($conn, "SELECT team, active_team FROM users WHERE id = '$current_user_id'");
        $admin_team_details = mysqli_fetch_assoc($get_admin_team);
        // Getting and creating a new team entry
        $admin_team = $admin_team_details['team'];
        $new_admin_team = $admin_team.','.$team_id;
        
        //Getting an creating active team entry
       $active_team = $admin_team_details['active_team'];
       $new_active_team = $active_team.','.$team_id;
        
        mysqli_query($conn, "UPDATE users SET team='$new_admin_team' WHERE id='$current_user_id'");
        mysqli_query($conn, "UPDATE users SET active_team='$new_active_team' WHERE id='$current_user_id'");
        
        
        $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully created a new team.  
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
        ?>
        <script>
            window.location = '';
        </script>
        <?php
        }
        
        
       
        
    }
    if(isset($_POST['delete_team'])){
        
        if($word_check != 'DELETE'){
            $status_msg = $word_check_error_msg;
        }else{
            
            mysqli_query($conn, "DELETE FROM teams WHERE id ='$team_id'");
            
            $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You deletes the '. $team_name. '. team  
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            
            ?>
        <script>
            window.location = '';
        </script>
        <?php
        }
        
    }
?>