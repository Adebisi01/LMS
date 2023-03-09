<?php $page=basename($_SERVER['PHP_SELF']); ?>
        <div id="app-sidepanel" class="app-sidepanel"> 
	        <div id="sidepanel-drop" class="sidepanel-drop"></div>
	        <div class="sidepanel-inner d-flex flex-column">
		        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
		        <div class="app-branding">
		            <a class="app-logo" href="index"><img class="logo-icon me-2" src="../assets/images/app-logo.svg" alt="logo"><span class="logo-text">Edu-Slick Study</span></a>
	
		        </div><!--//app-branding-->  
		        
			    <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
				    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
				  <li class="nav-item">
					        
					        <a class="nav-link <?php if ($page == 'dashboard.php') {echo 'active'; } ?>" href="dashboard">
						        <span class="nav-icon">
						        <i class="bi bi-microsoft"  > </i>

						         </span>
		                           <span class="nav-link-text">Dashboard</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    
					    <li class="nav-item">
					        <a class="nav-link <?php if ($page == 'registration.php') {echo 'active'; } ?>" href="registration">
						        <span class="nav-icon">    <i class="bi bi-person"></i>  </span>
		                         <span class="nav-link-text">Registration</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    
					    <li class="nav-item">
					        <a class="nav-link <?php if ($page == 'books.php') {echo 'active'; } ?>" href="books">
						        <span class="nav-icon">    <i class="bi bi-journals"  > </i>  </span>
		                         <span class="nav-link-text">Books</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    
					    <li class="nav-item">
					        
					        <a class="nav-link  <?php if ($page == 'requests.php') {echo 'active'; } ?>" href="requests">
						        <span class="nav-icon">
						     <i class="bi bi-arrow-repeat"></i>
						         </span>
		                         <span class="nav-link-text">Books Circulation</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    
					       
					  
					    
					    
					    	    <li class="nav-item">
					        
					        <a class="nav-link <?php if ($page == 'subscriptions.php') {echo 'active'; } ?>" href="subscriptions">
						        <span class="nav-icon">
						       <i class="bi bi-wallet2"></i>
						         </span>
		                         <span class="nav-link-text">Subscriptions</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    
					    
					    <li class="nav-item has-submenu">
					        
					        <a class="nav-link <?php if (($page == 'users.php') || ($page == 'staffs.php')) {echo 'active'; } ?> submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false" aria-controls="submenu-1">
						        <span class="nav-icon">
						            <i class="bi bi-people"></i> 
						         </span>
		                         <span class="nav-link-text">Members</span>
		                         <span class="submenu-arrow">
		                             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	                                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
	                                   </svg>
	                             </span><!--submenu-arrow -->
					        </a><!--//nav-link -->
					        <div id="submenu-1" class="collapse submenu submenu-1" data-bs-parent="#menu-accordion">
						        <ul class="submenu-list list-unstyled">
							        <li class="submenu-item"><a class="submenu-link" href="users">Users</a></li>
							        <li class="submenu-item"><a class="submenu-link" href="staffs">Staffs</a></li>
						        </ul>
					        </div>
				</li>
					    
					    
					    
					        <li class="nav-item">
					        <a class="nav-link  <?php if ($page == 'e-books.php') {echo 'active'; } ?> " href="e-books">
						        <span class="nav-icon">
						           <i class="bi bi-journal-richtext"></i>
						         </span>
		                         <span class="nav-link-text">E-Books</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					        <li class="nav-item">
					        <a class="nav-link  <?php if ($page == 'report.php') {echo 'active'; } ?> " href="report">
						        <span class="nav-icon">
						           <i class="bi bi-megaphone"></i>
						         </span>
		                         <span class="nav-link-text">Reports</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    
					        <li class="nav-item">
					        <a class="nav-link  <?php if ($page == 'receipts.php') {echo 'active'; } ?> " href="receipts">
						        <span class="nav-icon">
						           <i class="bi bi-receipt"></i>
						         </span>
		                         <span class="nav-link-text">Receipts</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
				
					
					     <!--   <li class="nav-item">-->
						    <!--    <a class="nav-link" href="#">-->
							   <!--     <span class="nav-icon">  <i class="bi bi-chat-right-text"></i> -->
							   <!--           </span>-->
			       <!--                 <span class="nav-link-text">Communications</span>-->
						    <!--    </a>-->
						    <!--</li>-->
						    
		
						  
						    
						    	    
					
					    
					    
	<!--				    <li class="nav-item has-submenu">
					        
	<!--				        <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">-->
	<!--					        <span class="nav-icon">-->
						        
	<!--					        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-columns-gap" fill="currentColor" xmlns="http://www.w3.org/2000/svg">-->
	<!--  <path fill-rule="evenodd" d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z"/>-->
	<!--</svg>-->
	<!--					         </span>-->
	<!--	                         <span class="nav-link-text">External</span>-->
	<!--	                         <span class="submenu-arrow">-->
	<!--	                             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">-->
	<!--  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>-->
	<!--</svg>-->
	<!--                             </span>submenu-arrow-->
	<!--				        </a><!--//nav-link -->
	<!--				        <div id="submenu-2" class="collapse submenu submenu-2" data-bs-parent="#menu-accordion">-->
	<!--					        <ul class="submenu-list list-unstyled">-->
	<!--						        <li class="submenu-item"><a class="submenu-link" href="login">Login</a></li>-->
	<!--						        <li class="submenu-item"><a class="submenu-link" href="signup">Signup</a></li>-->
	<!--						        <li class="submenu-item"><a class="submenu-link" href="reset-password">Reset password</a></li>-->
	<!--						        <li class="submenu-item"><a class="submenu-link" href="404">404 page</a></li>-->
	<!--					        </ul>-->
	<!--				        </div>-->
	<!--				    </li><!--nav-item -->
	
	
	
				    </ul>
			    </nav><!--//app-nav-->
			    <div class="app-sidepanel-footer">
				    <nav class="app-nav app-nav-footer">
					    <ul class="app-menu footer-menu list-unstyled">
					    
					    
                                 <li class="nav-item">
						        <a class="nav-link  <?php if ($page == 'notifications.php') {echo 'active'; } ?> " href="notifications">
							        <span class="nav-icon"> <i class="bi bi-bell"></i>
							              </span>
			                        <span class="nav-link-text">Notifications</span>
						        </a>
						    </li>
					    
					        
					  <li class="nav-item has-submenu">
					        
					        <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">
						        <span class="nav-icon">
						            <i class="bi bi-chat-right-text"></i> 
						         </span>
		                         <span class="nav-link-text">Communications</span>
		                         <span class="submenu-arrow">
		                             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	                                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
	                                   </svg>
	                             </span><!--submenu-arrow -->
					        </a><!--//nav-link -->
					        <div id="submenu-2" class="collapse submenu submenu-2" data-bs-parent="#menu-accordion">
						        <ul class="submenu-list list-unstyled">
							        <li class="submenu-item"><a class="submenu-link" href="feedbacks">Users Feedback</a></li>
							        <li class="submenu-item"><a class="submenu-link" href="broadcast">Broadcast</a></li>
						        </ul>
					        </div>
				</li>
					        
						    <li class="nav-item">
						        
						        <a class="nav-link  <?php if ($page == 'activity_log.php') {echo 'active'; } ?> " href="activity_log">
							        <span class="nav-icon"> <i class="bi bi-arrow-clockwise"></i>
							            </span>
			                        <span class="nav-link-text">Activity Log</span>
						        </a><!--//nav-link-->
						    </li><!--//nav-item-->
						    <li class="nav-item">
						        
						        <a class="nav-link  <?php if ($page == 'teams.php') {echo 'active'; } ?> " href="teams">
							        <span class="nav-icon"> <i class="bi bi-people"></i>
							            </span>
			                        <span class="nav-link-text">Locations</span>
						        </a><!--//nav-link-->
						    </li><!--//nav-item-->
						
						    			    <li class="nav-item">
					        
					        <a class="nav-link  <?php if ($page == 'help.php') {echo 'active'; } ?> " href="https://docs.eduslick.com/changelog/" target=_blank>
						        <span class="nav-icon"> <i class="bi bi-question-circle"></i>
						       	         </span>
		                         <span class="nav-link-text">Help</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->	
						    			    <li class="nav-item">
					        
					        <a class="nav-link  <?php if ($page == 'tutorial.php') {echo 'active'; } ?> " href="tutorial" target=_blank>
						        <span class="nav-icon"> <i class="bi bi-question-circle"></i>
						       	         </span>
		                         <span class="nav-link-text">Tutorials</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->	
						 
					    </ul><!--//footer-menu-->
				    </nav>
			    </div><!--//app-sidepanel-footer-->
		       
	        </div><!--//sidepanel-inner-->
	    </div><!--//app-sidepanel-->
	    
	    
	    