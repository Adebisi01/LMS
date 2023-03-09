<?php 
$status_msg = '';
    if(isset($_POST['set_active_team'])){
        
        $teams = $_POST['active_teams'];

        if($teams == NULL){
            $status_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i>  The file format '. $ext .' is not supported. Upload a PDF, EPUB or MOBI file for E-book File
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }else{
        
        $teams_string = implode(',', $teams);
        
        mysqli_query($conn, "UPDATE `users` SET `active_team`='$teams_string' WHERE id='$current_user_id'");
        
        ?>
        <script>
            window.location ='';
        </script>
        <?php
        }
    }