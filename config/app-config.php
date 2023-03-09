<?php 
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
    if(empty($_COOKIE['current_user_id'])){
        ?>
        <script>
            window.location = '/lms/login'
        </script>
        <?php
    }else {
    
        $current_user_id = $_COOKIE['current_user_id'];
        
        
        
        $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$current_user_id'") ;
        $user_exist_check = mysqli_num_rows($query);
        
        // CHeck if the user exist or its studymaster
        if($user_exist_check <= 0 && $current_user_id == 'studymaster'){
            // Create an artificial array if its studymaster
            $user_details = ['fullname' => 'STUDYMASTER', 'role' => 'superAdmin', 'email' => 'studymaster@study.com'];
            $current_user_name = $user_details['fullname'];
            $current_user_role = $user_details['role'];
            $current_user_email = $user_details['email'];
            $get_teams_query = mysqli_query($conn, "SELECT team_id FROM teams");
            
            $active_teams='';
            while($get_team = mysqli_fetch_assoc($get_teams_query)){
                $active_teams .= $get_team['team_id'].',';
            }
            
                
        }else{
                $user_details = mysqli_fetch_assoc($query);
                
                $current_user_name = $user_details['fullname'];
                $current_user_role = $user_details['role'];
                $current_user_email = $user_details['email'];   
        }
        
       
       $current_user_team = $user_details['team'];
       $current_user_subscription = $user_details['subscription'];
       $current_user_status = $user_details['status'];
       $current_user_passport = $user_details['passport'];
       
       $current_team_id = $_COOKIE['team_id'];
        
        $active_teams = $user_details['active_team'];
        $active_team_array = explode(',', $active_teams);
        
        $client_abbreviation = 'LMS'
       
     
       ?>
       
       <?php
       // Pay stack key
       $pay_stack_test_key = 'pk_test_5dfb6392c7e501ee2c4146c295f056355549096a';
       
    //   email config
    
        date_default_timezone_set('UTC');
        $mailhost = 'binalgist.com.ng';
        $mailuser = '_mainaccount@binalgist.com.ng';
        $mailpassword = 't0Uf;Nm)p@_+';
        

        
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        
        // Instantiation and passing [ICODE]true[/ICODE] enables exceptions
        
        
        $mail = new PHPMailer(true);
        
        $mail->SMTPDebug = 0; // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = $mailhost ; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = $mailuser; // SMTP username
        $mail->Password = $mailpassword; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
        $mail->Port = 587; // TCP port to connect to
       
       $mail->setFrom($mailuser, 'BT Support');
}
?>