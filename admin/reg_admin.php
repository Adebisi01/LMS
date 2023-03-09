<!DOCTYPE html>
<?php require_once('include.php')?>
<html lang="en"> 
<head>
    <title>Register Admin | <?=$app_title?></title>
    
    <!-- Meta -->
    
  <?php require_once('links.php') ?>

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>

    </header><!--//app-header-->
    <?php require_once('../config/controllers/admin_reg.php') ?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Register Staff</h1>
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
			   
			   <?=$status_msg?>
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class=" shadow-sm mb-5 container row gap-5">
						    <div class="card col-sm-12 col-lg-6">
						          <div class="card-header">
                                    <h5>Register Staff </h5>
                                  </div>
                                  <div class="card-body">
						            <form action='' method='post'>
						                <div class='form-group mb-2'>
						                    <input type='text' name='fullname' class='form-control' placeholder='fullname' required />
						                </div>
						                <div class='form-group mb-2'>
						                    <input type='email' name='email' class='form-control' placeholder='Email' required />
						                </div>
						                <div class='form-group mb-2'>
						                    <input type='number' name='phone' class='form-control' placeholder='Phone' required />
						                </div>
						                <div class='form-group mb-2'>
						                    <input type='password' name='password' class='form-control' placeholder='Password' required />
						                </div>
						                <div class='form-group mb-2'>
						                    <input type='password' name='confirm_password' class='form-control' placeholder='Confirm Password' required />
						                </div>
						                <div class='form-group mb-2'>
						                    <?php $get_team_query = mysqli_query($conn, "SELECT * FROM teams");
						                          
						                            ?>
						                    <h5>Assign To Team</h5>
						                   <div class=''>
    						                    <?php while($teams = mysqli_fetch_assoc($get_team_query)): ?>
    						                    <div class="form-check form-check-inline">
                                                  <input class="form-check-input" name="staff_team[]" type="checkbox" value="<?=$teams['team_id']?>" id="flexCheckDefault<?=$teams['id']?>">
                                                  <label class="form-check-label" for="flexCheckDefault<?=$teams['id']?>">
                                                    <?=$teams['name']?>
                                                  </label>
                                                </div>
    						                    <?php endwhile?>
						                   </div>
						                </div>
						                <div class='form-group mb-2'>
						                  <button class='btn btn-primary text-white' type='submit' name='create_staff'>Submit</button>
						              </div>
                                        
						            </form>
						           </div>
						    </div>
						    
						<!--Assign to Team-->
						    <div class="card col-sm-12 col-lg-5">
						          <div class="card-header">
                                    <h5>Assign Staff To Team </h5>
                                  </div>
                                  <div class="card-body">
						            <form action='' method='post'>
						                <select name='staff_id' required class='form-control py-1'>
						                   <?php $staffs_query = mysqli_query($conn, "SELECT * FROM users WHERE role='staff'");
						                     while($row = mysqli_fetch_assoc($staffs_query)){
						                         $id = $row['id'];
						                         $fullname = $row['fullname'];
						                   ?>
						                   <option value='<?=$id?>'>
						                       <?=ucwords(strtolower($fullname))?>
						                   </option>
						                  
						                   <?php
						                      }
						                   ?>
						               </select>
						                <div class='form-group mb-2'>
						                    <?php $get_team_query = mysqli_query($conn, "SELECT * FROM teams");?>
						                    <h5>Assign To Team</h5>
						                   <div class=''>
    						                    <?php while($teams = mysqli_fetch_assoc($get_team_query)): ?>
    						                    <div class="form-check form-check-inline">
                                                  <input class="form-check-input" name="staff_team[]" type="checkbox" value="<?=$teams['team_id']?>" id="flexCheckDefault<?=$teams['id']?>">
                                                  <label class="form-check-label" for="flexCheckDefault<?=$teams['id']?>">
                                                    <?=$teams['name']?>
                                                  </label>
                                                </div>
    						                    <?php endwhile?>
						                   </div>
						                </div>
						                <div class='form-group mb-2'>
						                  <button class='btn btn-primary text-white' type='submit' name='assign_staff'>Submit</button>
						              </div>
                                        
						            </form>
						           </div>
						    </div>
						  <!--Assign to Team ends-->
						  <!--Make Admin-->
						    <div class="card col-sm-12 col-lg-5">
						        <div class="card-header">
                                   <h5>Make Admin </h5>
                                  </div>
                                  <div class="card-body">
						            <form action='' method='post'>
						              <div class='form-group mb-2'>
						               <select name='staff_id' required class='form-control py-1'>
						                   <?php $staffs_query = mysqli_query($conn, "SELECT * FROM users WHERE role='staff'");
						                     while($row = mysqli_fetch_assoc($staffs_query)){
						                         $id = $row['id'];
						                         $fullname = $row['fullname'];
						                   ?>
						                   <option value='<?=$id?>'>
						                       <?=ucwords(strtolower($fullname))?>
						                   </option>
						                  
						                   <?php
						                      }
						                   ?>
						               </select>
                                        <input hidden name='staff_fullname' value='<?=$row["fullname"]?>' />
						              </div>
						              <div class='form-group mb-2'>
						                  <button class='btn btn-primary text-white' type='submit' name='make_admin'>Submit</button>
						              </div>
						            </form>
						          </div>
						    </div><!--//app-card-body-->
						   <!--Make Admin Ends-->
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

