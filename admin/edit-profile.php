.<!DOCTYPE html>
<?php require_once('include.php')?>
<html lang="en"> 
<head>
    <title>Edit Profile | <?=$app_title?></title>
    
    <!-- Meta -->
    
  <?php require_once('links.php') ?>

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>

    </header><!--//app-header-->
    <?php require_once('../config/controllers/edit-profile.php') ?>
    <?php 
			    if(isset($_POST['user_id'])){
			        $_SESSION['user_profile_id'] = $_POST['user_id'];
			    }
			        $user_id = $_SESSION['user_profile_id'] ;
			        $user = mysqli_query($conn, "SELECT * FROM users WHERE id= '$user_id'");
			        
			        $row = mysqli_fetch_assoc($user);
			        
			   
			    ?>
    <div class="app-wrapper">
	   
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			   <?=$status_msg?>  
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Edit Profile</h1>
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
			    
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
						        
							    
			<form action=""  method="post" enctype="multipart/form-data" class='p-4'>
             
            <!-- Row -->
                <div class="row rowtop top-shift" >               
          
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-md-5">

                        <div class="card mycard">
                            <div class="card-block">
                            <center>
                               <div class="avatar pb-2">
                                <h4>UPLOAD PHOTO</h4>
                               <img src="../assets/images/users/<?=$row['passport']?>" alt=" Icon" class="img-fluid rounded-circle w-25"  id="blah">

                               <br>
                               <p></p>
                             <label>
                            <a class="btn btn-default">Browse for Pictures...</a>
                                <input type="file" name="user_passport" style="display:none;" onchange='Test.UpdatePreview(this)' id="passports" value="<?=$row['passport']?>" />
                            </label>

                              </div>                              
                            </center>
                            </div>
                        </div>
                 </div>
                <div class="col-md-5">
                 <div class='form-group w-100 mb-2'>
                     <input class='form-control py-2' type='text' name='user_fullname' required placeholder='Full Name' value="<?=$row['fullname']?>"/>
                 </div>
                 <div class='form-group w-100 mb-2'>
                     <input class='form-control py-2' type='text' name='email' required placeholder='Email Address' value="<?=$row['email']?>"/>
                 </div>
                 <div class='form-group w-100 mb-2'>
                     <input class='form-control py-2' type='text' name='phone' required placeholder='Phone Number' value="<?=$row['phone']?>"/>
                 </div>
                 <div class='form-group w-100 mb-2'>
                     <select class='form-control py-2' name='user_type' required>
                         <option>
                             --- Select User Type---
                         </option>
                         <?php if($current_user_role == 'superAdmin'):?>
                         <option <?=$user_type = $row['role'] == 'superAdmin'?'selected':''?> value='superAdmin' >
                             Super Admin
                         </option>
                         <?php endif?>
                         <option <?=$user_type = $row['role'] == 'admin'?'selected':''?> value='admin'>
                             Admin
                         </option>
                         <option <?=$user_type = $row['role'] == 'staff'?'selected':''?> value='staff'>
                             Librarian
                         </option>
                         <option <?=$user_type = $row['role'] == 'user'?'selected':''?> value='user'>
                             User
                         </option>
                     </select>
                 </div>
                 
			    </div>    
			    
			    
		    </div>
		    <div class="col-md-5 d-flex justify-content-between gap-2">
			    <div class="col-sm-12 mb-2">
                     <label>Assign To Location</label>
                      <?php $get_team_query = mysqli_query($conn, "SELECT * FROM teams");?>
                      
                    <select  class="form-control form-control-line" name='user_team[]' class="selectpicker" id="selectpicker" placeholder="Select Team" multiple data-live-search="true" required>						    
                              <?php while($teams = mysqli_fetch_assoc($get_team_query)): ?>
    						      <option <?=$selected = strpos($row['team'],$teams['team_id']) == ''?'': 'selected'?> value="<?=$teams['team_id']?>">
    						          <?=$teams['name']?>
    						      </option>
    						  <?php endwhile?>
                    </select>	
                    	
                </div>
                 <?php $get_sub_query = mysqli_query($conn, "SELECT * FROM subscription_plans");?>
                      <?php if(mysqli_num_rows($get_sub_query) > 0): ?>
                	<div class="col-sm-12 mb-2">
                     <label>Add Subscription</label>
                      
                      
                    <select  class="form-control form-control-line" name='subscription' required>						    
                              <?php while($subs = mysqli_fetch_assoc($get_sub_query)): ?>
    						      <option value="<?=$subs['id']?>" <?=$active_sub = $row['subscription'] == $subs['id']?'selected': ''?>>
    						          <?=$subs['name']?> (<?=$subs['duration']?> Months)
    						      </option>
    						  <?php endwhile?>
                    </select>	
                    	
                </div>
                <?php endif?>
                <input hidden name='user_id'value="<?=$row['id']?>" />
			</div>
                <div class='form-group'>
                    <button type='submit' name='update_user' class='btn btn-primary mt-2 text-white'>Update</button>
                </div>
		
		   
      </form>
					
		    </div><!--//app-card-->
					
						
		</div><!--//tab-pane-->
			      
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
<?php require_once('footer.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>
<script>
    $(document).ready(function() {
        $('#selectpicker').bsMultiSelect({
            useCssPatch:true,
    valueMissingMessage:'Select A Location'

        }); 
    });
</script>
</body>
</html> 

