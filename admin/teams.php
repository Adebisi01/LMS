<!DOCTYPE html>
<?php require_once('include.php')?>
<html lang="en"> 
<head>
    <title>Locations | <?=$app_title?></title>
    
    <!-- Meta -->
    
  <?php require_once('links.php') ?>

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>

    </header><!--//app-header-->
    <?php require_once('../config/controllers/teams.php') ?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto w-100 d-flex justify-content-between">
			            <h1 class="app-page-title mb-0">Location</h1>
			            <button class='btn btn-primary text-white' data-bs-toggle="modal" data-bs-target="#createTeamModal">Create Location</button>
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
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
												<th class="cell">Name</th>
												<th class="cell">Location</th>
												<!--<th class="cell">Action</th>-->
											</tr>
										</thead>
										<tbody>
										    <?php
										    $index = 0;
										    $team_query = mysqli_query($conn, "SELECT * FROM `teams` ORDER BY id DESC");
										        while($row = mysqli_fetch_assoc($team_query)){
										            $index++;
										            $id = $row['id'];
										            $team_id = $row['team_id'];
										            $name = $row['name'];
										            $location = $row['location'];

                                                ?>
                                                
                                                <!-- Delete Team Modal-->
                                                    <!--<div class="modal fade" id="deleteModal<?=$id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
                                                    <!--  <div class="modal-dialog">-->
                                                    <!--    <div class="modal-content">-->
                                                    <!--      <div class="modal-header">-->
                                                    <!--        <h5 class="modal-title" id="exampleModalLabel">Delete <?=$name?></h5>-->
                                                    <!--        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                                                    <!--      </div>-->
                                                    <!--     <form action='' method='post'>-->
                                                    <!--      <div class="modal-body">-->
                                                    <!--        <div class='form-group'>-->
                                                    <!--            <label for='word_check' class='fst-italic'>Type DELETE to delete</label>-->
                                                    <!--            <input class='form-control' name='word_check' placeholder='DELETE' />-->
                                                    <!--        </div>-->
                                                    <!--        <input name='team_id' hidden value='<?=$id?>' />-->
                                                    <!--        <input name='team_name' hidden value='<?=$name?>' />-->
                                                    <!--      </div>-->
                                                    <!--      <div class="modal-footer">-->
                                                    <!--        <button type="submit" name='delete_team' class="btn btn-danger text-white">Delete</button>-->
                                                    <!--      </div>-->
                                                    <!--     </form>-->
                                                    <!--    </div>-->
                                                    <!--  </div>-->
                                                    <!--</div>-->
                                            <!-- Delete Team Modal Ends-->
                                                
											<tr>
												<td class="cell"><?=$index?></td>
												<td class="cell"><span><?=$name?></span></td>
												<td class="cell"><span><?=$location?></span></td>
												<!--<td class="cell"><button class='btn btn-danger' data-bs-toggle="modal" data-bs-target="#deleteModal<?=$id?>"><i class="bi bi-trash3-fill text-white"></i></button></td>-->
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
	    </div><!--//app-content-->
	    
<?php require_once('footer.php') ?><!--//app-footer-->
<?php require_once('modal.php') ?>
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>
</body>
</html> 


