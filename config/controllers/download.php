<?php 
    require_once('../db.php');

    if(isset($_POST['e_book_id'])){
        $e_book_id = $_POST['e_book_id'];
        mysqli_query($conn, "UPDATE books SET downloads = downloads + 1 WHERE id='$e_book_id' ");
    }
?>