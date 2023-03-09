<!DOCTYPE html>
<?php require_once('include.php')?>
<?php require_once('../config/controllers/staffs.php') ?>
<html lang="en"> 
<head>
    <title>Staff Profile | <?=$app_title?></title>
    
    <!-- Meta -->
    
  <?php require_once('links.php') ?>

</head> 
  <?php 
			    if(isset($_POST['staff_id'])){
			        $_SESSION['staff_profile_id'] = $_POST['staff_id'];
			    }
			        $staff_id = $_SESSION['staff_profile_id'] ;
			        $staff = mysqli_query($conn, "SELECT * FROM users WHERE id= '$staff_id'");
			        
			        $row = mysqli_fetch_assoc($staff);
			        $staff_profile_id = $row['id'];
			        $id = $row['id'];
			        $fullname = $row['fullname'];
			        $status = $row['status'];
			        $staff_team_string = $row['team'];
			        
			        
			        // Turn team string to array
			      $staff_team_array = explode(',', $staff_team_string);
			    ?>
			    
<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>

    </header><!--//app-header-->
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 ">
				    <div class="col-auto d-flex justify-content-between w-100">
			            <h1 class="app-page-title mb-0 ">Staff Profile</h1>
			            
			            <div>
                            <?php if($status == 'active'):?>
                            	        <button class='btn btn-danger' title='Archive' data-bs-toggle="modal" data-bs-target="#archiveModal<?=$id?>"><i class="bi bi-archive-fill h5 text-white"></i></button>
                            	    <?php elseif($status == 'archived'):?>
                            	        <button class='btn btn-success' title='Activate' data-bs-toggle="modal" data-bs-target="#restoreModal<?=$id?>"><i class="bi bi-person-fill-add h5 text-white"></i></button>
                            	    <?php endif ?>
                            <form action='edit-profile' method='post' style='display:inline-block'>
                            	    <button type='submit' class='btn btn-info' name='user_id' value='<?=$id?>' title='Edit profile'><i class="bi bi-pencil text-white h5"></i></button>
                            </form>
			            </div>
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
			  <?=$status_msg?>
	        <section id="main-content ">
	            <!--Restore modal-->
                                                <div class="modal fade" id="restoreModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Remove <?=$fullname?> from archive</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                 <label for='blacklistInput' class='fst-italics mb-1'>Type RESTORE to confirm</label>
                                                                <input class='form-control mb-2' name='word_check' id='restoreInput<?=$id?>' required placeholder='RESTORE'/>
                                                                <textarea class='form-control mb-2' name='reason' placeholder='Why are you removing this person from the archive' required style='min-height:100px'></textarea>

                                                            </div>
                                                          </div>
                                                          <input name='restore_id' hidden value='<?=$id?>'/>
                                                          <input name='fullname' hidden value='<?=$fullname?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='restore'  id='restoreButton<?=$id?>' class="btn btn-success text-white" >Restore</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Restore modal ends-->
                                                      
                                                      <!--Archive modal-->
                                                        <div class="modal fade" id="archiveModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Archive <?=$fullname?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                <label for='word_check' class='fst-italics mb-1'>Type ARCHIVE to confirm</label>
                                                                <input class='form-control' name='word_check' required placeholder='ARCHIVE'/>
                                                            </div>
                                                          </div>
                                                          <input name='archive_id' hidden value='<?=$id?>'/>
                                                          <input name='fullname' hidden value='<?=$fullname?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='archive' class="btn btn-danger text-white">Archive</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Archive modal ends-->
                                                      
                                 
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
                                                   <td >Staff ID : </td>
                                                   <td><?=$row['user_id']?></td>
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
                                                <?php for($i=0; $i < count($staff_team_array); $i++){
                                                    $team_namme_query = mysqli_query($conn, "SELECT name FROM teams WHERE team_id='$staff_team_array[$i]' ");
                                                    if($i == 0){
                                                       $team_name .= mysqli_fetch_assoc($team_namme_query)['name'] ;
                                                    }else{
                                                        $team_name .= ', '.mysqli_fetch_assoc($team_namme_query)['name'] ;
                                                    }
                                                } 
                                               ?>
                                                <tr>
                                                   <td >Assigned Teams : </td>
                                                   <td><?=$team_name?></td>
                                                </tr>
                                               
                                             </tbody>
                                          </table>
                                          <br>
                                          <!-- Contact Info-->
                                         
                                          <br>
                                         
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
                                         </div>
                                       <div class="col-md-6">
                                          <!--Bank Details-->
                                          <!--<h3 class="prof-head spsc"> <i class="fas fa-wallet" > </i> -->
                                          <!--   <span>Subscription Details </span>-->
                                          <!--</h3>-->
                                          <hr>
                                          <?php $user_subscription_details = mysqli_query($conn, "SELECT * FROM user_subscriptions WHERE subscriber='$user_profile_id'" );
                                                $subscription_details = mysqli_fetch_assoc($user_subscription_details)
                                          ?>
                                          <!--<table class="table table-striped" >-->
                                          <!--   <tbody>-->
                                          <!--      <tr>-->
                                          <!--         <td scope="row">Subscription Type : </td>-->
                                          <!--         <td><?=$subscription_details['type']?></td>-->
                                          <!--      </tr>-->
                                          <!--      <tr>-->
                                          <!--         <td>Subscription Date  : </td>-->
                                          <!--         <td><?=$subscription_details['subscription_date']?></td>-->
                                          <!--      </tr>-->
                                          <!--      <tr>-->
                                          <!--         <td scope="row">Expiration Date : </td>-->
                                          <!--         <td><?=$subscription_details['expiry_date']?></td>-->
                                          <!--      </tr>-->
                                          <!--   </tbody>-->
                                          <!--</table>-->
                                          <br>
                                          
                                        
                                       </div>
                                    </div>
                                 </div>
                                  
                                    </div>
                                </div>
                            </div>
                            <!-- /# card -->
                        </div>
                       
                    </div>
                    <!-- /# row -->
                  
                </section>
		    
	    </div><!--//app-content-->
	    
<?php require_once('footer.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>
</body>
</html> 

