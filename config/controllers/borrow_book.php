<?php 
require_once('../config/variables.php');
require_once('../config/functions/utilities.php');
$status_msg ='';
if(isset($_POST['borrow_book'])){
    
    
 
    // calculate book borrow duration

        $days = date_difference($current_date, $return_date);
     
        $request_exist = request_exist($conn, $current_user_id, $book_id);
     
     if($request_exist == true){
          $status_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i> You already requested for or borrowed this book
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
     }else{
         // Check if user is eligible to borrow books
         
         $is_user_eligible = is_user_eligible($conn, $current_user_subscription, $book_sub);
         
         
         
         if($is_user_eligible == false){
            $sub_name_query = mysqli_query($conn, "SELECT name FROM subscription_plans WHERE id='$book_sub'");
            $sub_name = mysqli_fetch_assoc($sub_name_query)['name'];
             
              $status_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i> You have to be a ' .$sub_name. ' member before you can have access to this Book. Click <a href="subscribe"> here </a> to subscribe. 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            
         }else{
                mysqli_query($conn, "INSERT INTO `borrow_requests`(`team`,`borrower_id`,`borrow_duration`, `book_id`, `due_date`, `status`, `date`) VALUES ('$current_team_id','$current_user_id', '$days','$book_id', '$return_date', 'pending','$current_date_time')");
                
                mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$current_team_id','$current_date_time','$current_user_name requested the book - $title  by $author')");
                $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-check"></i>  You have successfully requested the book - ' .$title .' by '. $author.' 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div> ';
         }
         
     }
    
 
}
    if(isset($_POST['pre_request'])){
                $days = date_difference($current_date, $return_date);
                
       $pre_request_exist_query = mysqli_query($conn, "SELECT * FROM pre_request WHERE book_id ='$book_id' AND status='pending' AND borrower_id='$current_user_id' LIMIT 1");
       $pre_request_exist = mysqli_num_rows($pre_request_exist_query);
       if ($pre_request_exist > 0){
           $status_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i> You Already Pre-Requested This book. You will contacted when it is available
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
       }else{
           mysqli_query($conn, "INSERT INTO `pre_request`(`team`, `borrower_id`, `book_id`,`duration`,`status`, `pre_request_date`) VALUES ('$current_team_id','$current_user_id','$book_id', '$days', 'pending','$current_date_time')");
        
        mysqli_query($conn, "INSERT INTO `notification`(`team`, `date`, `activity`) VALUES ('$current_team_id','$current_date_time', '$current_user_name Pre Requested the book- $title by $author')");
        
        $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully pre-requested the book - ' . $title. ' by '. $author .'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
       }
        
        
    }
    if(isset($_POST['physical_request'])){
        //Get User Details
        $user_query = mysqli_query($conn, "SELECT team, fullname,subscription FROM users WHERE id='$user_id'");
        $user_detail = mysqli_fetch_assoc($user_query);
        $user_team = $user_detail['team'];
        $user_fullname = $user_detail['fullname'];
        $user_subscription = $user_detail['subscription'];
        
        
        //Get Book Details
        $book_query = mysqli_query($conn, "SELECT title,author,subscription FROM books WHERE id='$book_id'");
        $book_details = mysqli_fetch_assoc($book_query);
        $book_title = $book_details['title'];
        $book_author = $book_details['author'];
        $book_subscription = $book_details['subscription'];
        
        $borrow_days = date_difference($current_date, $return_date);
        
        $is_user_eligible = is_user_eligible($conn, $user_subscription, $book_subscription);
        $request_exist = request_exist($conn, $user_id, $book_id);
        
       
        
        if($request_exist == true){
          $status_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i> You already requested for or borrowed this book for '. $user_fullname .' 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }else if($is_user_eligible == false){
          $status_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i> This user is not eligible to borrow this book
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
         }else{
             
         
            mysqli_query($conn, "INSERT INTO `borrow_requests`(`team`,`borrower_id`,`borrow_duration`, `book_id`, `due_date`, `status`, `date`) VALUES ('$user_team','$user_id', '$borrow_days','$book_id', '$return_date', 'pending','$current_date_time')");
           
            $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully requested the book - ' . $book_title. ' by '. $book_author .' for '.$user_fullname.' 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            mysqli_query($conn, "INSERT INTO `notification`(`team`, `date`, `activity`) VALUES ('$current_team_id','$current_date_time', '$current_user_id requested the book- $book_title by $book_author for $user_fullname')");
        }
    }
        

?>