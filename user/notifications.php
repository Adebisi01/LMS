<!DOCTYPE html>
<?php require_once('include.php')?>
<html lang="en"> 
<head>
    <title>Notifications | <?=$app_title?></title>
    
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
				    <div class="col-auto w-100 d-flex justify-content-between">
			            <h1 class="app-page-title mb-0">Notification</h1>
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
												<th class="cell">Message</th>
												<th class="cell">Date</th>
											</tr>
										</thead>
										<tbody>
										    <?php
										    $index = 0;
										    $activity_log = mysqli_query($conn, $generated_request_query."SELECT * FROM `notification` WHERE team LIKE '%$current_team_id%' ORDER BY id DESC");
										        while($row = mysqli_fetch_assoc($activity_log)){
										            $index++;
										            $id = $row['id'];
										            $message = $row['activity'];
										            $date = $row['date'];
										            
                                                ?>
											<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span><?=ucfirst(strtolower($message))?></span></td>
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
			        <!--Active Users-->
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    </div><!--//app-content-->
	    
<?php require_once('footer.php') ?><!--//app-footer-->
	    
<?php require_once('scripts.php') ?>

</body>
</html> 

