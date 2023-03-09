<?php
    require_once('../db.php');
    if(isset($_POST['book_id'])){
        
        $book_id = $_POST['book_id'];
        $book_price = $_POST['price'];
        $puchaser_id = $_POST['purchaser'];
        $team = $_POST['team'];
        
        mysqli_query($conn, "INSERT INTO `purchased_books`(`team`,`book`, `amount`, `purchaser`, `date`) VALUES ('$team','$book_id','$book_price','$puchaser_id','$current_date_time')");
    }
?>