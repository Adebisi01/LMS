<?php 
$status_msg='';
    if(isset($_POST['reply_feedback'])){
     
        mysqli_query($conn, "UPDATE feedbacks SET reply='$reply_msg' WHERE id ='$reply_id'");
        
        mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name replied the $reply_subject feedback message')");
        
          // Mail function
        $target = $category == 'staff'?'admin':'users';
        $email_query = mysqli_query($conn, "SELECT fullname, email FROM users WHERE id='$sender'");
        
        
             
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
                      <p style="font-size:17px; line-height: 28px"> We replied you feedback. login <a href="https://binalgist.com.ng/lms/login">here</a> to view </p>
                        </table>
                    <img src="https://binaltechnologies.com/assets/img/btfooter.png" alt="BT Footer" /></center><br/>
                      </body></html>';

            $mail->send();

    }
    if(isset($_POST['send_feedback'])){
        
        mysqli_query($conn, "INSERT INTO feedbacks (team, sender, subject, message, date) VALUES ('$current_team_id', '$current_user_id', '$subject', '$message', '$current_date_time')");
        
        $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully sent a feedback message
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
        mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$current_team_id','$current_date_time','$current_user_name sent a feedback message')");

    }
    if(isset($_POST['delete_feedback'])){
        
        mysqli_query($conn, "DELETE FROM feedbacks WHERE id ='$feedback_id'");
         $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully deleted a feedback message
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
        mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$current_team_id','$current_date_time','$current_user_name deleted a feedback message with subject - $feedback_subject')");
    }
  
?>