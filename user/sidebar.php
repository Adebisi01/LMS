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
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link <?php if ($page == 'dashboard.php') {echo 'active'; } ?>" href="dashboard">
						        <span class="nav-icon">
						        <i class="bi bi-microsoft"  > </i>
						         </span>
		                         <span class="nav-link-text">Dashboard</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    
					    <li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link <?php if ($page == 'my_profile.php') {echo 'active'; } ?>" href="my_profile">
						        <span class="nav-icon">
						        <i class="bi bi-person-circle"></i>
						         </span>
		                         <span class="nav-link-text">My profile</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    
					    
					    <li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link <?php if ($page == 'books.php') {echo 'active'; } ?>" href="books">
						        <span class="nav-icon">
						        <i class="bi bi-journals"  > </i>
						         </span>
		                         <span class="nav-link-text">Books</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    
					    
					    <li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link <?php if ($page == 'requests.php') {echo 'active'; } ?>" href="requests">
						        <span class="nav-icon">
						       <i class="bi bi-arrow-repeat"></i>
						         </span>
		                         <span class="nav-link-text">Book Requests</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    
					    <li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link <?php if ($page == 'e-books.php') {echo 'active'; } ?>" href="e-books">
						        <span class="nav-icon">
						       <i class="bi bi-journal-richtext"></i>
						         </span>
		                         <span class="nav-link-text">E-Books</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					   
					   
					    <!--<li class="nav-item">-->
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					    <!--    <a class="nav-link <?php// if ($page == 'notifications.php') {echo 'active'; } ?>" href="notifications">-->
						   <!--     <span class="nav-icon"> <i class="bi bi-bell"></i>-->
						   <!--      </span>-->
		       <!--                  <span class="nav-link-text">Notifications</span>-->
					    <!--    </a><!--//nav-link-->
					    <!--</li><!--//nav-item-->
					    
					    
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
							        <li class="submenu-item"><a class="submenu-link" href="feedbacks">Feedback</a></li>
							        <li class="submenu-item"><a class="submenu-link" href="broadcast">Broadcast</a></li>
						        </ul>
					        </div>
				</li>
					
					    
					    
				    </ul><!--//app-menu-->
			    </nav><!--//app-nav-->
			    <div class="app-sidepanel-footer">
				    <nav class="app-nav app-nav-footer">
					    <ul class="app-menu footer-menu list-unstyled">
						   
						    
						    <li class="nav-item">
					        <a class="nav-link  <?php if ($page == 'help.php') {echo 'active'; } ?> " href="https://docs.eduslick.com/changelog/" target='_blank'>
						        <span class="nav-icon"> <i class="bi bi-question-circle"></i>
						       	         </span>
		                         <span class="nav-link-text">Help</span>
					        </a><!--//nav-link-->
					    </li>
						    <li class="nav-item">
					        <a class="nav-link  <?php if ($page == 'tutorial.php') {echo 'active'; } ?> " href="tutorial" target='_blank'>
						        <span class="nav-icon"> <i class="bi bi-mortarboard"></i>
						       	         </span>
		                         <span class="nav-link-text">Tutorials</span>
					        </a><!--//nav-link-->
					    </li>
					    
					    
					    </ul><!--//footer-menu-->
				    </nav>
			    </div><!--//app-sidepanel-footer-->
		       
	        </div><!--//sidepanel-inner-->
	    </div><!--//app-sidepanel-->
	    
	    
	    