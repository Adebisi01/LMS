<!DOCTYPE html>
<?php require_once('include.php')?>


<html lang="en"> 
<head>
    <title>Book Requests - <?=$app_title?></title>
    
    <!-- Meta -->
    <?php require_once('links.php') ?>


</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>

    </header><!--//app-header-->
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Requests</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			   
			    
			    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
				    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
				    <a class="flex-sm-fill text-sm-center nav-link"  id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Pending</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Approved</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">Disapproved</a>
				</nav>
				
				
		   <!--ALL REQUESTS -->
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive p-2">
							        <table class="table app-table-hover mb-0 text-left" id='data'>
										<thead>
											<tr>
												<th class="cell">#</th>
												<th class="cell">Book</th>
												<th class="cell">Status</th>
												<th class="cell">Request Date</th>
											</tr>
										</thead>
										<tbody>
										    <?php 
										    $index = 0;
										    $request = mysqli_query($conn, "SELECT * FROM borrow_requests WHERE borrower_id = '$current_user_id' AND team='$current_team_id' ORDER BY id DESC") ;
										    while($row = mysqli_fetch_assoc($request)) {
										            $index++;
										            
										            $borrower_id = $row['borrower_id'];
										            $book_id = $row['book_id'];
										            $status = $row['status'];
										            $date = $row['date'];
										            
										           $book_query = mysqli_query($conn, "SELECT title, author FROM books WHERE id='$book_id'");
										           $details = mysqli_fetch_assoc($book_query);
										           
										            $title = $details['title'];
										            $author = $details['author'];
										           
										       ?> 
										   
										    
											<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span class="truncate"><?=$title . ' by '. $author?></span></td>
												<td class="cell"><span class="badge bg-badge bg-<?=$color = $status =='pending'?'info': ($status == 'disapproved'? 'danger': 'success')?>"><?=ucfirst($status)?></span></td>
												<td class="cell"><span><?=$date?></span></td>
									
											</tr>
											<?php
										    }
										?>
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
			        
			<!--PENDING REQUESTS-->
			        <div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive p-2">
								    
							        <table class="table mb-0 text-left" id='data1'>
										<thead>
											<tr>
												<th class="cell">#</th>
												<th class="cell">Book</th>
												<th class="cell">Status</th>
												<th class="cell">Request Date</th>
											</tr>
										</thead>
										<tbody>
										
										 <?php 
										    $index = 0;
										    $request = mysqli_query($conn, "SELECT * FROM borrow_requests WHERE borrower_id = '$current_user_id' AND status ='pending' AND team='$current_team_id'") ;
										    while($row = mysqli_fetch_assoc($request)) {
										            $index++;
										            
										            $borrower_id = $row['borrower_id'];
										            $book_id = $row['book_id'];
										            $status = $row['status'];
										            $date = $row['date'];
										            
										           $book_query = mysqli_query($conn, "SELECT title, author FROM books WHERE id='$book_id'");
										           $details = mysqli_fetch_assoc($book_query);
										           
										            $title = $details['title'];
										            $author = $details['author'];
										           
										       ?> 
											<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span class="truncate"><?=$title . ' by '. $author?></span></td>
												<td class="cell"><span class="badge bg-info"><?=ucfirst($status)?></span></td>
												<td class="cell"><span><?=$date?></span></td>
											</tr>
										<?php 
										    }
										    ?>
		
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
			        
				<!--APPROVED REQUESTS-->
			        <div class="tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive p-2">
							        <table class="table mb-0 text-left" id='data2'>
										<thead>
											<tr>
												<th class="cell">#</th>
												<th class="cell">Book</th>
												<th class="cell">Status</th>
												<th class="cell">Request Date</th>
												<th class="cell">Due Date</th>
											</tr>
										</thead>
										<tbody>
										     <?php 
										    $index = 0;
										    $request = mysqli_query($conn, "SELECT * FROM borrow_requests WHERE borrower_id = '$current_user_id' AND status ='approved' AND team='$current_team_id'") ;
										    while($row = mysqli_fetch_assoc($request)) {
										            $index++;
										            
										            $borrower_id = $row['borrower_id'];
										            $book_id = $row['book_id'];
										            $status = $row['status'];
										            $date = $row['date'];
										            $due_date = $row['due_date'];
										            
										           $book_query = mysqli_query($conn, "SELECT title, author FROM books WHERE id='$book_id'");
										           $details = mysqli_fetch_assoc($book_query);
										           
										            $title = $details['title'];
										            $author = $details['author'];
										           
										       ?> 
											<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span class="truncate"><?=$title . ' by '. $author?></span></td>
												<td class="cell"><span class="badge bg-success"><?=ucfirst($status)?></span></td>
												<td class="cell"><span><?=$date?></span></td>
												<td class="cell"><span><?=$due_date?></span></td>
											</tr>
											<?php }
										    ?>
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
			        
			        <!--REJECTED REQUESTS-->
			        <div class="tab-pane fade" id="orders-cancelled" role="tabpanel" aria-labelledby="orders-cancelled-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive p-2">
							        <table class="table mb-0 text-left" id='data3'>
										<thead>
											<tr>
												<th class="cell">#</th>
												<th class="cell">Book</th>
												<th class="cell">Status</th>
												<th class="cell">Request Date</th>
											</tr>
										</thead>
										
										<tbody>
									<?php 
										    $index = 0;
										    $request = mysqli_query($conn, "SELECT * FROM borrow_requests WHERE borrower_id = '$current_user_id' AND status ='disapproved' AND team='$current_team_id'") ;
										    while($row = mysqli_fetch_assoc($request)) {
										            $index++;
										            
										            $borrower_id = $row['borrower_id'];
										            $book_id = $row['book_id'];
										            $status = $row['status'];
										            $date = $row['date'];
										            
										           $book_query = mysqli_query($conn, "SELECT title, author FROM books WHERE id='$book_id'");
										           $details = mysqli_fetch_assoc($book_query);
										           
										            $title = $details['title'];
										            $author = $details['author'];
										           
										       ?>
											<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span class="truncate"><?=$title . ' by '. $author?></span></td>
												<td class="cell"><span class="badge bg-danger"><?=ucfirst($status)?></span></td>
												<td class="cell"><span><?=$date?></span></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
				</div><!--//tab-content-->
				
				
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
<?php require_once('footer.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>

</body>
</html> 

