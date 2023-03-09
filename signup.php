<!DOCTYPE html>
<?php require_once('config/db.php') ?>
<?php require_once('config/variables.php') ?>
<?php require_once('config/controllers/sign-up.php')?>
<html lang="en"> 
<head>
    <title>Sign Up - <?=$app_title?></title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head> 

<body class="app app-signup p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-4">Sign up to LMS</h2>	
					<!--Display error message-->
	                                <?=$status_msg?>
					<div class="auth-form-container text-start mx-auto">
						<form class="auth-form auth-signup-form" action='' method='post'>         
							<div class="email mb-3">
								<label class="sr-only" for="signup-name">Your Name</label>
								<input id="signup-name" name="name" type="text" class="form-control signup-name" placeholder="Full name" required>
							</div>
							<div class="email mb-3">
								<label class="sr-only" for="signup-email">Your Email</label>
								<input id="signup-email" name="email" type="email" class="form-control signup-email" placeholder="Email" required>
							</div>
							<div class="phone mb-3">
								<label class="sr-only" for="signup-phone">Phone</label>
								<input id="signup-phone" name="phone" type="number" class="form-control signup-phone" placeholder="Phone Number" required>
							</div>
							<div class="password mb-3">
								<label class="sr-only" for="signup-password">Password</label>
								<input id="signup-password" name="password" type="password" class="form-control signup-password" placeholder="Create a password" required>
							</div>
							<div class="password mb-3">
								<label class="sr-only" for="confirm-password">Confirm Password</label>
								<input id="confirm-password" name="confirm_password" type="password" class="form-control signup-password" placeholder="Confirm password" required>
							</div>
							<div class="password mb-3">
								<label for='subscription'>Subscription Plan</label>
								<select name="subscription" class="form-control py-1" required>
								    <?php $subscription_query = mysqli_query($conn, "SELECT * FROM subscription_plans")?>
								    <?php while($row = mysqli_fetch_assoc($subscription_query)):?>
								    <option <?=$free =$row['name'] == 'FREE'?'selected':''?> value=<?=$row['name']?>>
								        <?=$row['name']?>
								    </option>
								    <?php  endwhile ?>
								</select>
							</div>
							<div class="password mb-3">
								<label for='location'>Location</label>
								<select name="location" class="form-control py-1" required>
								    <?php $location_query = mysqli_query($conn, "SELECT * FROM teams")?>
								    <?php while($row = mysqli_fetch_assoc($location_query)):?>
								    <option value=<?=$row['team_id']?>>
								        <?=$row['name']?>
								    </option>
								    <?php endwhile ?>
								</select>
							</div>
							<div class="extra mb-3">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="RememberPassword">
									<label class="form-check-label" for="RememberPassword">
									I agree to Portal's <a href="#" class="app-link">Terms of Service</a> and <a href="#" class="app-link">Privacy Policy</a>.
									</label>
								</div>
							</div><!--//extra-->
							
							<div class="text-center">
								<button type="submit" name='sign-up' class="btn app-btn-primary w-100 theme-btn mx-auto">Sign Up</button>
							</div>
						</form><!--//auth-form-->
						
						<div class="auth-option text-center pt-5">Already have an account? <a class="text-link" href="login.html" >Log in</a></div>
					</div><!--//auth-form-container-->	
					
					
				    
			    </div><!--//auth-body-->
		    
			   <?php require_once('inc/footer.php')?><!--//app-auth-footer-->	
		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">			    
		    </div>
		    <div class="auth-background-mask"></div>
		    <div class="auth-background-overlay p-3 p-lg-5">
			    <div class="d-flex flex-column align-content-end h-100">
				    <div class="h-100"></div>
				    <div class="overlay-content p-3 p-lg-4 rounded">
					    <h5 class="mb-3 overlay-title">Explore Portal Admin Template</h5>
					    <div>Portal is a free Bootstrap 5 admin dashboard template. You can download and view the template license <a href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/">here</a>.</div>
				    </div>
				</div>
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->
    
    </div><!--//row-->


</body>
</html> 

