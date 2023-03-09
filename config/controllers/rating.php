<?php
require_once('../db.php');
require_once('../app-config.php');

        if(isset($_POST['book_id'])){
            $book_id = $_POST['book_id'];
            $user_review = $_POST['user_review'];
            $rating = $_POST['rating_data'];
            
            
            mysqli_query($conn, "INSERT INTO `rating`(`book_id`, `rater`, `rating`, `review`, `date`) VALUES ('$book_id','$current_user_id','$rating','$user_review','$current_date_time')");
            
            
        }
        if(isset($_POST['load_data'])){
            $five_star_review = 0;
            $four_star_review = 0;
            $three_star_review = 0;
            $two_star_review = 0;
            $one_star_review = 0;
            
            
            $book_id = $_POST['load_data'];
            
           $rating_query = mysqli_query($conn, "SELECT * FROM rating WHERE book_id ='$book_id'");
        //   $ratings = mysqli_fetch_assoc($rating_query);
            $total_rating = mysqli_num_rows($rating_query);
   
            while($rating = mysqli_fetch_assoc($rating_query)){
                if($rating['rating'] == 5){
                    $five_star_review++;
                }
                else if($rating['rating'] == 4){
                    $four_star_review++;
                }
                else if($rating['rating'] == 3){
                    $three_star_review++;
                }
                else if($rating['rating'] == 2){
                    $two_star_review++;
                }
                else if($rating['rating'] == 1){
                    $one_star_review++;
                }
                
            }
            $output = ['five_star_review' => $five_star_review, 'four_star_review' => $four_star_review , 'three_star_review' => $three_star_review, 'two_star_review' => $two_star_review, 'one_star_review' => $one_star_review, 'total_review' => $total_rating];
            echo json_encode($output);
            
        }
?>