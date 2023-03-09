<?php require_once('../config/controllers/active_teams.php') ?>
<?php require_once('../config/functions/query_functions.php') ?>
        <div class="app-header-inner">  
	        <div class="container-fluid py-2">
		        <div class="app-header-content"> 
		            <div class="row justify-content-between align-items-center">
			        
				    <div class="col-auto">
					    <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
						    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>Menu</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
					    </a>
				    </div><!--//col-->
		         
		                   
		            <?php 
		                   // Get Teams
		                   
		                $allowed_team_array = explode(',', $current_user_team);
		                $mul_team_query = gen_mul_allowed_team("SELECT * FROM teams", $allowed_team_array);

		                $teams_query = mysqli_query($conn, $mul_team_query);
		                $team_num = mysqli_num_rows($teams_query);
		                
		                //Get Active teams
		                    $active_teams_query = mysqli_query($conn, "SELECT active_team FROM users WHERE id='$current_user_id' LIMIT 1");
		                    $active_team = mysqli_fetch_assoc($active_teams_query)['active_team'];
		                
		            ?>
		            <div class="app-utilities col-auto">
			            <div class="app-utility-item app-notifications-dropdown dropdown">    
				            <a class="dropdown-toggle no-toggle-arrow" id="notifications-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" title="Locations">
					            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					           <button class='btn btn-primary text-white'>Locations</button>
					            <span class="icon-badge bg-primary"><?=$team_num?></span>
					        </a><!--//dropdown-toggle-->
					        
					        <div class="dropdown-menu p-0" aria-labelledby="notifications-dropdown-toggle">
					            <div class="dropdown-menu-header p-3">
						            <h5 class="dropdown-menu-title mb-0">Locations</h5>
						        </div><!--//dropdown-menu-title-->
						        <form action='' method='post'>
						        <div class="dropdown-menu-content">
						            
						            <?php  while($team = mysqli_fetch_assoc($teams_query)):?>
							       <div class="item p-3">
								        <div class="row gx-2 justify-content-between align-items-center">
									        <div class="col-auto">
										  
									        </div><!--//col-->
									        <div class="col">
										        <div class="info"> 
										        
											        <div class="desc">
											            <label ><input class='checkBoxTeam' <?=$checked = strpos($active_team,$team['team_id']) == ''?'': 'checked'?>  type="checkbox" id="" name="active_teams[]" value="<?=$team['team_id']?>" /> <?=$team['name']?></label>
											              
                                                    </div>
											        <!--<div class="meta"> 2 hrs ago</div>-->
										        </div>
									        </div><!--//col--> 
								        </div><!--//row-->
								  
							       </div><!--//item-->
							       <?php endwhile?>
						        </div><!--//dropdown-menu-content-->
						        
						        <div class="dropdown-menu-footer p-2 text-center">
							        <button type='submit' id='manageTeam' name='set_active_team' class='btn btn-primary text-white'>Manage</button>
						        </div>
							</form>								
							</div><!--//dropdown-menu-->					        
				        </div><!--//app-utility-item-->
			     
			            
			            <div class="app-utility-item app-user-dropdown dropdown">
				            <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img src="../assets/images/users/<?=$current_user_passport?>" alt="user profile"></a>
				            <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
								<li><a class="dropdown-item" href="my_profile">My Profile</a></li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="logout">Log Out</a></li>
							</ul>
			            </div><!--//app-user-dropdown--> 
		            </div><!--//app-utilities-->
		        </div><!--//row-->
	            </div><!--//app-header-content-->
	        </div><!--//container-fluid-->
        </div><!--//app-header-inner-->
        
