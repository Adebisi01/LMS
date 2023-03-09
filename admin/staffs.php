<!DOCTYPE html>
<?php require_once('include.php')?>
<html lang="en"> 
<head>
    <title>Staffs | <?=$app_title?></title>
    
    <!-- Meta -->
    
  <?php require_once('links.php') ?>

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>

    </header><!--//app-header-->
    <?php require_once('../config/controllers/staffs.php') ?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Staffs</h1>
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
				    <a class="flex-sm-fill text-sm-center nav-link"  id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Active</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Archived</a>
				    <!--<a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">Black List</a>-->
				</nav>
				
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
												<th class="cell">Name</th>
												<th class="cell">Email</th>
												<th class="cell">Phone</th>
												<th class="cell">Status</th>
												<th class="cell">Position</th>
												<th class="cell">Registered Date</th>
												<th class="cell">Action</th>
											</tr>
										</thead>
										<tbody>
										    <?php
										    $index = 0;
										    if($current_user_role == 'superAdmin'){
    										    $generated_request_query = gen_mul_team_query_for_mul_assigneee("SELECT * FROM `users` WHERE role !='user' ", $active_team_array);
										    }else{
    										    $generated_request_query = gen_mul_team_query_for_mul_assigneee("SELECT * FROM `users` WHERE role !='user' AND role !='superAdmin' ", $active_team_array);
										    }
										    $requests = mysqli_query($conn, $generated_request_query." ORDER BY id DESC");
										        while($row = mysqli_fetch_assoc($requests)){
										            $index++;
										            $id = $row['id'];
										            $fullname = $row['fullname'];
										            $email = $row['email'];
										            $phone = $row['phone'];
										            $status = $row['status'];
										            $role = $row['role'];
										            $date = $row['date'];
                                                ?>
                                                <!--Restore modal-->
                                                <div class="modal fade" id="restoreModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Remove <?=$fullname?> from archive</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                 <label for='blacklistInput' class='fst-italics mb-1'>Type RESTORE to confirm</label>
                                                                <input class='form-control mb-2' name='word_check' id='restoreInput<?=$id?>' required placeholder='RESTORE'/>
                                                                <textarea class='form-control mb-2' name='reason' placeholder='Why are you removing this person from the archive' required style='min-height:100px'></textarea>

                                                            </div>
                                                          </div>
                                                          <input name='restore_id' hidden value='<?=$id?>'/>
                                                          <input name='fullname' hidden value='<?=$fullname?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='restore'  id='restoreButton<?=$id?>' class="btn btn-success text-white" >Restore</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Restore modal ends-->
                                                      
                                                      <!--Archive modal-->
                                                        <div class="modal fade" id="archiveModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Archive <?=$fullname?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                <label for='word_check' class='fst-italics mb-1'>Type ARCHIVE to confirm</label>
                                                                <input class='form-control' name='word_check' required placeholder='ARCHIVE'/>
                                                            </div>
                                                          </div>
                                                          <input name='archive_id' hidden value='<?=$id?>'/>
                                                          <input name='fullname' hidden value='<?=$fullname?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='archive' class="btn btn-danger text-white">Archive</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Archive modal ends-->
                                                      

											<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span class="truncate"><?=$fullname?></span></td>
												<td class="cell"><span><?=$email?></span></td>
												<td class="cell"><span><?=$phone?></span></td>
												<td class="cell"><span
        												class="badge bg-<?=$color = $status =='active'?'success': ($status == 'inactive'? 'danger': 'warning')?>"
        												><?=ucfirst($status)?>
        												</span>
												</td>
												
												<td class="cell"><span><?=ucfirst($role)?></span></td>
												<td class="cell"><span><?=$date?></span></td>
												<td class="cell">
    												    
												<form action='staff_profile' method='post' style='display:inline-block'>
										        	    <button type='submit' class='btn btn-primary' name='staff_id' value='<?=$id?>' title='View profile'><i class="bi bi-person-circle text-white h5"></i></button>
												</form>
												
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
			        <!--Active Staffs-->
			        <div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive p-2">
								    
							        <table class="table mb-0 text-left" id='data1'>
										<thead>
											<tr>
												<th class="cell">Sn</th>
												<th class="cell">Name</th>
												<th class="cell">Email</th>
												<th class="cell">Phone</th>
												<th class="cell">Status</th>
												<th class="cell">Registered Date</th>
												<th class="cell">Action</th>
											</tr>
										</thead>
										<tbody class=''>
										    <?php
										    $index = 0;
										    if($current_user_role == 'superAdmin'){
    										    $generated_request_query = gen_mul_team_query_for_mul_assigneee("SELECT * FROM `users` WHERE  `status` = 'active' AND role !='user' ", $active_team_array);
										    }else{
    										    $generated_request_query = gen_mul_team_query_for_mul_assigneee("SELECT * FROM `users` WHERE `status` = 'active' AND `role`='staff'", $active_team_array);
										    }
										    $act_users = mysqli_query($conn, $generated_request_query." ORDER BY `id` DESC");
										        while($row = mysqli_fetch_assoc($act_users)){
										             $index++;
										            $id = $row['id'];
										            $fullname = $row['fullname'];
										            $email = $row['email'];
										            $phone = $row['phone'];
										            $status = $row['status'];
										            $date = $row['date'];
										        
                                                ?>
                                                 <!--Archive modal-->
                                                        <div class="modal fade" id="actArchiveModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Archive <?=$fullname?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                <label for='word_check' class='fst-italics mb-1'>Type ARCHIVE to confirm</label>
                                                                <input class='form-control' name='word_check' required placeholder='ARCHIVE'/>
                                                            </div>
                                                          </div>
                                                          <input name='archive_id' hidden value='<?=$id?>'/>
                                                          <input name='fullname' hidden value='<?=$fullname?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='archive' class="btn btn-danger text-white">Archive</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Archive modal ends-->
                                              
                                    
												<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span class="truncate"><?=$fullname?></span></td>
												<td class="cell"><span><?=$email?></span></td>
												<td class="cell"><span><?=$phone?></span></td>
												<td class="cell"><span
        												class="badge bg-<?=$color = $status =='active'?'success': ($status == 'inactive'? 'danger': 'warning')?>"
        												><?=ucfirst($status)?>
        												</span>
												</td>
												
												<td class="cell"><span><?=$date?></span></td>
												<td class="cell d-flex gap-1">
                                                <form action='staff_profile' method='post' style='display:inline-block'>
										        	    <button type='submit' class='btn btn-primary' name='staff_id' value='<?=$id?>' title='View profile'><i class="bi bi-person-circle text-white h5"></i></button>
												</form>
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
			        
			        <!--Archived Staffs-->
			        <div class="tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive p-2">
							        <table class="table mb-0 text-left" id="data2">
										<thead>
											<tr>
												<th class="cell">Sn</th>
												<th class="cell">Name</th>
												<th class="cell">Email</th>
												<th class="cell">Phone</th>
												<th class="cell">Status</th>
												<th class="cell">Registered Date</th>
												<th class="cell">Action</th>
											</tr>
										</thead>
										<tbody>
										     <?php
										    $index = 0;
										    if($current_user_role == 'superAdmin'){
    										    $generated_request_query = gen_mul_team_query_for_mul_assigneee("SELECT * FROM `users` WHERE `status` = 'archived' AND role !='user' ", $active_team_array);
										    }else{
    										    $generated_request_query = gen_mul_team_query_for_mul_assigneee("SELECT * FROM `users` WHERE `status` = 'archived' AND `role`='staff'", $active_team_array);
										    }
										    $requests = mysqli_query($conn, $generated_request_query." ORDER BY `id` DESC");
										        while($row = mysqli_fetch_assoc($requests)){
										            $index++;
										            $id = $row['id'];
										            $fullname = $row['fullname'];
										            $email = $row['email'];
										            $phone = $row['phone'];
										            $status = $row['status'];
										            $date = $row['date'];
										           
                                                ?>
                                                <!--Restore modal-->
                                                <div class="modal fade" id="arcRestoreModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Restore <?=$fullname?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                 <label for='blacklistInput' class='fst-italics mb-1'>Type RESTORE to confirm</label>
                                                                <input class='form-control mb-2' name='word_check' id='restoreInput<?=$id?>' required placeholder='RESTORE'/>
                                                                <textarea class='form-control mb-2' name='reason' placeholder='Why are you removing this person from the archive' required style='min-height:100px'></textarea>

                                                            </div>
                                                          </div>
                                                          <input name='restore_id' hidden value='<?=$id?>'/>
                                                          <input name='fullname' hidden value='<?=$fullname?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='restore'  id='restoreButton<?=$id?>' class="btn btn-success text-white" >Restore</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Restore modal ends-->
                                               
                                                    							
                                            <tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span class="truncate"><?=$fullname?></span></td>
												<td class="cell"><span><?=$email?></span></td>
												<td class="cell"><span><?=$phone?></span></td>
												<td class="cell"><span
        												class="badge bg-<?=$color = $status =='active'?'success': ($status == 'inactive'? 'danger': 'warning')?>"
        												><?=ucfirst($status)?>
        												</span>
												</td>
												
												<td class="cell"><span><?=$date?></span></td>
												<td class="cell d-flex gap-1">
    												<form action='staff_profile' method='post' style='display:inline-block'>
    										        	    <button type='submit' class='btn btn-primary' name='staff_id' value='<?=$id?>' title='View profile'><i class="bi bi-person-circle text-white h5"></i></button>
    												</form>
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
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>
</body>
</html> 

