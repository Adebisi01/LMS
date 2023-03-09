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
												<th class="cell">Sender</th>
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
										    $generated_request_query = gen_mul_team_query_without_where("SELECT * FROM `feedbacks`", $active_team_array);
										    $activity_log = mysqli_query($conn, $generated_request_query." ORDER BY id DESC");
										        while($row = mysqli_fetch_assoc($activity_log)){
										            $index++;
										            $id = $row['id'];
										            $sender = $row['sender'];
										            $subject = $row['subject'];
										            $message = $row['message'];
										            $reply = $row['reply'];
										            $date = $row['date'];
										            
										          $sender_query = mysqli_query($conn, "SELECT fullname FROM users WHERE id='$sender'");
										            $sender_fullname = mysqli_fetch_assoc($sender_query)['fullname'];
                                                ?>
                                                <!-- Delete Broadcast Modal -->
                                                    <div class="modal fade" id="replyModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Reply <?=$subject?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                <textarea name='reply_msg' class='form-control' placeholder='Reply' required style='min-height:100px'></textarea>
                                                            </div>
                                                            <input name='reply_id' value='<?=$id?>' hidden/>
                                                            <input name='reply_subject' value='<?=$subject?>' hidden/>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='reply_feedback' class="btn btn-danger text-white">Reply</button>
                                                          </div>
                                                        </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                <!-- Delete Broadcast Modal Ends-->
											<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span><?=$sender_fullname?></span></td>
												<td class="cell"><span><?=ucfirst($subject)?></span></td>
												<td class="cell"><span><?=ucfirst(strtolower($message))?></span></td>
												<td class="cell"><span><?=ucfirst(strtolower($reply))?></span></td>
												<td class="cell"><span><?=$date?></span></td>
												<td class="cell">
												    <button class='btn btn-primary' data-bs-toggle="modal" title='Reply' data-bs-target="#replyModal<?=$id?>"><i class="bi bi-reply-fill text-white"></i></button>
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
	    
<?php require_once('modal.php') ?><!--//app-footer-->
<?php require_once('footer.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>
</body>
</html> 

