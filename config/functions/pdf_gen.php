<?php

//Generate Book Report pdf
 function generate_book_pdf($conn, $start_date, $end_date) {
     $report = mysqli_query($conn, "SELECT * FROM books WHERE date BETWEEN '$start_date' AND '$end_date'");
$output = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Boostrap cdn links -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script></head>

<body>
    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							        <h4 class="text-center w-100"> Books Report from '. $start_date .' to ' .$end_date .' </h4>
							    <div class="table-responsive p-2">
							        <table class="table mb-0 text-left" id="data1">
										<thead>
											<tr>
												<th class="cell">Sn</th>
												<th class="cell">Book Added</th>
												<th class="cell">Type</th>
												<th class="cell">ISBN</th>
												<th class="cell">Copies</th>
												<th class="cell">Date Added</th>
											</tr>
										</thead>
										<tbody class="">';
									$index = 0;
		                    while($row = mysqli_fetch_assoc($report)){
		                        
		                        $index++;
		                        $book = $row['title'] . ' by ' . $row['author'];
		                        $isbn = $row['isbn'];
		                        $type = $row['type'];
		                        $copies = $row['copies'];
		                        $date = $row['date'];
		                        
		                        $output .= '<tr>
												<td class="cell"> ' . $index . ' . </td>
												<td class="cell"><span class="truncate"> ' .$book. ' </span></td>
												<td class="cell"><span class="truncate"> ' .$type. ' </span></td>
												<td class="cell"><span> ' .$isbn. ' </span></td>
												<td class="cell"><span> ' .$copies. ' </span></td>
												<td class="cell"><span> ' .$date. ' </span></td>
											</tr>';
		                    }								
							$output .= '</tbody>
									</table>
						        </div>
						    </div>		
						</div>
     </body>
</html>';
     return $output;
 }
 
// Generate Subscription Report  
 function generate_subscription_pdf($conn, $start_date, $end_date) {
     $report = mysqli_query($conn, "SELECT * FROM user_subscriptions WHERE subscription_date BETWEEN '$start_date' AND '$end_date'");
$output = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Boostrap cdn links -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script></head>

<body>
    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							        <h4 class="text-center w-100"> Subscriptions Report from '. $start_date .' to ' .$end_date .' </h4>
							    <div class="table-responsive p-2">
							        <table class="table mb-0 text-left" id="data1">
										<thead>
											<tr>
												<th class="cell">Sn</th>
												<th class="cell">Subscriber</th>
												<th class="cell">Subscription</th>
												<th class="cell">Subscription Date</th>
												<th class="cell">Expiry Date</th>
											</tr>
										</thead>
										<tbody class="">';
									$index = 0;
		                    while($row = mysqli_fetch_assoc($report)){
		                        
		                        $index++;
		                        $type = $row['type'];
		                        $subscriber = $row['subscriber'];
		                        $sub_date = $row['subscription_date'];
		                        $exp_date = $row['expiry_date'];
		                        
		                        $user_query = mysqli_query($conn, "SELECT fullname FROM users WHERE id='$subscriber'");
		                        $user_fullname = mysqli_fetch_assoc($user_query)['fullname'];
		                        
		                        $book_query = mysqli_query($conn, "SELECT name FROM subscription_plans WHERE id='$type'");
		                        $sub_name = mysqli_fetch_assoc($book_query)['name'];
		                        
		                        $output .= '<tr>
												<td class="cell"> ' . $index . ' . </td>
												<td class="cell"><span class="truncate"> ' .$user_fullname. ' </span></td>
												<td class="cell"><span class="truncate"> ' .$sub_name. ' </span></td>
												<td class="cell"><span> ' .$sub_date. ' </span></td>
												<td class="cell"><span> ' .$exp_date. ' </span></td>
											</tr>';
		                    }								
							$output .= '</tbody>
									</table>
						        </div>
						    </div>		
						</div>
     </body>
</html>';
     return $output;
 }
