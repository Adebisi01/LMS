<!DOCTYPE html>
<?php require_once('config/db.php') ?>
<?php require_once('config/variables.php') ?>
<?php require_once('config/controllers/pick_a_team.php')?>
<html lang="en"> 
<head>
    <title>Pick A Team - <?=$app_title?></title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head> 

<body class="app app-login p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Select A Location</h2>
					<!--Display Error messages-->
					        <?=$status_msg?>
			        <div class="auth-form-container text-start">
						<form class="auth-form login-form" action='' method='post'>         
							<div class="email mb-3">
								<label class="sr-only" for="signin-email">Teams</label>
								<select name="team" class="form-control py-1" required="required">
								    <?php $team_query = mysqli_query($conn, "SELECT team_id, name FROM teams")?>
								   <?php while($row = mysqli_fetch_assoc($team_query)):?>

								    <option value='<?=$row['team_id']?>'>
								        <?=ucwords(strtolower($row['name']))?>
								    </option>
								    <?php endwhile?>
								</select>
							</div><!--//form-group-->
							
							
							<div class="password mb-3">
							
								<div class="extra mt-3 row justify-content-between">
								
									
								</div><!--//extra-->
							</div><!--//form-group-->
							<div class="text-center">
								<button type="submit" name='pick_team' class="btn app-btn-primary w-100 theme-btn mx-auto">Proceed To Dashboard</button>
							</div>
						</form>
						
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

