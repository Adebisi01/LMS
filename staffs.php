<!DOCTYPE html>
<?php require_once('include.php')?>
<html lang="en"> 
<head>
    <title>Library Members | <?=$app_title?></title>
    
    <!-- Meta -->
    
  <?php require_once('links.php') ?>

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>

    </header><!--//app-header-->
    <?php require_once('../config/controllers/members.php') ?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Members</h1>
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
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Inactive</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">Black List</a>
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
												<th class="cell">Registered Date</th>
												<th class="cell">Action</th>
											</tr>
										</thead>
										<tbody>
										    <?php
										    $index = 0;
										    $generated_request_query = gen_mul_team_query("SELECT * FROM `users` WHERE role='user'", $active_team_array);
										    $requests = mysqli_query($conn, $generated_request_query." ORDER BY id DESC");
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
                                                <div class="modal fade" id="restoreModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Remove <?=$fullname?> from blacklist</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                 <label for='blacklistInput' class='fst-italics mb-1'>Type RESTORE to confirm</label>
                                                                <input class='form-control mb-2' name='word_check' id='restoreInput<?=$id?>' required placeholder='RESTORE'/>
                                                                <textarea class='form-control mb-2' name='reason' placeholder='Why are you removing this person from blacklist' required style='min-height:100px'></textarea>

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
                                                      <!--BlackList modal-->
                                                <div class="modal fade" id="blacklistModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Blacklist <?=$fullname?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                <label for='blacklistInput' class='fst-italics mb-1'>Type BLACKLIST to confirm</label>
                                                                <input class='form-control mb-2' name='word_check' id='blacklistInput' required placeholder='BLACKLIST'/>
                                                                <textarea class='form-control mb-2' name='reason' placeholder='Why are you blacklisting this person' required style='min-height:100px'></textarea>
                                                            </div>
                                                          </div>
                                                          <input name='blacklist_id' hidden value='<?=$id?>'/>
                                                          <input name='fullname' hidden value='<?=$fullname?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='blacklist' id='blacklistButton' class="btn btn-danger text-white blacklistButton">Blacklist</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Blacklist modal ends-->
                                                      <!--Inactive modal-->
                                                        <div class="modal fade" id="inactiveModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Deactivate <?=$fullname?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                <label for='blacklistInput' class='fst-italics mb-1'>Type INACTIVE to confirm</label>
                                                                <input class='form-control' name='word_check' required placeholder='INACTIVE'/>
                                                            </div>
                                                          </div>
                                                          <input name='inactive_id' hidden value='<?=$id?>'/>
                                                          <input name='fullname' hidden value='<?=$fullname?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='inactive' class="btn btn-danger text-white blacklistButton">Deactivate</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Inactive modal ends-->
                                                      

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
												<td class="cell">
												    <?php if($status == 'active' || $status == 'inactive'):?>
												        <button class='btn btn-warning' title='Add To Blacklist' data-bs-toggle="modal" data-bs-target="#blacklistModal<?=$id?>"><i class="bi bi-person-fill-slash h5 text-white"></i></button>
												        
        												    <?php if($status == 'active'):?>
        												        <button class='btn btn-danger' title='Deactivate' data-bs-toggle="modal" data-bs-target="#inactiveModal<?=$id?>"><i class="bi bi-person-fill-dash h5 text-white"></i></button>
        												    <?php elseif($status == 'inactive'):?>
        												        <button class='btn btn-success' title='Activate' data-bs-toggle="modal" data-bs-target="#restoreModal<?=$id?>"><i class="bi bi-person-fill-add h5 text-white"></i></button>
        												    <?php endif ?>
												    
												    <?php elseif($status == 'blacklisted'):?>
												    <button class='btn btn-success' title='Remove From Blacklist' data-bs-toggle="modal" data-bs-target="#restoreModal<?=$id?>"><i class="bi bi-person-fill-check h5 text-white"></i></button>
												    <?php endif ?>
												<form action='user_profile' method='post' style='display:inline-block'>
										        	    <button type='submit' class='btn btn-primary' name='user_id' value='<?=$id?>' title='View profile'><i class="bi bi-person-circle text-white h5"></i></button>
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
			        <!--Active Users-->
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
										    $generated_request_query = gen_mul_team_query("SELECT * FROM `users` WHERE `status` = 'active' AND `role`='user'", $active_team_array);
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
                                                 <!--Inactive modal-->
                                                        <div class="modal fade" id="actInactiveModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Deactivate <?=$fullname?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                <label for='blacklistInput' class='fst-italics mb-1'>Type INACTIVE to confirm</label>
                                                                <input class='form-control' name='word_check' required placeholder='INACTIVE'/>
                                                            </div>
                                                          </div>
                                                          <input name='inactive_id' hidden value='<?=$id?>'/>
                                                          <input name='fullname' hidden value='<?=$fullname?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='inactive' class="btn btn-danger text-white blacklistButton">Deactivate</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Inactive modal ends-->
                                              
                                                      <!--BlackList modal-->
                                                <div class="modal fade" id="actBlacklistModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Blacklist <?=$fullname?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                <label for='blacklistInput' class='fst-italics mb-1'>Type BLACKLIST to confirm</label>
                                                                <input class='form-control blacklistInput' name='word_check' id='blacklistInput' required placeholder='BLACKLIST'/>
                                                            </div>
                                                          </div>
                                                          <input name='blacklist_id' hidden value='<?=$id?>'/>
                                                          <input name='fullname' hidden value='<?=$fullname?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='blacklist' id='blacklistButton' class="btn btn-danger text-white blacklistButton">Blacklist</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Blacklist modal ends-->										
                                    
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
												
												        <button  class='btn btn-warning' title='Add To Blacklist' data-bs-toggle="modal" data-bs-target="#actBlacklistModal<?=$id?>"><i class="bi bi-person-fill-slash h5 text-white"></i></button>
												        
												        <button class='btn btn-danger' title='Deactivate' data-bs-toggle="modal" data-bs-target="#actInactiveModal<?=$id?>"><i class="bi bi-person-fill-dash h5 text-white"></i></button>
												        
												    
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
			        
			        <!--Inactive users-->
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
										    $generated_request_query = gen_mul_team_query("SELECT * FROM `users` WHERE `status` = 'inactive' AND `role`='user'", $active_team_array);
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
                                                <div class="modal fade" id="inactRestoreModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <input class='form-control' name='word_check' id='restoreInput<?=$id?>' required placeholder='RESTORE'/>
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
                                               
                                                      <!--BlackList modal-->
                                                <div class="modal fade" id="inactBlacklistModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Blacklist <?=$fullname?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                <label for='blacklistInput' class='fst-italics mb-1'>Type BLACKLIST to confirm</label>
                                                                <input class='form-control blacklistInput' name='word_check' id='blacklistInput' required placeholder='BLACKLIST'/>
                                                            </div>
                                                          </div>
                                                          <input name='blacklist_id' hidden value='<?=$id?>'/>
                                                          <input name='fullname' hidden value='<?=$fullname?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='blacklist' id='blacklistButton' class="btn btn-danger text-white blacklistButton">Blacklist</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Blacklist modal ends-->										
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
												   
												        <button class='btn btn-warning' title='Add To Blacklist' data-bs-toggle="modal" data-bs-target="#inactBlacklistModal<?=$id?>"><i class="bi bi-person-fill-slash h5 text-white"></i></button>
												    
												    <button class='btn btn-success' title='Activate' data-bs-toggle="modal" data-bs-target="#inactRestoreModal<?=$id?>"><i class="bi bi-person-fill-add h5 text-white"></i></button>
												  
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
			        
			        <!--BlackList  Request-->
			        <div class="tab-pane fade" id="orders-cancelled" role="tabpanel" aria-labelledby="orders-cancelled-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive p-2">
							        <table class="table mb-0 text-left" id='data3'>
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
										    $generated_request_query = gen_mul_team_query("SELECT * FROM `users` WHERE `status` = 'blacklisted' AND `role`='user'", $active_team_array);
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
                                                <div class="modal fade" id="blackRestoreModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Remove <?=$fullname?> from blacklist</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                 <label for='blacklistInput' class='fst-italics mb-1'>Type RESTORE to confirm</label>
                                                                <input class='form-control mb-2' name='word_check' id='restoreInput<?=$id?>' required placeholder='RESTORE'/>
                                                            <textarea class='form-control mb-2' name='reason' placeholder='Why are you removing this person from blacklist' required style='min-height:100px'></textarea>

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
        												class="badge bg-warning"
        												><?=ucfirst($status)?>
        												</span>
												</td>
												
												<td class="cell"><span><?=$date?></span></td>
												<td class="cell">
												    <button class='btn btn-success' title='Remove From Blacklist' data-bs-toggle="modal" data-bs-target="#blackRestoreModal<?=$id?>"><i class="bi bi-person-fill-check h5 text-white"></i></button>
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

