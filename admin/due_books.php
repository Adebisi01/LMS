<!DOCTYPE html>
<?php require_once('include.php')?>
<?php require_once('../config/functions/query_functions.php')?>
<?php require_once('../config/functions/utilities.php')?>
<html lang="en"> 
<head>
    <title>Due Books | <?=$app_title?></title>
    
    <!-- Meta -->
    
  <?php require_once('links.php') ?>

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>

    </header><!--//app-header-->
    <?php require_once('../config/controllers/requests.php') ?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Due Books</h1>
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
			    
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
						        
							    <div class="table-responsive p-2">
							        <table class="table table-striped app-table-hover mb-0 text-left" id='data'>
										<thead>
											<tr>
												<th class="cell">Sn</th>
												<th class="cell">Book</th>
												<th class="cell">Member</th>
												<th class="cell">Status</th>
												<th class="cell">Due Date</th>
												<th class="cell">Request Date</th>
												<th class="cell">Action</th>
											</tr>
										</thead>
										<tbody>
										    <?php
										    $index = 0;
										    $generated_request_query = gen_mul_team_query("SELECT * FROM `borrow_requests` WHERE status='approved'", $active_team_array);
										     $requests = mysqli_query($conn, $generated_request_query."  ORDER BY id DESC");
										        while($row = mysqli_fetch_assoc($requests)){
										            $index++;
										            $id = $row['id'];
										            $book_id = $row['book_id'];
										            $due_date = $row['due_date'];
										            $approved_date = $row['approved_date'];
										            $borrower_id = $row['borrower_id'];
										            $status = $row['status'];
										            $date = $row['date'];
										            $borrow_duration = $row['borrow_duration'];
										            $is_due = date_difference($approved_date, $current_date);
										            
										            if($is_due < $borrow_duration){
										                continue;
										            }
										            
										            //Fetch Borrower Details
										            $borrower_query = mysqli_query($conn, "SELECT fullname FROM users WHERE id='$borrower_id'");
										            $borrower_details = mysqli_fetch_assoc($borrower_query);
										            
										            $borrower_fullname = $borrower_details['fullname'];
										            
										            //Fetch Book Details
										            $book_query = mysqli_query($conn, "SELECT title, author FROM books WHERE id='$book_id' AND team='$current_team_id'");
										            $details = mysqli_fetch_assoc($book_query);
										            $title = $details['title'];
										            $author = $details['author'];
										            
										            
                                                ?>
                                                <!--Return modal-->
                                                <div class="modal fade" id="tabreturnModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Acknowledge The Return Of This Book</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                           <h4 class='text-danger'> Do You Acknowledge The Return Of This Book?</h4>
                                                          </div>
                                                          <input name='return_status' hidden value='late'/>
                                                          <input name='request_id' hidden value='<?=$id?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='return' class="btn btn-success text-white">Acknowledge</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                <!--Return modal ends-->
											<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span class="truncate"><?=$title . ' by ' . $author?></span></td>
												<td class="cell"><span><?=ucfirst($borrower_fullname)?></span></td>
										
												<td class="cell"><span class="badge bg-success"><?=ucfirst($status)?></span></td>
												<td class="cell"><span class="note <?=$due = $is_due > $borrow_duration ?'text-danger': ''?>"><?=$due_date?></span></td>
												<td class="cell"><?=$date?></td>
												<td class="cell">
												    <button class='btn btn-success ' title='Approve return' data-bs-toggle="modal" data-bs-target="#tabreturnModal<?=$id?>"><i class="bi bi-arrow-repeat h5 text-white"></i></button>
												</td>
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
			        <!--Active Users-->
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
<?php require_once('footer.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>
</body>
</html> 

