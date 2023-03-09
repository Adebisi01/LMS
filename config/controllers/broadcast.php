<?php 
$status_msg='';
    if(isset($_POST['broadcast'])){
     
        mysqli_query($conn, "INSERT INTO broadcast (team, category, subject, message, date) VALUES ('$active_teams','$category', '$subject', '$message', '$current_date_time')");
        
        mysqli_query($conn, "INSERT INTO `activity_log`(`team`, `date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name sent a broadcast message to $category')");
        
        // Mail function
        $target = $category == 'staff'?'admin':'users';
        $email_query = mysqli_query($conn, "SELECT fullname, email FROM users WHERE role='$target'");
        
        
             $mail->setFrom($mailuser, 'BT Support');
             $mail->addAddress('oluwafemi.a@binaltechnologies.com', 'Oluwafemi');
             while($row = mysqli_fetch_assoc($email_query)){
                $mail->addBCC($row['email']);
             }
            // $mail->addAddress('joe@example.net', 'Joe User');
            
            
            $mail->isHTML(true); // Set email format to HTML
             $mail->Subject = 'New Broadcast Message';
             $mail->Body = '<html><body style="margin:0 auto;">
                     <center>  <img src="https://binaltechnologies.com/assets/img/btheader.png" alt="BT Header" /><br/>
                      <table rules="all"  cellpadding="10">
                      <p style="font-size:17px; line-height: 28px"> A new Broadcast message has been sent. login <a href="https://binalgist.com.ng/lms/login">here</a> to view </p>
                        </table>
                    <img src="https://binaltechnologies.com/assets/img/btfooter.png" alt="BT Footer" /></center><br/>
                      </body></html>';

            $mail->send();


    }
    if(isset($_POST['delete_broadcast'])){
        
        if($word_check != 'DELETE'){
            $status_msg = $word_check_error_msg;
        }else{
            mysqli_query($conn, "DELETE FROM broadcast WHERE id='$del_id'");
            mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name deleted a broadcast message')");
        }
    }
?>