<?php
require_once('../config/functions/query_functions.php');
require_once('../config/variables.php');
$status_msg = '';
    if(isset($_POST['add_book'])){
           // Genre still coming as array . over riding it here
           $genre = $_POST['genre'];
           // Register Hard Copy of Book
          if ($book_type == 'hard_copy')
          {
            $generated_query = gen_mul_team_query("SELECT id FROM books WHERE isbn = '$isbn'", $staff_team);
            $check_query = mysqli_query($conn, $generated_query);
            $exist = mysqli_num_rows($check_query);
            
            if ($exist > 0){
               $status_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i>  This book is already registered. Update the book to increase the number of copies
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
           }else
           {
              
              // Check file extention if jpg or png
             $ext = explode('.', $cover)[1];
              if ($ext != 'jpg' && $ext != 'png'){
                  $status_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i>  The file format '. $ext .' is not supported. Upload a JPG or PNG file for Book Cover
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
              } else{
                 
                    move_uploaded_file($cover_tmp, "../assets/covers/$rand$cover");
                foreach($staff_team as $key => $value){
                    mysqli_query($conn, "INSERT INTO books(team, title, author, pages, status, subscription, copies, available, isbn, category, language, edition, publish_year, cover, type, location, description,  date) VALUES('$value','$title','$author', '$pages', 'active','$subscription','$copies','$copies', '$isbn', '$genre', '$language', '$edition', '$publish_year', '$rand$cover', '$book_type', '$location', '$description','$current_date_time')");
                }   
                    $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully added the book - ' . $title. '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    
                     mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name added the book -  $title')");
              }
              }
           
            }
        // Register E-BOOK
       else if ($book_type == 'e_book'){
            $check_query = mysqli_query($conn, "SELECT id FROM books WHERE isbn = '$isbn' AND type='e_book'");
            $exist = mysqli_num_rows($check_query);
            
            if ($exist > 0){
           $status_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i>  This book is already registered. Update the book to increase the number of copies
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
           }else
           {
            if($source == 'file')
            {
                // CHeck file extention
                $cov_ext = explode('.', $cover)[1];
                $ext = explode('.', $file)[1];
                
                if($ext != 'pdf' && $ext != 'epub' && $ext != 'mobi'){
                    $status_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i>  The file format '. $ext .' is not supported. Upload a PDF, EPUB or MOBI file for E-book File
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                else{
                
                    $rand_cover = $rand . explode(".", $file)[0] . ".png";
                    $imagick = new Imagick();
                    $imagick->readImage($tmp_file.'[0]');
                    $imagick->writeImages("../assets/covers/$rand_cover", false);
                 
                    move_uploaded_file($tmp_file, "../assets/books/$rand$file");
                    
                    mysqli_query($conn, "INSERT INTO books(title, author, type, status, price, pages, isbn, category, language, edition, publish_year, file, cover,  description, date) VALUES('$title','$author', '$book_type', 'active','$price', '$pages', '$isbn', '$genre', '$language', '$edition', '$publish_year','$rand$file', '$rand_cover', '$description', '$current_date_time')");
                
                    $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully added the E-Book - ' . $title. '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
               
                }
            }else if($source == 'link')
            {
                mysqli_query($conn, "INSERT INTO books(team, title, author, type, status, pages, copies, isbn, category, language, edition, publish_year, url, description, date) VALUES('$current_team_id','$title','$author', '$book_type', 'active', '$pages','$copies', '$isbn', '$genre', '$language', '$edition', '$publish_year','$link', '$description', '$current_date_time')");
                
                $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully added the E-Book - ' . $title. '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                
            }
             mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name added the E-Book - $title')");
        }
       }
      
    }
    // Updating book
    if(isset($_POST['update_book'])){
        
            $genre = $_POST['genre'];
        if ($book_type == 'hard_copy')
            {
                mysqli_query($conn, "UPDATE books SET title = '$title', author = '$author', pages = '$pages', subscription = '$subscription', copies = '$copies', isbn = '$isbn', category = '$genre', language = '$language', edition = '$edition', publish_year = '$publish_year', type = '$book_type', location = '$location', description = '$description' WHERE id='$book_id'") ;
            }
        else if($book_type == 'e_book'){
             mysqli_query($conn, "UPDATE books SET title = '$title', author = '$author', price = '$price', pages = '$pages', isbn = '$isbn', category = '$genre', language = '$language', edition = '$edition', publish_year = '$publish_year',  description = '$description' WHERE id= '$book_id'") ;

        }
        
        
        
        // mysqli_query($conn, "UPDATE books SET title='$title', author='$author', pages='$pages', copies='$copies', isbn='$isbn', category='$genre' WHERE id = '$book_id'");
        $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully updated the book - ' . $title. '  
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
         mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name updated the book - $title ')");
    }
    
    if(isset($_POST['archive_book'])){
        
        mysqli_query($conn, "UPDATE books SET status='archived', reason='$reason' WHERE id='$book_id'");
        $status_msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fas fa-check-circle"></i>  You successfully archived the book -  ' . $title. '  
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
         mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name archived the book - $title')");
    }

?>