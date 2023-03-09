<?php 
require_once('../config/variables.php');
$status_msg ='';
if(isset($_POST['suggest_book'])){
    
    mysqli_query($conn, "INSERT INTO `suggested_books`(`team`,`user_id`, `title`, `author`, `status`, `date`) VALUES ('$current_team_id','$current_user_id', '$title', '$author', 'unhonored','$current_date' )");
    
    $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-check"></i>  You have successfully suggested the book - ' .$title .' by '. $author.' 
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
     
         mysqli_query($conn, "INSERT INTO `activity_log`(`team `,`date`, `activity`) VALUES ('$current_team_id','$current_date_time','$current_user_name suggested a book')");

}


?>