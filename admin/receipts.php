<!DOCTYPE html>
<?php require_once('include.php')?>
<html lang="en"> 
<head>
    <title>Receipts | <?=$app_title?></title>
    
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
			            <h1 class="app-page-title mb-0">Receipts </h1>
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
												<th class="cell">Member</th>
												<th class="cell">Subject</th>
												<th class="cell">Date</th>
												<th class="cell">Action</th>
											</tr>
										</thead>
										<tbody>
										    <?php
										    $index = 0;
										    $generated_request_query = gen_mul_team_query_for_mul_assigneee_without_where("SELECT * FROM `receipts`", $active_team_array);
										    $receipts = mysqli_query($conn, $generated_request_query." ORDER BY id DESC");
										        while($row = mysqli_fetch_assoc($receipts)){
										            $index++;
										            $id = $row['id'];
										            $user_id = $row['user_id'];
										            $subject = $row['subject'];
										            $receipt = $row['receipt'];
										            $date = $row['date'];
										            
										           $fullname_query = mysqli_query($conn, "SELECT fullname FROM users WHERE id='$user_id'");
										           $fullname = mysqli_fetch_assoc($fullname_query)['fullname'];

                                                ?>
											<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span><?=$fullname?></span></td>
												<td class="cell"><span><?=$subject?></span></td>
												<td class="cell"><span><?=$date?></span></td>
												<td class="cell"><a href="../assets/receipts/<?=$receipt?>" download='Receipt File'><button title='Download Receipt' class='btn btn-primary'><i class="bi bi-cloud-arrow-down-fill text-white h5"></i></button></a></td>
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

