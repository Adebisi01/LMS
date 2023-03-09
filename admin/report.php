<!DOCTYPE html>
<?php require_once('include.php')?>
    <?php require_once('../config/controllers/reports.php') ?>
<html lang="en"> 
<head>
    <title>Reports | <?=$app_title?></title>
    
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
			            <h1 class="app-page-title mb-0">Reports</h1>
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
			    
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body p-4">
						        
							    <!--<div class="table-responsive p-2">-->
							       <div class="row row-cols-1 row-cols-md-2 g-4">
                                      <div class="col">
                                        <div class="card">
                                          <div class="card-body">
                                            <h5 class="card-title">Books Report</h5>
                                            <p class="card-text">This allows you to view the books added , type, ISBN Number and the date books were added within the the time range you select.</p>
                                                <button class='btn btn-primary text-white' data-bs-toggle="modal" data-bs-target="#bookReport">View Report</button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="card">
                                          <div class="card-body">
                                            <h5 class="card-title">Downloads Report</h5>
                                            <p class="card-text">This allows you to view E-Book Downloads Report stating, ISBN Number, and the date the book was added over the time range you select</p>
                                            <button class='btn btn-primary text-white' data-bs-toggle="modal" data-bs-target="#downloadsReport">View Report</button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="card">
                                          <div class="card-body">
                                            <h5 class="card-title">Subscription Report</h5>
                                            <p class="card-text">This allows you to view users Subscription plans, type , when they subscribed, and when their subscription should expire, within the time range you select. Note: INFINITE means Subscription never expires</p>
                                                <button class='btn btn-primary text-white' data-bs-toggle="modal" data-bs-target="#subscriptionReport">View Report</button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="card">
                                          <div class="card-body">
                                            <h5 class="card-title">Book Circulation Report</h5>
                                            <p class="card-text">This allows you to view the books requested, their approval status, their return status (if they were ever approved), who requested them and date requested, over the time range you select </p>
                                            <button class='btn btn-primary text-white' data-bs-toggle="modal" data-bs-target="#book_circulationReport">View Report</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
						        <!--</div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
					
						
			        </div><!--//tab-pane-->
			        <!--Active Users-->
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
<?php require_once('footer.php') ?><!--//app-footer-->
<?php require_once('modal.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>
</body>
</html> 

