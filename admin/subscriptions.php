<!DOCTYPE html>
<?php require_once('include.php')?>
<html lang="en"> 
<head>
    <title>Subscriptions | <?=$app_title?></title>
    
    <!-- Meta -->
    
  <?php require_once('links.php') ?>

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>

    </header><!--//app-header-->
    <?php require_once('../config/controllers/subscriptions.php') ?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto w-100 d-flex align-items-center justify-content-between">
			            <h1 class="app-page-title mb-0">Subscriptions</h1>
			            <button class='btn btn-primary text-white' data-bs-toggle="modal" data-bs-target="#subscriptionModal">Add Subscription</button>
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
			    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
			         <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">User Subscriptions</a>
				    <a class="flex-sm-fill text-sm-center nav-link"  id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Subscription Plans</a>
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
												<th class="cell">Subscriber</th>
												<th class="cell">Type</th>
												<th class="cell">Subscription Date</th>
												<th class="cell">Expiry Date</th>
												
											</tr>
										</thead>
										<tbody>
										    <?php
										    $index = 0;
										    $activity_log = mysqli_query($conn, "SELECT * FROM `user_subscriptions` ORDER BY id DESC LIMIT 100");
										        while($row = mysqli_fetch_assoc($activity_log)){
										            $index++;
										            $id = $row['id'];
										            $type = $row['type'];
										            $subscriber = $row['subscriber'];
										            $subscription_date = $row['subscription_date'];
										            $expiry_date = $row['expiry_date'];
										            
										            
										           $get_name_query = mysqli_query($conn, "SELECT fullname FROM users WHERE id='$subscriber'");
										           $subscriber_name = mysqli_fetch_assoc($get_name_query)['fullname'];
										           
										           $sub_name_query = mysqli_query($conn, "SELECT name FROM subscription_plans WHERE id='$type'");
										           $sub_name = mysqli_fetch_assoc($sub_name_query)['name'];

                                                ?>
                                                
                                                
                                                
											<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span><?=$subscriber_name?></span></td>
												<td class="cell"><span><?=$sub_name?></span></td>
												<td class="cell"><span><?=$subscription_date?></span></td>
												<td class="cell"><span><?=$expiry_date?></span></td>
												
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
		    <!--Subscription Plans-->
		    <div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive p-2">
								    
							        <table class="table mb-0 text-left" id='data1'>
										<thead>
											<tr>
												<th class="cell">Sn</th>
												<th class="cell">Subscription Plan</th>
												<th class="cell">Level</th>
												<th class="cell">Duration</th>
												<th class="cell">Price(&#8358)</th>
												<th class="cell">Date</th>
												<th class="cell">Action</th>
											</tr>
										</thead>
										<tbody class=''>
										    <?php
										    $index = 0;
										    $sub_plans = mysqli_query($conn, "SELECT * FROM subscription_plans ORDER BY id DESC");
										        while($row = mysqli_fetch_assoc($sub_plans)){
										            $index++;
										            $id = $row['id'];
										            $name = $row['name'];
										            $level = $row['level'];
										            $price = $row['price'];
										            $duration = $row['duration'];
										            $date = $row['date'];
                                                ?>
                                                <div class="modal fade" id="editModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit <?=$name?> Subscription</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                      </div>
                                                      <form action='' method='post'>
                                                      <div class="modal-body">
                                                        <div class='form-group mb-2'>
                                                            <input class='form-control' type='text' name='plan_name' required placeholder='Plan Name' value='<?=$name?>' />
                                                        </div>
                                                        <div class='form-group mb-2'>
                                                            <input class='form-control' type='number' name='plan_price' required placeholder='Plan Price In Naira' value='<?=$price?>' />
                                                        </div>
                                                        <div class='form-group mb-2'>
                                                            <select class='form-control' name='plan_duration' required>
                                                                <option>
                                                                    --- Select Duration --- 
                                                                </option>
                                                                <option <?=$month_duration = $duration == '12'?'selected': ''?> value='12'>
                                                                    12 Months
                                                                </option>
                                                                <option <?=$month_duration = $duration == '6'?'selected': ''?> value='6'>
                                                                    6 Months
                                                                </option>
                                                                <option <?=$month_duration = $duration == 'INFINITE'?'selected': ''?> value='INFINITE'>
                                                                    INFINITE
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class='form-group mb-2'>
                                                            <label class='fst-italic fst-bold text-danger'> Info: The cheapest plan should have the lowest level. e.g Free Plan-0, Basic Plan - level 1, Premium Plan- level 2 </label>
                                                            <input class='form-control' type='number' min=0 name='plan_level' required placeholder='Level' value='<?=$level?>' />
                                                        </div>
                                                        <input type='number' hidden name='subscription_id' value='<?=$id?>'   />
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="submit" name='edit_subscription' class="btn btn-primary text-white">Update</button>
                                                      </div>
                                                    </form>
                                                    </div>
                                                  </div>
                                                </div>
											<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span class="truncate"><?=$name?></span></td>
												<td class="cell"><span><?=$level?></span></td>
												<td class="cell"><span><?=$duration?> Months</span></td>
												<td class="cell"><span><?=$price?></span></td>
												<td class="cell"><span class="note"><?=$date?></span></td>
												<td class="cell"><button class='btn btn-primary text-white' data-bs-toggle="modal" data-bs-target="#editModal<?=$id?>"><i class="bi bi-pencil"></i></button></td>
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
	    </div><!--//app-content-->
	    
<?php require_once('footer.php') ?><!--//app-footer-->
<?php require_once('modal.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>
</body>
</html> 

