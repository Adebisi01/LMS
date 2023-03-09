<!DOCTYPE html>
<?php require_once('include.php')?>
<html lang="en"> 
<head>
    <title>Feedbacks | <?=$app_title?></title>
    
    <!-- Meta -->
    
  <?php require_once('links.php') ?>

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>

    </header><!--//app-header-->
    <?php require_once('../config/controllers/feedbacks.php') ?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto w-100 d-flex justify-content-between">
			            <h1 class="app-page-title mb-0">Feedbacks</h1>
			            <button class='btn btn-primary text-white' data-bs-toggle="modal" data-bs-target="#feedbackModal">Send Feedback</button>
			            <!--<button class='btn btn-primary text-white' data-bs-toggle="modal" data-bs-target="#broadcastModal">Send Broadcast</button>-->
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
			    <?=$status_msg?>
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
						        
							    <div class="table-responsive p-2">
							        <table class="table table-striped app-table-hover mb-0 text-left" id='data'>
										<thead>
											<tr>
												<th class="cell">Sn</th>
												<th class="cell">Subject</th>
												<th class="cell">Message</th>
												<th class="cell">Reply</th>
												<th class="cell">Date</th>
												<th class="cell">Action</th>
											</tr>
										</thead>
										<tbody>
										    <?php
										    $index = 0;
										    $activity_log = mysqli_query($conn, $generated_request_query."SELECT * FROM `feedbacks` WHERE sender='$current_user_id' AND team='$current_team_id' ORDER BY id DESC");
										        while($row = mysqli_fetch_assoc($activity_log)){
										            $index++;
										            $id = $row['id'];
										            $sender = $row['sender'];
										            $subject = $row['subject'];
										            $message = $row['message'];
										            $reply = $row['reply'];
										            $date = $row['date'];
										            
                                                ?>
                                                <!-- Delete Feedback Modal -->
                                                    <div class="modal fade" id="deleteModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete <?=$subject?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <h4 class='text-danger'>Are you sure you want to delete this feedback?</h4>
                                                            <input name='feedback_id' value='<?=$id?>' hidden/>
                                                            <input name='feedback_subject' value='<?=$subject?>' hidden/>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='delete_feedback' class="btn btn-danger text-white">Delete</button>
                                                          </div>
                                                        </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                <!-- Delete Feedback Modal Ends-->
											<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span><?=ucfirst($subject)?></span></td>
												<td class="cell"><span><?=ucfirst(strtolower($message))?></span></td>
												<td class="cell"><span><?=$replycheck = $reply ==""?'No Reply Yet':ucfirst(strtolower($reply))?></span></td>
												<td class="cell"><span><?=$date?></span></td>
										    <?php if($reply == ""): ?>
												<td class="cell"><button class='btn btn-danger' data-bs-toggle="modal" data-bs-target="#deleteModal<?=$id?>"><i class="bi bi-trash3 h5 text-white"></i></button></td>
											<?php else:?>
											    <td class="cell"><span class='fst-italic'>Disabled</span></td>
											<?php endif ?>
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
	    
<?php require_once('modal.php') ?><!--//app-footer-->
<?php require_once('footer.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>
</body>
</html> 

