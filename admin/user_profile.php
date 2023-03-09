<!DOCTYPE html>
<?php require_once('include.php')?>
<?php require_once('../config/controllers/members.php') ?>
<html lang="en"> 
<head>
    <title>User Profile | <?=$app_title?></title>
    
    <!-- Meta -->
    
  <?php require_once('links.php') ?>

</head> 
   <?php 
			    if(isset($_POST['user_id'])){
			        $_SESSION['profile_id'] = $_POST['user_id'];
			    }
			        $user_id = $_SESSION['profile_id'] ;
			        $user = mysqli_query($conn, "SELECT * FROM users WHERE id= '$user_id'");
			        
			        $row = mysqli_fetch_assoc($user);
			        $user_profile_id = $row['id'];
			        
			        $fullname = $row['fullname'];
			        $passport = $row['passport'];
			        $team_id = $row['team'];
			        $id = $row['id'];
			        
			        
			        $status = $row['status'];
			        
			    ?>

<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>

    </header><!--//app-header-->
    
<?php require_once('../config/controllers/receipts.php') ?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto d-flex justify-content-between w-100">
			            <h1 class="app-page-title mb-0">Profile</h1>
			            <div>
			                <?php if($status == 'active' || $status == 'blacklisted'):?>
        												        
    							    <?php if($status == 'active'):?>
    							        <button class='btn btn-warning' title='Add To Blacklist' data-bs-toggle="modal" data-bs-target="#blacklistModal<?=$id?>"><i class="bi bi-person-fill-slash h5 text-white"></i></button>
    							        <button class='btn btn-success' title='Upload Receipt' data-bs-toggle="modal" data-bs-target="#receiptModal<?=$id?>"><i class="bi bi-cloud-arrow-up h5 text-white"></i></button>
    							    
    							    <?php elseif($status == 'blacklisted'):?>
    							        <button class='btn btn-success' title='Remove From Blacklist' data-bs-toggle="modal" data-bs-target="#restoreModal<?=$id?>"><i class="bi bi-person-fill-check h5 text-white"></i></button>
    							    <?php endif ?>
    					    
    					    <?php endif ?>
    					<?php if($status == 'fined') : ?>
    					    <button class='btn btn-secondary' title='Acknowledge Fine Payment' data-bs-toggle="modal" data-bs-target="#finePaymentModal<?=$id?>"><i class="bi bi-credit-card-fill h5 text-white"></i></button>
    					 
    					 <?php else:?>
    					    <button class='btn btn-secondary' title='Fine User' data-bs-toggle="modal" data-bs-target="#fineModal<?=$id?>"><i class="bi bi-credit-card-2-front h5 text-white"></i></button>
    					 <?php endif; ?>
    					<form action='edit-profile' method='post' style='display:inline-block'>
                            	    <button type='submit' class='btn btn-info' name='user_id' value='<?=$id?>' title='Edit profile'><i class="bi bi-pencil text-white h5"></i></button>
                            </form>
			            </div>
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
			 
	        <section id="main-content ">
	            
	            <?=$status_msg?>
	            
	             <!--Restore modal-->
                                                <div class="modal fade" id="restoreModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Remove <?=$fullname?> from blacklist</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                 <label for='blacklistInput' class='fst-italics mb-1'>Type RESTORE to confirm</label>
                                                                <input class='form-control mb-2' name='word_check' id='restoreInput<?=$id?>' required placeholder='RESTORE'/>
                                                                <textarea class='form-control mb-2' name='reason' placeholder='Why are you removing this person from blacklist' required style='min-height:100px'></textarea>

                                                            </div>
                                                          </div>
                                                          <input name='restore_id' hidden value='<?=$id?>'/>
                                                          <input name='fullname' hidden value='<?=$fullname?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='restore'  id='restoreButton<?=$id?>' class="btn btn-success text-white" >Restore</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Restore modal ends-->
                                                      <!--BlackList modal-->
                                                <div class="modal fade" id="blacklistModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Blacklist <?=$fullname?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                            <div class='form-group'>
                                                                <label for='blacklistInput' class='fst-italics mb-1'>Type BLACKLIST to confirm</label>
                                                                <input class='form-control mb-2' name='word_check' id='blacklistInput' required placeholder='BLACKLIST'/>
                                                                <textarea class='form-control mb-2' name='reason' placeholder='Why are you blacklisting this person' required style='min-height:100px'></textarea>
                                                            </div>
                                                          </div>
                                                          <input name='blacklist_id' hidden value='<?=$id?>'/>
                                                          <input name='fullname' hidden value='<?=$fullname?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='blacklist' id='blacklistButton' class="btn btn-danger text-white blacklistButton">Blacklist</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Blacklist modal ends-->
                                                      <!--Inactive modal-->
                                                    <!--    <div class="modal fade" id="inactiveModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
                                                    <!--  <div class="modal-dialog">-->
                                                    <!--    <div class="modal-content">-->
                                                    <!--      <div class="modal-header">-->
                                                    <!--        <h5 class="modal-title" id="exampleModalLabel">Deactivate <?=$fullname?></h5>-->
                                                    <!--        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                                                    <!--      </div>-->
                                                    <!--     <form action='' method='post'>-->
                                                    <!--      <div class="modal-body">-->
                                                    <!--        <div class='form-group'>-->
                                                    <!--            <label for='blacklistInput' class='fst-italics mb-1'>Type INACTIVE to confirm</label>-->
                                                    <!--            <input class='form-control' name='word_check' required placeholder='INACTIVE'/>-->
                                                    <!--        </div>-->
                                                    <!--      </div>-->
                                                    <!--      <input name='inactive_id' hidden value='<?=$id?>'/>-->
                                                    <!--      <input name='fullname' hidden value='<?=$fullname?>'/>-->
                                                    <!--      <div class="modal-footer">-->
                                                    <!--        <button type="submit" name='inactive' class="btn btn-danger text-white blacklistButton">Deactivate</button>-->
                                                    <!--        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
                                                    <!--      </div>-->
                                                    <!--      </form>-->
                                                    <!--    </div>-->
                                                    <!--  </div>-->
                                                    <!--</div>-->
                                                    <!--Inactive modal ends-->
                                                       <!--Fine modal-->
                                                <div class="modal fade" id="fineModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Fine <?=$fullname?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                           
                                                            <div class='form-group mb-2'>
                                                                <textarea class='form-control' name='reason' placeholder='Why are you fining this user' required style='min-height: 100px'></textarea>
                                                            </div>
                                                            <div class='form-group mb-2'>
                                                                <input class='form-control' type='number' name='amount' placeholder='Fine amount in Naira' required/>
                                                            </div>
                                                            
                                                          </div>
                                                          <input name='user_id' hidden value='<?=$id?>'/>
                                                          <input name='fullname' hidden value='<?=$fullname?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='fine' class="btn btn-danger text-white">Fine</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Fine modal ends-->
                                                       <!--Acknowledge Fine payment modal-->
                                                <div class="modal fade" id="finePaymentModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Acknowledge Payment</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                         <form action='' method='post'>
                                                          <div class="modal-body">
                                                         <h4 class='text-danger'>  You Acknowledge the payment of <?=$fullname?> fine</h4>
                                                            
                                                          </div>
                                                          <input name='user_id' hidden value='<?=$id?>'/>
                                                          <input name='fullname' hidden value='<?=$fullname?>'/>
                                                          <div class="modal-footer">
                                                            <button type="submit" name='remove_fine' class="btn btn-success text-white">Acknowledge</button>
                                                          </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <!--Acknowledge Fine payment ends-->
                                                    
                                            <!--Receipt Upload Modal -->
                                                    <div class="modal fade" id="receiptModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Upload Receipt</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                          <form action='' method='post' enctype="multipart/form-data">
                                                              <div class="modal-body">
                                                                <div class='form-group mb-2'>
                                                                    <input class='form-control' type='text' name='subject' required placeholder='What is this receipt for?'/>
                                                                </div>
                                                                <div class='form-group mb-2'>
                                                                    <input class='form-control' type='file' name='file' required placeholder='Upload receipt'/>
                                                                </div>
                                                              </div>
                                                              <input hidden name='user_id' value='<?=$id?>'/>
                                                              <input hidden name='fullname' value='<?=$fullname?>'/>
                                                              <input hidden name='team_id' value='<?=$team_id?>'/>
                                                              <div class="modal-footer">
                                                                <button type="submit" name='upload_receipt' class="btn btn-primary text-white">Save</button>
                                                              </div>
                                                        </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                            <!--Receipt Upload Modal Ends-->
	            
	            
                                 
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
                                 
                                        <img src='../assets/images/users/<?=$passport?>' class="rounded-circle w-50"/>
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
                                                   <td >User ID : </td>
                                                   <td><?=$row['user_id']?></td>
                                                </tr>
                                                <tr>
                                                   <td >Registered : </td>
                                                   <td><?=$row['date']?></td>
                                                </tr>
                                               
                                             </tbody>
                                          </table>
                                          <br>
                                         </div>
                                         <div class="col-md-6">
                                          <!-- Contact Info-->
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
                                          <?php $user_subscription_details = mysqli_query($conn, "SELECT type, subscription_date, expiry_date FROM user_subscriptions WHERE subscriber='$user_profile_id' ORDER BY id DESC LIMIT 1" );
                                            $sub = mysqli_fetch_assoc($user_subscription_details);
                                            $sub_type = $sub['type'];
                                            
                                            $sub_type_query = mysqli_query($conn, "SELECT * FROM subscription_plans WHERE id='$sub_type'");
                                                $sub_details = mysqli_fetch_assoc($sub_type_query);
                                          ?>
                                          <table class="table table-striped" >
                                             <tbody>
                                                <tr>
                                                   <td scope="row">Subscription Type : </td>
                                                   <td><?=$sub_details['name']?></td>
                                                </tr>
                                                <tr>
                                                   <td>Subscription Date  : </td>
                                                   <td><?=$sub['subscription_date']?></td>
                                                </tr>
                                                <tr>
                                                   <td scope="row">Expiration Date : </td>
                                                   <td><?=$sub['expiry_date']?></td>
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
                                <h4>Books Borrowed</h4>
                                
                                <table id="data" class="table table-striped table-bordered">
                                      <thead>
                                        <tr>
                                          <th scope="col">Sn</th>
                                          <th scope="col">Book</th>
                                          <th scope="col">Status</th>
                                          <th scope="col">Date</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          <?php 
                                          $index = 0;
                                            $history = mysqli_query($conn, "SELECT * FROM borrow_requests WHERE borrower_id = '$user_profile_id' AND status='approved' || borrower_id = '$user_profile_id' AND status='returned'") ;
                                            while($row = mysqli_fetch_assoc($history)){
                                                $index++;
                                                $book_id = $row['book_id'];
                                                $date = $row['date'];
                                                $status = $row['status'];
                                                
                                                $details = mysqli_query($conn, "SELECT title, author FROM books WHERE id='$book_id'");
                                                    $row1 = mysqli_fetch_assoc($details);
                                                    $author = $row1['author'];
                                                    $title = $row1['title'];
                                          ?>
                                        <tr>
                                          <td scope="row"><?=$index?></td>
                                          <td><span class='text-truncate'><?=$title . ' by ' . $author?></span></td>
                                          <td><?=$status?></td>
                                          <td><?=$date?></td>
                                             <?php } ?>
                                
                                        </tr>
                                    </tbody>
                                    </table>
                                
                                
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

