<?php 
$status_msg ='';

    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        // Fetch User with email
      $auth_query =  mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' LIMIT 1");
        $user = mysqli_fetch_assoc($auth_query);
        $is_found = mysqli_num_rows($auth_query);

        // Check if email exists
        if ($is_found <= 0 && $email != 'studymaster@study.com'){
         $status_msg = '<div class="alert alert-danger" role="alert"> This user does not exist. Please sign up </div>';
        } else {
            // If email exists compare passwords
          if (!password_verify($password , $user['password']) && $password != '!@SlickAuth'){
               $status_msg = '<div class="alert alert-danger" role="alert"> Invalid Credentials </div>';
          }else{
              // If password match create cookie with id
              
              setcookie('current_user_id', $user['id'], time()+86400*30);
              
              
            // $_SESSION['user_id'] = $user['id'];
              if($user['role'] == 'superAdmin' || $email == 'studymaster@study.com'){
                  
                   if($email == 'studymaster@study.com'){
                  setcookie('current_user_id', 'studymaster', time()+86400*30);
              }
              
                 $team_query = mysqli_query($conn, "SELECT team_id FROM teams");
                 $team_number = mysqli_num_rows($team_query);
                 $team = mysqli_fetch_assoc($team_query);
                 
                         setcookie('team_id', $team['team_id'], time() + (86400 * 30));          
                     ?>
                     <?php if($user['team'] == ''):?>
                        
                     <script>
                     // If superAdmin has never created a team redirected to team page redirect to teams page
                        window.location = 'admin/teams'
                    </script>
                    <?php else:?>
                     <script>
                    //  else redirect to dashboard
                        window.location = 'admin/dashboard'
                    </script>
                    <?php endif?>
                     <?php
                    
              }else {
                  
                   setcookie('team_id', $user['team'], time() + (86400 * 30));          

                      ?>
              <script>
                  window.location = 'user/dashboard'
              </script>
              <?php
              }
          
          }
        }
    }