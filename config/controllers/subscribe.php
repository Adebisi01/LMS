<?php 
require_once('../db.php');
require_once('../app-config.php');
require_once('../functions/utilities.php');

    if(isset($_POST['sub_plan'])){
        
        $sub_plan = $_POST['sub_plan'];
        $sub_id = $_POST['sub_id'];
     $result = mysqli_query($conn, "UPDATE `users` SET `subscription`= '$sub_id' WHERE `id` = '$current_user_id' ");
     
    $sub_duration_query = mysqli_query($conn, "SELECT duration FROM subscription_plans WHERE id ='$subscription'");
    $sub_duration_duration = mysqli_fetch_assoc($sub_duration_query)['duration'];
    $due_date = add_dates($current_date_time, ($sub_duration_duration * 30));
     
     $result = mysqli_query($conn, "INSERT INTO `user_subscriptions`(`type`, `subscriber`, `subscription_date`, `expiry_date`) VALUES ('$sub_id','$current_user_id','$current_date_time','$due_date') ");
      
        mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$current_user_team','$current_date_time','$current_user_name subscribed to $sub_plan')");
        echo json_encode($sub_plan);
  
    }