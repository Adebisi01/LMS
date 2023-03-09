<?php 
$status_msg = '';
    if(isset($_POST['blacklist'])){
            
        if($word_check != 'BLACKLIST'){
             $status_msg = $word_check_error_msg;
        }else{
            
        mysqli_query($conn, "UPDATE `users` SET `status`='blacklisted', reason='$reason' WHERE id='$blacklist_id'");
        
        $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully blacklisted the user -  ' . $fullname. '  
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
         mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$active_teams', '$current_date_time','$current_user_name blacklisted the user - $fullname')");
        }

    }

    if(isset($_POST['restore'])){
            if ($word_check != 'RESTORE'){
                  $status_msg = $word_check_error_msg;
            }else{
                
        mysqli_query($conn, "UPDATE `users` SET `status`='active', reason='$reason' WHERE  id='$restore_id'");
        
        $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully restored the user -  ' . $fullname. '  
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
         mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name restored the user - $fullname')");
            }
    }
    if (isset($_POST['inactive'])){
        if ($word_check != 'INACTIVE'){
                  $status_msg = $word_check_error_msg;
            }else {
                mysqli_query($conn, "UPDATE `users` SET `status`='inactive' WHERE  id='$inactive_id'");
                $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully deactivated the user -  ' . $fullname. '  
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
         mysqli_query($conn, "INSERT INTO `activity_log`(`team`, `date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name deactivated the user - $fullname')");
            }
    }
    if (isset($_POST['fine'])){
                mysqli_query($conn, "UPDATE `users` SET `status`='fined' WHERE  id='$user_id'");
                mysqli_query($conn, "INSERT INTO `fines`(`user`, `amount`, `reason`, `status`, `date`) VALUES ('$user_id','$amount','$reason','unpaid','$current_date_time')");
        $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully Fined the user -  ' . $fullname. ' with a sum of '.$amount.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
         mysqli_query($conn, "INSERT INTO `activity_log`(`team`, `date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name fined the user - $fullname with an amount of $amount in naira')");
            }
    if (isset($_POST['remove_fine'])){
                mysqli_query($conn, "UPDATE `users` SET `status`='active' WHERE  id='$user_id'");
                mysqli_query($conn, "UPDATE `fines` set status='paid' WHERE user='$user_id' AND status='unpaid'");
        $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully Acknowledge the payment of -  ' . $fullname. ' fine
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
         mysqli_query($conn, "INSERT INTO `activity_log`(`team`, `date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name  Acknowledge the payment of $fullname fine')");
            }