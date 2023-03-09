<?php 
$status_msg='';
        if(isset($_POST['create_staff'])){
           
           
           $staff_team_string = implode(',', $staff_team);
            
            $if_exist_query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND team = '$current_team_id'");
            $exist = mysqli_num_rows($if_exist_query);
            
            if ($exist > 0){
                $status_msg= '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i> A user with this email already exist
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }else{
                if($password != $confirm_password){
                $status_msg= '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i> Passwords do not match.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }else{
                
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);    
             mysqli_query($conn, "INSERT INTO `users`(`team`, `role`, `fullname`, `status`, `password`, `email`, `phone`, `date`) VALUES ('$staff_team_string','staff','$fullname','active','$password','$email','$phone','$current_date_time')");
           $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully created the staff- ' . $fullname. '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    
                     mysqli_query($conn, "INSERT INTO `activity_log`(`team`, `date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name created the staff - $fullname')");

            }
            }
            
            
            
        }
        if(isset($_POST['make_admin'])){
     
            mysqli_query($conn, "UPDATE users SET role='admin' WHERE id='$staff_id'");
            $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully made '. $staff_fullname . ' an admin 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            mysqli_query($conn, "INSERT INTO `activity_log`(`team`, `date`, `activity`) VALUES ('$active_teams', '$current_date_time','$current_user_name made $staff_fullname an admin ')");

        }
        if(isset($_POST['assign_staff'])){
                
            
            $staff_name_query = mysqli_query($conn, "SELECT fullname FROM users WHERE id='$staff_id'");
            $staff_fullname = mysqli_fetch_assoc($staff_name_query)['fullname'];
            
            $staff_team_string = implode(',', $staff_team);
            // var_dump($staff_team_array);
            // die();
            for($i = 0; $i < count($staff_team); $i++){
                $team_namme_query = mysqli_query($conn, "SELECT name FROM teams WHERE team_id='$staff_team[$i]' ");
                if($i == 0){
                   $staff_team_name .= mysqli_fetch_assoc($team_namme_query)['name'] ;
                }else{
                    $staff_team_name .= ', '.mysqli_fetch_assoc($team_namme_query)['name'] ;
                }
            } 
            
            mysqli_query($conn, "UPDATE users SET team='$staff_team_string' WHERE id='$staff_id'");
            $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully asigned team(s) - '.$staff_team_name.' to '. $staff_fullname . ' 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            mysqli_query($conn, "INSERT INTO `activity_log`(`team`, `date`, `activity`) VALUES ('$active_teams', '$current_date_time','$current_user_name reassigned team(s) to $staff_fullname ')");

            
        }
?>