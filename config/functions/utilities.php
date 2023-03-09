<?php
    
    function date_difference($previous_date, $latest_date){
            $date1 = str_replace('/','-', $previous_date);
            $date2 = str_replace('/','-',$latest_date);
            $diff = abs(strtotime($date2) - strtotime($date1));
            $days = $diff/(60*60*24);
        return floor($days);
        
        
        
    }
    // function add_date($date, $num_of_days){
    //     if($num_of_days == 'INFINITE'){
    //         return 'INFINITE';
    //     }else{
    //         return $due_date = date('d-m-Y', strtotime($date. " + $num_of_days days"));
    //     }
    // }
    function add_dates($date, $num_of_days){
        if($num_of_days == 'INFINITE'){
            return 'INFINITE';
        }else{
            return $date_sum = date('d-m-Y', strtotime($date. " + $num_of_days days"));
        }
    }
    function is_user_eligible($conn, $user_sub, $book_sub){
        
        $user_sub_level_query = mysqli_query($conn, "SELECT level FROM subscription_plans WHERE id='$user_sub'");
         $user_sub_level = mysqli_fetch_assoc($user_sub_level_query)['level'];
         
         $book_sub_level_query = mysqli_query($conn, "SELECT level FROM subscription_plans WHERE id='$book_sub'");
         $book_sub_level = mysqli_fetch_assoc($book_sub_level_query)['level'];

         if($user_sub_level < $book_sub_level){
          return false;
         }else{
             return true;
         }
    }
    function request_exist($conn, $user_id, $book_id){
         $request_exist_query =   mysqli_query($conn, "SELECT * FROM borrow_requests WHERE (status='pending' || status='approved') AND borrower_id='$user_id' AND book_id ='$book_id'");
        $request_exist = mysqli_num_rows($request_exist_query);
        
        if($request_exist > 0){
          return true;
        }else{
            return false;
        }
    }