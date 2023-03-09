<?php 


$status_msg = '';
    if(isset($_POST['add_subscription'])){
        
        $if_plan_exist_query = mysqli_query($conn, "SELECT name FROM subscription_plans WHERE name='$plan_name'AND duration='$plan_duration'");
        $if_plan_exist = mysqli_num_rows($if_plan_exist_query);
        
        $if_level_exist_query = mysqli_query($conn, "SELECT level FROM subscription_plans WHERE level='$plan_level' AND duration='$plan_duration'");
        $if_level_exist = mysqli_num_rows($if_level_exist_query);
        
        if($if_plan_exist > 0 || $if_level_exist > 0){
           $status_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i>  This subscription plan or level already exist
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }else{
              
        mysqli_query($conn, "INSERT INTO subscription_plans (name, price, level, duration, date) VALUES('$plan_name', '$plan_price','$plan_level', '$plan_duration','$current_date_time')");
        
        $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully created the plan - ' . $plan_name. '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    
        mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`,`activity`) VALUES ('$active_teams','$current_date_time','$current_user_name created the plan -  $plan_name')");
        }
      
    }
       if(isset($_POST['edit_subscription'])){
           $subscription_id = $_POST['subscription_id'];
        mysqli_query($conn, "UPDATE subscription_plans SET name='$plan_name', price='$plan_price', level='$plan_level', duration='$plan_duration' WHERE id='$subscription_id'");
        
        $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully updated the plan - ' . $plan_name. '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    
        mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name updated the plan -  $plan_name')");
      
    }

?>