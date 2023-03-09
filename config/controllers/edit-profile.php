<?php 
require_once('../config/functions/utilities.php');
$status_msg='';
        if(isset($_POST['update_user'])){
      
          
           $user_team_string = implode(',', $user_team);
                // Get Current SUbscription os User
                $user_sub_query = mysqli_query($conn, "SELECT subscription FROM users WHERE id='$user_id'");
                  $user_cur_sub = mysqli_fetch_assoc($user_sub_query)['subscription'];
                
                //Check if admin is subscribing to the current subscription
                  if($user_cur_sub != $subscription){
                    //Insert into the User subscription if its a different subscription
                    //calculating the subscription due date.
                        $sub_duration_query = mysqli_query($conn, "SELECT duration FROM subscription_plans WHERE id ='$subscription'");
                        $sub_duration = mysqli_fetch_assoc($sub_duration_query)['duration'];
                        if($sub_duration != 'INFINITE'){
                           $sub_duration = $sub_duration * 30;
                        }
                        
                        $due_date = add_dates($current_date_time, ($sub_duration));
                        // Inserting
                        mysqli_query($conn, "INSERT INTO `user_subscriptions`(`type`, `subscriber`, `subscription_date`, `expiry_date`) VALUES ('$subscription','$user_id','$current_date_time','$due_date')");
                  }
                
                if(empty($user_passport) ){
                    mysqli_query($conn, "UPDATE users SET subscription = '$subscription', team = '$user_team_string', active_team='$user_team_string', role='$user_type', fullname='$user_fullname', email='$email', phone='$phone' WHERE id='$user_id'");
                }else{
                    move_uploaded_file($user_passport_tmp, "../assets/images/users/$rand$user_passport");
                    mysqli_query($conn, "UPDATE users SET subscription = '$subscription', team = '$user_team_string', active_team='$user_team_string', passport='$rand$user_passport', role='$user_type', fullname='$user_fullname', email='$email', phone='$phone' WHERE id='$user_id'");
                    
                   }
                  //Getting User current subscription 
                  
                  
                
                    $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully updated the staff- ' . $user_fullname. '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    
                     mysqli_query($conn, "INSERT INTO `activity_log`(`team`, `date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name updated $user_fullname profile')");

            }
            
    
        if(isset($_POST['change_password'])){
            
            $password_query = mysqli_query($conn, "SELECT password FROM users WHERE id = '$current_user_id'");
            $cur_password = mysqli_fetch_assoc($password_query)['password'];
           
            if(!password_verify($password , $cur_password )){
                $status_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i> Incorrect Password
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }else{
                $new_password = password_hash($new_password, PASSWORD_BCRYPT, ['cost' => 12]);  
                mysqli_query($conn, "UPDATE users SET password='$new_password' WHERE id='$current_user_id'");   
                
                $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i> Passsword changed successfully
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    
                     mysqli_query($conn, "INSERT INTO `activity_log`(`team`, `date`, `activity`) VALUES ('$current_team_id','$current_date_time','$current_user_name changed his password')");

            }
            
        }

?>