// Generate Downloads Report  
  function generate_downloads_pdf($conn, $start_date, $end_date) {
     $report = mysqli_query($conn, "SELECT * FROM books WHERE date BETWEEN '$start_date' AND '$end_date' AND type='e_book' AND downloads > 0");
$output = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Boostrap cdn links -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script></head>

<body>
    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							        <h4 class="text-center w-100"> E-Books Downloads Report from '. $start_date .' to ' .$end_date .' </h4>
							    <div class="table-responsive p-2">
							        <table class="table mb-0 text-left" id="data1">
										<thead>
											<tr>
												<th class="cell">Sn</th>
												<th class="cell">E-Book</th>
												<th class="cell">Downloads</th>
												<th class="cell">ISBN</th>
												<th class="cell">Date Added</th>
											</tr>
										</thead>
										<tbody class="">';
									$index = 0;
		                    while($row = mysqli_fetch_assoc($report)){
		                        
		                        $index++;
		                        $book = $row['title'] . ' by ' . $row['author'];
		                        $downloads = $row['downloads'];
		                        $isbn = $row['isbn'];
		                        $date = $row['date'];
		                        
		                        $output .= '<tr>
												<td class="cell"> ' . $index . ' . </td>
												<td class="cell"><span class="truncate"> ' .$book. ' </span></td>
												<td class="cell"><span class="truncate"> ' .$downloads. ' </span></td>
												<td class="cell"><span> ' .$isbn. ' </span></td>
												<td class="cell"><span> ' .$date. ' </span></td>
											</tr>';
		                    }								
							$output .= '</tbody>
									</table>
						        </div>
						    </div>		
						</div>
     </body>
</html>';
     return $output;
 }
 
 
 //Generate Book Circulation Report pdf
 function generate_book_circulation_pdf($conn, $start_date, $end_date) {
     $report = mysqli_query($conn, "SELECT * FROM `borrow_requests` WHERE date BETWEEN '$start_date' AND '$end_date'");
$output = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Boostrap cdn links -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script></head>

<body>
    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							        <h4 class="text-center w-100"> Books Circulation Report from '. $start_date .' to ' .$end_date .' </h4>
							    <div class="table-responsive p-2">
							        <table class="table mb-0 text-left" id="data1">
										<thead>
											<tr>
											    <th class="cell">Sn</th>
												<th class="cell">Book Requested</th>
												<th class="cell">Member</th>
												<th class="cell">Status</th>
												<th class="cell">Request Date</th>
												<th class="cell">Return Status</th>
											</tr>
										</thead>
										<tbody class="">';
									$index = 0;
		                    while($row = mysqli_fetch_assoc($report)){
		                        
		                                            $index++;
										            $id = $row['id'];
										            $book_id = $row['book_id'];
										            $borrower_id = $row['borrower_id'];
										            $due_date = $row['due_date'];
										            $status = $row['status'];
										            $return_status = $row['return_status'];
										            $date = $row['date'];
										            
										            //Fetch Borrower Details
										            $borrower_query = mysqli_query($conn, "SELECT fullname FROM users WHERE id='$borrower_id'");
										            $borrower_details = mysqli_fetch_assoc($borrower_query);
										            
										            $borrower_fullname = $borrower_details['fullname'];
										            
										            //Fetch Book Details
										            $book_query = mysqli_query($conn, "SELECT title, author FROM books WHERE id='$book_id'");
										            $details = mysqli_fetch_assoc($book_query);
										            $title = $details['title'];
										            $author = $details['author'];
		                        
		                        $output .= '<tr>
												<td class="cell"> ' .$index . ' </td>
												<td class="cell"><span class="truncate"> ' .$title . ' by ' . $author .' </span></td>
												<td class="cell"><span> '.ucwords($borrower_fullname) . '</span></td>
												<td class="cell"><span>'. ucfirst($status) . '</span></td>
												<td class="cell"><span> ' . $date . ' </span></td>
												<td class="cell"><span> ' . ucfirst($return_status) . '</span></td>
											</tr>';
		                    }								
							$output .= '</tbody>
									</table>
						        </div>
						    </div>		
						</div>
     </body>
</html>';
     return $output;
 }
 
 
 
 
 
 
 
 
 
 
 
 