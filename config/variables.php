<?php
        $word_check_error_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i>  Wrong word text. Type in the correct word
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        $team_id = $_COOKIE['team_id'];
        $app_title = 'LMS';
        $status_msg = '';
        $title = $_POST['title'];
        $author = $_POST['author'];
        $book_sub = $_POST['book_sub'];
        $pages = $_POST['pages'];
        $copies = $_POST['copies'];
        $isbn = $_POST['isbn'];
        $genre = $_POST['genre'];
        $staff_team = $_POST['staff_team'];
        
      
        $book_id = $_POST['book_id'];
        $return_date = $_POST['return_date'];
        
     
        $url = $_POST['url'];
        $publish_year = $_POST['publish_year'];
        $edition = $_POST['edition'];
        $description = $_POST['description'];
        $language = $_POST['language'];
        $subscription = $_POST['subscription'];
        $price = $_POST['price'];
    
        $book_type = $_SESSION['book_type'];
        $location = $_POST['location'];
        $comment =  $_POST['comment'];
        $request_id =  $_POST['request_id'];
        
        $return_status = $_POST['return_status'];
        
        $cover = $_FILES['cover']['name'];
        $cover_tmp = $_FILES['cover']['tmp_name'];
        
        $rand =  rand(10000000, 999999999);
        
        $file = $_FILES['file']['name'];
        $tmp_file = $_FILES['file']['tmp_name'];
        

        
        $source = $_POST['source'];
        $link = $_POST['url'];
        
        $restore_id = $_POST['restore_id'];
        $blacklist_id = $_POST['blacklist_id'];
        $reason = $_POST['reason'];
        $amount = $_POST['amount'];
        $user_id = $_POST['user_id'];
        
        $archive_id = $_POST['archive_id'];
        $inactive_id = $_POST['inactive_id'];
        $fullname = $_POST['fullname'];
        $word_check = $_POST['word_check'];
        $category = $_POST['category'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $del_id = $_POST['del_id'];
        
        $reply_id = $_POST['reply_id'];
        $reply_msg = $_POST['reply_msg'];
        $reply_subject = $_POST['reply_subject'];
        $feedback_id = $_POST['feedback_id'];
        $feedback_subject = $_POST['feedback_subject'];
        
        
        $team_id = $_POST['team_id'];
        $team_name = $_POST['team_name'];

        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $new_password = $_POST['new_password'];
        $staff_id = $_POST['staff_id'];
        $user_fullname = $_POST['user_fullname'];
        $user_team = $_POST['user_team'];
        $user_passport = $_FILES['user_passport']['name'];
        $user_passport_tmp = $_FILES['user_passport']['tmp_name'];
        $user_type = $_POST['user_type'];
        $user_id = $_POST['user_id'];
        
        $plan_name = strtoupper($_POST['plan_name']);
        $plan_price = $_POST['plan_price'];
        $plan_level = $_POST['plan_level'];
        $plan_duration = $_POST['plan_duration'];
        
        
        $team_name = strtoupper(htmlspecialchars($_POST['team_name']));
        $location = htmlspecialchars($_POST['location']);
        
        $abrv = strtoupper(substr($team_name, 0, 3));
        $team_id = $abrv.rand(100000,999999);
        
    

        
        