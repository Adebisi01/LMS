<?php 
// Sign Up Form Controller
$status_msg= '';
    if(isset($_POST['sign-up'])){
      // Get All Post Variables   
        $fullname = mysqli_real_escape_string($conn, trim($_POST['name']));
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
        $password = mysqli_real_escape_string($conn, trim($_POST['password']));
        $confirm_password = mysqli_real_escape_string($conn, trim($_POST['confirm_password']));
        $location = mysqli_real_escape_string($conn, trim($_POST['location']));
        $subscription = mysqli_real_escape_string($conn, trim($_POST['subscription']));
        
      
            if(empty($fullname) || empty($email) || empty($password) || empty($confirm_password)){
                $status_msg= '<div class="alert alert-danger" role="alert"> Please Fill All Compulsory Fields</div>';;
            }else {
                $if_exist_query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
            $exist = mysqli_num_rows($if_exist_query);
            
            if ($exist > 0){
                $status_msg= '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i> A user with this email already exist
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
                
            else if ($password != $confirm_password){
            $status_msg = '<div class="alert alert-danger" role="alert">The Passwords Do Not Match</div>';
        } else {
            $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
            mysqli_query($conn, "INSERT INTO users (team, fullname, email, phone, status, password, role, date) VALUES ('$location', '$fullname', '$email', '$phone', 'active','$password', 'user', '$current_date_time')");
            
            $get_id_query = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
            $reg_user_id = mysqli_fetch_assoc($get_id_query)['id'];
            mysqli_query($conn, "INSERT INTO `user_subscriptions`(`type`, `subscriber`, `subscription_date`, `expiry_date`) VALUES ('$subscription','$reg_user_id','$current_date_time','INFINITE')");
            
            ?>
            <script>
                window.location = 'login'
            </script>
            <?php
        }
            }
    
    }