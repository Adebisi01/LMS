<!DOCTYPE html>
<?php require_once('../config/db.php') ?>
<?php require_once('../config/app-config.php') ?>

 <?php  
	    $fine_query = mysqli_query($conn, "SELECT * FROM fines WHERE user='$current_user_id' AND status='unpaid'");
	            $fine = mysqli_fetch_assoc($fine_query);
	            
	            $fine_exist = mysqli_num_rows($fine_query);
	            if($fine_exist == 0){
	                ?>
	                <script>
	                    window.location = '../login'
	                </script>
	                <?php
	            }
	            
	            
	    ?>
<html lang="en"> 
<head>
    <title>Edu-Slick Study</title>
    
    <!-- Meta -->
 <?php require_once('links.php') ?>

</head> 

<body class="app app-404-page">   	
   
    <div class="container mb-5">
	    <div class="row">
		    <div class="col-12 col-md-11 col-lg-7 col-xl-6 mx-auto">
			    <div class="app-branding text-center mb-5">
			       
		            <a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"><span class="logo-text">Edu-Slick Study</span></a>
	   
		        </div><!--//app-branding-->  
			    <div class="app-card p-5 text-center shadow-sm">
				    <h1 class="page-title mb-4">Fined<br><span class="font-weight-light"></span></h1>
				    <div class="mb-4">
					    Your account has been fined with a sum <?=$fine['amount']?> naira for the following reason(s):
					   <blockquote class="blockquote"><p><?=$fine['reason']?></p></blockquote>
					   Pay your fine and send/show your receipt to the librarian for acknowledgement before you can access the library again.
					    Thanks
				    </div>
				  <a href='pay_fine'> <button class='btn btn-primary text-white'>Pay Online</button></a>
			    </div>
		    </div><!--//col-->
	    </div><!--//row-->
    </div><!--//container-->
   
    
  <?php require_once('footer.php') ?><!--//app-footer-->

    <!-- Javascript -->          
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  
    
    

    
    
    <!-- Charts JS -->
    <script src="assets/plugins/chart.js/chart.min.js"></script> 
    <script src="assets/js/charts-custom.js"></script> 
    
    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 

</body>
</html> 

