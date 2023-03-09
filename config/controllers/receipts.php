<?php 
$status_msg = '';
    if(isset($_POST['upload_receipt'])){
        
        move_uploaded_file($tmp_file, "../assets/receipts/$rand$file");
        mysqli_query($conn , "INSERT INTO receipts (subject, team, user_id, receipt , date) VALUES('$subject', '$team_id', '$user_id', '$rand$file', '$current_date_time')");
        
        $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully uploaded a receipt for '.$fullname.'  
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
         mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name uploaded a receipt for $fullname with the subject- $subject ')");
         
    }


