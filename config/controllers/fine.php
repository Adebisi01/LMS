<?php 
    require_once('../db.php');
    require_once('../app-config.php');

    if(isset($_POST['amount'])){
        
        $amount = $post['amount'];
        mysqli_query($conn, "UPDATE users SET status='active' WHERE id='$current_user_id'");
        mysqli_query($conn, "UPDATE fines SET status='paid' WHERE user='$current_user_id' AND status='unpaid'");
        mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$current_user_team','$current_date_time','$current_user_name paid his/her $amount fine')");
    }
?>