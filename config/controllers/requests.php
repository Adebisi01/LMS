<?php
require_once('../config/variables.php');
$status_msg ='';
if(isset($_POST['approve']))
{
    
    $borrow_duration_query = mysqli_query($conn, "SELECT borrow_duration FROM borrow_requests WHERE id='$request_id'");
    
    $borrow_duration = mysqli_fetch_assoc($borrow_duration_query)['borrow_duration'];
    $due_date = date('d-m-Y', strtotime($current_date_time. " + $borrow_duration days"));
    
    $if_borrowed_query = mysqli_query($conn, "SELECT id FROM borrow_requests WHERE status='pending' AND id='$request_id'");
    $if_borrowed = mysqli_num_rows($if_borrowed_query);
    
    if($if_borrowed == 0){
        $status_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i> You already borrowed this book
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }else{
        mysqli_query($conn, "UPDATE borrow_requests SET comment='$comment', status='approved', approved_date ='$current_date_time', due_date='$due_date' WHERE id='$request_id'");
            // Getting Borrow request details
    $borrow_request_details_query = mysqli_query($conn, "SELECT * FROM borrow_requests WHERE id='$request_id'");
    $borrow_request_details = mysqli_fetch_assoc($borrow_request_details_query);
    
    $borrow_request_team = $borrow_request_details['team'];
    $borrow_request_borrower = $borrow_request_details['borrower_id'];
    $borrow_request_book = $borrow_request_details['book_id'];
        
        
    mysqli_query($conn, "UPDATE `books` SET `available`= available - 1, read_by = read_by + 1  WHERE id='$book_id' AND team='$borrow_request_team'");
            
            // Get Borrower Details
            $next_request_query = mysqli_query($conn, "SELECT fullname, email FROM users WHERE id='$borrow_request_borrower'");
            $borrower = mysqli_fetch_assoc($next_request_query);
            
            $borrower_fullname = $borrower['fullname'];
            
            // Get Book Details
            $book_query = mysqli_query($conn, "SELECT title, author FROM books WHERE id='$borrow_request_book'");
            $books = mysqli_fetch_assoc($book_query);
            
            $book_title = $books['title'];
            $book_author = $books['author'];
             
                // Add Details for mailing
                
                $mail->setFrom($mailuser, 'BT Support');
                $mail->addAddress($borrower['email'], $borrower['fullname']);
         
                
                
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'New Broadcast Message';
                $mail->Body = '<html><body style="margin:0 auto;">
                     <center>  <img src="https://binaltechnologies.com/assets/img/btheader.png" alt="BT Header" /><br/>
                      <table rules="all"  cellpadding="10">
                      <p style="font-size:17px; line-height: 28px"> Dear '. $borrower_fullname. ', the book- '.$book_title.' by '.$book_author.'- is now available for collection. If You do not come for it within
                      3 days, Your request will be forfeited. <br> Thanks</p>
                        </table>
                     <img src="https://binaltechnologies.com/assets/img/btfooter.png" alt="BT Footer" /></center><br/>
                      </body></html>';
                
                $mail->send();

    
    mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name approved a book request')");
    }
    
    
}
if(isset($_POST['disapprove']))
{
    
    mysqli_query($conn, "UPDATE borrow_requests SET comment='$comment', status='disapproved' WHERE id='$request_id'");
    mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$current_team_id','$current_date_time','$current_user_name disapproved a book request')");
}
if(isset($_POST['return']))
{
    $if_returned_query = mysqli_query($conn, "SELECT id FROM borrow_requests WHERE status='approved' AND id='$request_id'");
    $if_returned = mysqli_num_rows($if_returned_query);
    
    if($if_returned == 0){
        $status_msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i> This book has been returned
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }else{
        
    
    mysqli_query($conn, "UPDATE borrow_requests SET status='returned', return_status='$return_status' WHERE id='$request_id'");
    // Getting Borrow request details
    $borrow_request_details_query = mysqli_query($conn, "SELECT * FROM borrow_requests WHERE id='$request_id'");
    $borrow_request_details = mysqli_fetch_assoc($borrow_request_details_query);
    
    $borrow_request_team = $borrow_request_details['team'];
    $borrow_request_borrower = $borrow_request_details['borrower_id'];
    
    mysqli_query($conn, "UPDATE `books` SET `available`= available + 1 WHERE id='$book_id' AND team='$borrow_request_team'");
    
    
            // Get Borrower and Book ID
            $borrower_query = mysqli_query($conn, "SELECT borrower_id, book_id FROM pre_request WHERE status='pending' AND book_id ='$book_id' AND borrower_id='$borrow_request_borrower' LIMIT 1");
            $borrower_and_book = mysqli_fetch_assoc($borrower_query);;
            $borrower_id = $borrower_and_book['borrower_id'];
            $book_id = $borrower_and_book['book_id'];
            
            $pre_request_exist = mysqli_num_rows($borrower_query);
            if($pre_request_exist > 0){
                
            
            // Get Borrower Details
            $next_request_query = mysqli_query($conn, "SELECT fullname, email FROM users WHERE id='$borrower_id'");
            $borrower = mysqli_fetch_assoc($next_request_query);
            
            $borrower_fullname = $borrower['fullname'];
            
            // Get Book Details
            $book_query = mysqli_query($conn, "SELECT title, author FROM books WHERE id='$book_id'");
            $books = mysqli_fetch_assoc($book_query);
            
            $book_title = $books['title'];
            $book_author = $books['author'];
                // Add Details for mailing
                
                $mail->setFrom($mailuser, 'BT Support');
                $mail->addAddress($borrower['email'], $borrower['fullname']);
         
                
                
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'New Broadcast Message';
                $mail->Body = '<html><body style="margin:0 auto;">
                     <center>  <img src="https://binaltechnologies.com/assets/img/btheader.png" alt="BT Header" /><br/>
                      <table rules="all"  cellpadding="10">
                      <p style="font-size:17px; line-height: 28px"> Dear '. $borrower_fullname. ', the book- '.$book_title.' by '.$book_author.'- is now available. Login to Edu-Slick Study to request for this book. <br> Thanks</p>
                        </table>
                     <img src="https://binaltechnologies.com/assets/img/btfooter.png" alt="BT Footer" /></center><br/>
                      </body></html>';
                
                $mail->send();
            }
            
    $request_book_id = $borrow_request_details['book_id'];
    $request_borrower_id = $borrow_request_details['borrower_id'];
    //Get request Borrower Fullname
   $request_borrower_query = mysqli_query($conn, "SELECT fullname FROM users WHERE id='$request_borrower_id'");
   $borrower_fullname = mysqli_fetch_assoc($request_borrower_query)['fullname'];
   // Get request book title
   $request_book_query = mysqli_query($conn, "SELECT title FROM books WHERE id='$request_book_id'");
   $book_title = mysqli_fetch_assoc($request_book_query)['title'];
    
    
    mysqli_query($conn, "INSERT INTO `activity_log`(`team`,`date`, `activity`) VALUES ('$active_teams','$current_date_time','$current_user_name acknowledge the return of the book $book_title by $borrower_fullname')");
    }
}