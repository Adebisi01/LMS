<?php 
$status_msg = '';
   

    if(isset($_POST['restore'])){
            if ($word_check != 'RESTORE'){
                  $status_msg = $word_check_error_msg;
            }else{
                
        mysqli_query($conn, "UPDATE `users` SET `status`='active', reason='$reason' WHERE  id='$restore_id'");
        
        $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully restored the staff -  ' . $fullname. '  
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
         mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name restored the staff - $fullname')");
            }
    }
    if (isset($_POST['archive'])){
        if ($word_check != 'ARCHIVE'){
                  $status_msg = $word_check_error_msg;
            }else {
                mysqli_query($conn, "UPDATE `users` SET `status`='archived' WHERE  id='$archive_id'");
                $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully archived the staff -  ' . $fullname. '  
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
         mysqli_query($conn, "INSERT INTO `activity_log`(`team`, `date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name archived the staff - $fullname')");
            }
    }