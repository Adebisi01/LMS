<!DOCTYPE html>
<?php require_once('include.php')?>
<html lang="en"> 
<head>
    <title>My Profile | <?=$app_title?></title>
    
    <!-- Meta -->
    
  <?php require_once('links.php') ?>

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>

    </header><!--//app-header-->
    <?php require_once('../config/controllers/edit-profile.php') ?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 ">
				    <div class="col-auto d-flex justify-content-between w-100">
			            <h1 class="app-page-title mb-0">My Profile</h1>
			            <button class='btn btn-primary text-white' data-bs-toggle="modal" data-bs-target="#passwordModal">Change Password</button>
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
			<?=$status_msg?>
			    <?php 
	
			        $user = mysqli_query($conn, "SELECT * FROM users WHERE id= '$current_user_id'");
			        
			        $row = mysqli_fetch_assoc($user);
			        $user_profile_id = $row['id'];
			        $user_sub = $row['subscription'];
			        
			    ?>
	        <section id="main-content ">
                                 
                    <div class="row">
                        <div class="col-lg-12">
                          <div class="card p-4">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <!--Details Table-->
                                <div class="tab-content">
                                 <div class="tab-pane active" id="home">
                                    <br>
                                    <div class="row" style='width:100%'>
                                        <center class="col-md-6">
                                 
                                            <img src='../assets/images/users/<?=$row["passport"]?>' class="rounded-circle w-50"/>
                                       </center>
                                       <div class="col-md-6">
                                          <h3 class="prof-head"> <i class="fa fa-user"> </i> <span>Basic Info</span></h3>
                                          <hr>
                                          <table class="table table-striped" >
                                             <tbody>
                                                <tr>
                                                   <td>Name : </td>
                                                   <td><?=$row['fullname']?></td>
                                                </tr>
                                                <tr>
                                                   <td >Email Address : </td>
                                                   <td><?=$row['email']?></td>
                                                </tr>
                                                <tr>
                                                   <td >Phone : </td>
                                                   <td><?=$row['phone']?></td>
                                                </tr>
                                                <tr>
                                                   <td >Registered : </td>
                                                   <td><?=$row['date']?></td>
                                                </tr>
                                               
                                             </tbody>
                                          </table>
                                          <br>
                                          <!-- Contact Info-->
                                          
                                         
                                       </div>
                                       <div class="col-md-6">
                                           <h3 class="prof-head sp"> <i class="fa fa-phone"> </i> <span>Contact Info</span></h3>
                                          <hr>
                                          <table class="table table-striped" >
                                             <tbody>
                                                <tr>
                                                   <td scope="row" >Email : </td>
                                                   <td><a href="mailto:<?=$row['email']?>" class="a"><?=$row['email']?></a></td>
                                                </tr>
                                                <tr>
                                                   <td scope="row" >Phone : </td>
                                                   <td><a href="tel:<?=$row['phone']?>" class="a"><?=$row['phone']?></a></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                          <br>
                                           </div>
                                       <div class="col-md-6">
                                          <!--Bank Details-->
                                          <h3 class="prof-head spsc"> <i class="fas fa-wallet" > </i> 
                                             <span>Subscription Details </span>
                                          </h3>
                                          <hr>
                                          <?php $user_subscription_details = mysqli_query($conn, "SELECT * FROM user_subscriptions WHERE subscriber='$current_user_id' ORDER BY id DESC LIMIT 1" );
                                                $subscription_details = mysqli_fetch_assoc($user_subscription_details);
                                                $sub_type = $subscription_details['type'];
                                                
                                                $user_sub_name_query = mysqli_query($conn, "SELECT name FROM subscription_plans WHERE id='$sub_type'");
                                                $user_sub_name = mysqli_fetch_assoc($user_sub_name_query)['name'];
                                          ?>
                                          <table class="table table-striped" >
                                             <tbody>
                                                <tr>
                                                   <td scope="row">Subscription Type : </td>
                                                   <td><?=$user_sub_name?></td>
                                                </tr>
                                                <tr>
                                                   <td>Subscription Date  : </td>
                                                   <td><?=$subscription_details['subscription_date']?></td>
                                                </tr>
                                                <tr>
                                                   <td scope="row">Expiration Date : </td>
                                                   <td><?=$subscription_details['expiry_date']?></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                          <br>
                                          
                                        
                                       </div>
                                    </div>
                                 </div>
                                  
                                    </div>
                                </div>
                                <br>
                                <!--Training table-->
                                
                                
                                
                            </div>
                            <!-- /# card -->
                        </div>
                       
                    </div>
                    <!-- /# row -->
                  
                </section>
		    
	    </div><!--//app-content-->
	    
<?php require_once('footer.php') ?><!--//app-footer-->
<?php require_once('modal.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>

<script>
    $('#confirm_password').keyup(function(){
       
        if($('#confirm_password').val() !== $('#new_password').val()){
             
            $('#error_msg').text('New passwords do not match')
            $('#saveBtn').attr('disabled', true);
        }else{
            $('#error_msg').text('');
            $('#saveBtn').attr('disabled', false);
        }
    })
</script>
</body>
</html> 

