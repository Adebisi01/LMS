<!DOCTYPE html>
<?php require_once('include.php')?>
<?php //require_once('../config/functions/utilities.php')?>
<html lang="en"> 
<head>
    <title>Book Requests | <?=$app_title?></title>
    
    <!-- Meta -->
    
  <?php require_once('links.php') ?>

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>
    </header><!--//app-header-->
    <?php require_once('../config/controllers/requests.php') ?>
    <?php require_once('../config/controllers/borrow_book.php') ?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 ">
				    <div class="col-auto w-100 d-flex align-items-center justify-content-between">
			            <a href='requests'><h1 class="app-page-title mb-0">Books Circulation</h1></a>
			           <div>
			            <a href='due_books' ><button style='margin-top: 5px' class='btn btn-danger text-white'>Due Books</button></a>
			            <button style='margin-top: 5px' class='btn btn-primary text-white' data-bs-toggle="modal" data-bs-target="#physicalRequestModal">Physical Request</button>
			           </div>
				    </div>
				    
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							   
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			   
			    <?=$status_msg?>
			    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
				    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
				    <a class="flex-sm-fill text-sm-center nav-link"  id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Books Issued</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Pending</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">Disapproved</a>
				</nav>
				
				
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
												<th class="cell">Request Date</th>
												<th class="cell">Action</th>
											</tr>
										</thead>
										<tbody>
										    <?php
										    $index = 0;
										   $generated_request_query = gen_mul_team_query_without_where("SELECT * FROM `borrow_requests`", $active_team_array);
										    $requests = mysqli_query($conn, $generated_request_query." ORDER BY id DESC");
										        while($row = mysqli_fetch_assoc($requests)){
										            $index++;
										            $id = $row['id'];
										            $book_id = $row['book_id'];
										            $borrower_id = $row['borrower_id'];
										            $due_date = $row['due_date'];
										            $status = $row['status'];
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
                                                ?>
                                                <!--Approve modal-->
                                                <div class="modal fade" id="approveModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Approve</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                <textarea class='form-control' name='comment' required placeholder='Add your comment' style='min-height:100px'></textarea>
                                                            </div>
                                                          </div>
                                                          <input name='request_id' hidden value='<?=$id?>'/>
                                                          <input name='book_id' hidden value='<?=$book_id?>'/>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name='approve' class="btn btn-success text-white">Approve</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Approve modal ends-->
                                                      <!--Dispprove modal-->
                                                <div class="modal fade" id="disapproveModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Disapprove</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                <textarea class='form-control' name='comment' required placeholder='Add your comment' style='min-height:100px'></textarea>
                                                            </div>
                                                          </div>
                                                          <input name='request_id' hidden value='<?=$id?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='disapprove' class="btn btn-success text-white">Disapprove</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Disapprove modal ends-->
                                                      <!--Return modal-->
                                                <div class="modal fade" id="returnModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Acknowledge The Return Of This Book</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                <label for='return_status'>Return Status</label>
                                                                <select name='return_status' required class='form-control'>
                                                                    <option value='early'>
                                                                        On time
                                                                    </option>
                                                                    <option value='late'>
                                                                        Late
                                                                    </option>
                                                                </select>
                                                            </div>
                                                          </div>
                                                          <input name='request_id' hidden value='<?=$id?>'/>
                                                          <input name='book_id' hidden value='<?=$book_id?>'/>
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
												<td class="cell"><span><?=ucwords($borrower_fullname)?></span></td>
												<td class="cell"><span
												class="badge bg-<?=$color = $status =='pending'?'info': ($status == 'disapproved'? 'danger': 'success')?>"
												
												><?=ucfirst($status)?></span></td>
												<td class="cell"><span><?=$date?></span></td>
												<td style='width:10em'>
												    <?php if($status === 'pending'):?>
												        <button class='btn btn-success' title='Approve' data-bs-toggle="modal" data-bs-target="#approveModal<?=$id?>"><i class="bi bi-check-lg text-white"></i></button>
												        <button class='btn btn-danger' title='Disapprove' data-bs-toggle="modal" data-bs-target="#disapproveModal<?=$id?>"><i class="bi bi-x-lg text-white"></i></button>
												    <?php elseif($status == 'approved'):?>
												        <button class='btn btn-success' title='Approve return' data-bs-toggle="modal" data-bs-target="#returnModal<?=$id?>"><i class="bi bi-arrow-counterclockwise h5 text-white"></i></button>
												    <?php elseif($status == 'disapproved'):?>
												    <span class='text-seconday fst-italic'>Disapproved</span>
												    <?php elseif($status == 'returned'):?>
												    <span class='text-seconday fst-italic'>Returned</span>
												    <?php endif ?>
												   
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
						<!--<nav class="app-pagination">-->
						<!--	<ul class="pagination justify-content-center">-->
						<!--		<li class="page-item disabled">-->
						<!--			<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>-->
						<!--	    </li>-->
						<!--		<li class="page-item active"><a class="page-link" href="#">1</a></li>-->
						<!--		<li class="page-item"><a class="page-link" href="#">2</a></li>-->
						<!--		<li class="page-item"><a class="page-link" href="#">3</a></li>-->
						<!--		<li class="page-item">-->
						<!--		    <a class="page-link" href="#">Next</a>-->
						<!--		</li>-->
						<!--	</ul>-->
						<!--</nav><!--//app-pagination-->
						
			        </div><!--//tab-pane-->
			        <!--Approved Requests / Book Issued-->
			        <div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive p-2">
								    
							        <table class="table mb-0 text-left" id='data1'>
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
										<tbody class=''>
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
										            
										            //Fetch Borrower Details
										            $borrower_query = mysqli_query($conn, "SELECT fullname FROM users WHERE id='$borrower_id'");
										            $borrower_details = mysqli_fetch_assoc($borrower_query);
										            
										            $borrower_fullname = $borrower_details['fullname'];
										            
										            //Fetch Book Details
										            $book_query = mysqli_query($conn, "SELECT title, author FROM books WHERE id='$book_id'");
										            $details = mysqli_fetch_assoc($book_query);
										            $title = $details['title'];
										            $author = $details['author'];
										            
										            //Check if book is due
										            
										            $is_due = date_difference($approved_date, $current_date);
										            
										          //  var_dump("$borrow_duration || $is_due");
										          //  die();
										            
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
                                                            <div class='form-group'>
                                                                <label for='return_status'>Return Status</label>
                                                                <select name='return_status' required class='form-control'>
                                                                    <option value='early'>
                                                                        On time
                                                                    </option>
                                                                    <option value='late'>
                                                                        Late
                                                                    </option>
                                                                </select>
                                                            </div>
                                                          </div>
                                                          <input name='request_id' hidden value='<?=$id?>'/>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
												    <button class='btn btn-success' title='Approve return' data-bs-toggle="modal" data-bs-target="#tabreturnModal<?=$id?>"><i class="bi bi-arrow-counterclockwise h5 text-white"></i></button>
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
			        <!--Pending requests-->
			        <div class="tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive p-2">
							        <table class="table mb-0 text-left" id="data2">
										<thead>
											<tr>
												<th class="cell">Sn</th>
												<th class="cell">Book</th>
												<th class="cell">Member</th>
												<th class="cell">Status</th>
												<th class="cell">Borrow Duration</th>
												<th class="cell">Request Date</th>
												<th class="cell">Action</th>
											</tr>
										</thead>
										<tbody>
										     <?php
										    $index = 0;
										    $generated_request_query = gen_mul_team_query("SELECT * FROM `borrow_requests` WHERE status='pending'", $active_team_array);
										  //  var_dump($generated_request_query);
										  //  die();
										    $requests = mysqli_query($conn, $generated_request_query." ORDER BY id DESC");
										        while($row = mysqli_fetch_assoc($requests)){
										            $index++;
										            $id = $row['id'];
										            $book_id = $row['book_id'];
										            $duration = $row['borrow_duration'];
										            $borrower_id = $row['borrower_id'];
										            $status = $row['status'];
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
                                                ?>
                                                <!--Approve modal-->
                                                <div class="modal fade" id="tabapproveModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Approve</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                <textarea class='form-control' name='comment' required placeholder='Add your comment' style='min-height:100px'></textarea>
                                                            </div>
                                                          </div>
                                                          <input name='request_id' hidden value='<?=$id?>'/>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name='approve' class="btn btn-success text-white">Approve</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Approve modal ends-->
                                                      <!--Dispprove modal-->
                                                <div class="modal fade" id="tabdisapproveModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Disapprove</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                <textarea class='form-control' name='comment' required placeholder='Add your comment' style='min-height:100px'></textarea>
                                                            </div>
                                                          </div>
                                                          <input name='request_id' hidden value='<?=$id?>'/>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name='disapprove' class="btn btn-success text-white">Disapprove</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Disapprove modal ends-->
											<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span class="truncate"><?=$title . ' by ' . $author?></span></td>
												<td class="cell"><span class="truncate"><?=ucfirst($borrower_fullname)?></span></td>
												<td class="cell"><span class="badge bg-info"><?=ucfirst($status)?></span></td>
												<td class="cell"><span class="note"><?=$duration?> days</span></td>
												<td class="cell"><span class="note"><?=$date?></span></td>
												<td class="cell">
												        <button class='btn btn-success' title='Approve' data-bs-toggle="modal" data-bs-target="#tabapproveModal<?=$id?>"><i class="bi bi-check-lg text-white"></i></button>
												        <button class='btn btn-danger' title='Disapprove' data-bs-toggle="modal" data-bs-target="#tabdisapproveModal<?=$id?>"><i class="bi bi-x-lg text-white"></i></button>
												    </td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
			        
			        <!--Disapproved  Request-->
			        <div class="tab-pane fade" id="orders-cancelled" role="tabpanel" aria-labelledby="orders-cancelled-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive p-2">
							        <table class="table mb-0 text-left" id='data3'>
										<thead>
											<tr>
												<th class="cell">Sn</th>
												<th class="cell">Book</th>
												<th class="cell">Member</th>
												<th class="cell">Status</th>
												<th class="cell">Comment</th>
												<th class="cell">Request Date</th>
												<th class="cell">Action</th>
											</tr>
										</thead>
										<tbody>
												     <?php
										    $index = 0;
										    $generated_request_query = gen_mul_team_query("SELECT * FROM `borrow_requests` WHERE status='disapproved'", $active_team_array);
										    $requests = mysqli_query($conn, $generated_request_query." ORDER BY id DESC");
										        while($row = mysqli_fetch_assoc($requests)){
										            $index++;
										            $id = $row['id'];
										            $book_id = $row['book_id'];
										            $comment = $row['comment'];
										            $status = $row['status'];
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
                                                ?>
											<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span class="truncate"><?=$title . ' by ' . $author?></span></td>
												<td class="cell"><span class="truncate"><?=$borrower_fullname?></span></td>
												<td class="cell"><span class="badge bg-danger"><?=ucfirst($status)?></span></td>
												<td class="cell"><span class="note"><?=$comment?></span></td>
												<td class="cell"><span class="note"><?=$date?></span></td>
												<td class="cell">
												    <span class='text-seconday fst-italic'>Disapproved</span>
												</td>
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
<?php require_once('modal.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>
<script>
     var user_select = document.querySelector('#user_select');
     var book_select = document.querySelector('#book_select');

    dselect(user_select, {
        search: true
    });
    dselect(book_select, {
        search: true
    });
    
    // $(document).ready(function () {
    //     $("#date_picker").datepicker({
    //         minDate: 0
    //     });
    // });

</script>
</body>
</html> 

