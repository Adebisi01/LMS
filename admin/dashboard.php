<!DOCTYPE html>
<?php require_once('include.php') ?>
<?php require_once('../config/functions/utilities.php') ?>
<?php require_once('../config/functions/query_functions.php') ?>
<html lang="en"> 
<head>
    <title>Dashboard | <?=$app_title?></title>
   <?php require_once('links.php') ?>
</head> 

<body class="app">
    <?php require_once('modal.php') ?>   
    
    <header class="app-header fixed-top">	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>
    </header><!--//app-header-->
    <?php  require_once('../config/controllers/book.php')?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">Dashboard</h1>
			    <?=$status_msg?>
			    <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
				    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">
						    <h3 class="mb-3">Welcome, <?=$current_user_name?></h3>
						    <div class="row gx-5 gy-3">
						        <div class="col-12 col-lg-9">
							        
							        <div>Here in the admin section, you can manage and view all your library information</div>
							    </div><!--//col-->
							    <div class="col-12 col-lg-3">
								    <a href="http://play.google.com/store/apps" target='_blank'><img class='w-100'  src='../assets/images/google-play-badge.png' alt='google play badge'/></a>
							    </div><!--//col-->
						    </div><!--//row-->
						  
					    </div><!--//app-card-body-->
					    
				    </div><!--//inner-->
			    </div><!--//app-card-->
				    <?php
				    $generated_query = gen_mul_team_query_without_where("SELECT * FROM books", $active_team_array);
				    $books_query = mysqli_query($conn, $generated_query);
				            $books_num = mysqli_num_rows($books_query);
				    ?>
			    <div class="row g-4 mb-4">
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Total Books</h4>
							    <div class="stats-figure"><?=$books_num?></div>
						    <div class="stats-meta text-success display-1">
<!--								    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up" fill="currentColor" xmlns="http://www.w3.org/2000/svg">-->
<!--  <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>-->
<!--</svg> 20%-->
<i class="fas fa-book"></i>
</div>
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="#"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    
				     <?php
				     $generated_query = gen_mul_team_query("SELECT * FROM users WHERE role = 'user'", $active_team_array);
				     $users_query = mysqli_query($conn, $generated_query);
				            $users_num = mysqli_num_rows($users_query);
				    ?>
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Total Users</h4>
							    <div class="stats-figure"><?=$users_num?></div>
							    <div class="stats-meta text-success">
<!--								    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">-->
<!--  <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>-->
<!--</svg> 5%-->
<i class="fas fa-users"></i>

</div>
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="#"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
						        <?php
                    			     $generated_query = gen_mul_team_query("SELECT * FROM borrow_requests WHERE status='approved'", $active_team_array);
                    			     $books_query = mysqli_query($conn, $generated_query);
                    			     $books_num = mysqli_num_rows($books_query);
                    			    ?>
							    <h4 class="stats-type mb-1">Borrowed Book</h4>
							    <div class="stats-figure"><?=$books_num?></div>
							    <div class="stats-meta text-info">
								<i class="fas fa-book-reader"></i></div>
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="#"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Due Books</h4>
							      <?php 
							    $due_books_count = 0;
							    $generated_query = gen_mul_team_query("SELECT approved_date, due_date FROM borrow_requests WHERE status = 'approved'", $active_team_array);
							    $due_books_query = mysqli_query($conn, $generated_query);
				                    
				                    while($req_details = mysqli_fetch_assoc($due_books_query)){
				                    $book_apprv_date = $req_details['approved_date'];
				                    $book_due_date = $req_details['due_date'];
				                    
				                  $is_due = date_difference($book_apprv_date, $book_due_date);
				                  $today_diff = date_difference($book_apprv_date, $current_date);
				                  
				                  if($today_diff > $is_due){
				                      $due_books_count += 1;
				                  }
				                    }
				                  ?>
							    <div class="stats-figure"><?=$due_books_count?></div>
							    <div class="stats-meta text-danger"><i class="fas fa-book-reader"></i></div>
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="#"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
			    </div><!--//row-->
				 
				 <div class="row g-4 mb-4">
				 	<div class="col-12 col-lg-6 py-2">
				        <div class="app-card app-card-stats-table h-100 shadow-sm">
					        <div class="app-card-header p-3">
						        <div class="row justify-content-between align-items-center">
							        <div class="col-auto">
						                <h4 class="app-card-title">Top Books</h4>
							        </div><!--//col-->
							        <div class="col-auto">
								        <div class="card-header-action">
									        <!--<a href="#">View report</a>-->
								        </div><!--//card-header-actions-->
							        </div><!--//col-->
						        </div><!--//row-->
					        </div><!--//app-card-header-->
							        <div class="app-card-body p-3 p-lg-4">
						        <div class="table-responsive">
							        <table class="table table-borderless mb-0">
										<thead>
											<tr>
												<th class="meta">Book</th>
												<th class="meta stat-cell">Read By</th>
											</tr>
										</thead>
										<tbody>
                                <?php
							     $generated_query = gen_mul_team_query_without_where("SELECT * FROM `books`", $active_team_array);
							    $read_query = mysqli_query($conn, $generated_query." ORDER BY `read_by` DESC LIMIT 5") ;
							       while($row = mysqli_fetch_assoc($read_query)){
							           $book_title = $row['title']
							      
							    ?>
							     <!--Download Details MOdal-->
                                   <div class="modal fade" id="detailBook<?=$row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?=$row['title']?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body d-flex">
                                            <div class='w-50 d-flex align-items-center justify-content-center'>
                                                <img class='w-50' src='../assets/covers/<?=$row["cover"]?>' alt='' />
                                            </div>
                                            <div>
                                                <h4><?=$row['title']?></h4>
                                                <div class='d-flex flex-column'>
                                                    <span>Published: <?=$row['publish_year']?></span>
                                                    <span>Language: <?=$row['language']?></span>
                                                    <span>Downloads: <?=$row['downloads']?> </span>
                                                    <span>Author: <?=$row['author']?> </span>
                                                    <span>Edition: <?=$row['edition']?> </span>
                                                </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                           <a href='books?search=<?=$book_title?>'> <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">Search</button></a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                       <!-- Downloads Details Modal Ends-->
							    
											<tr class='border-top'>
												<td><a style='cursor:pointer' class='text-primary' data-bs-toggle="modal" data-bs-target="#detailBook<?=$row['id']?>"><?=$book_title?></a></td>
												<td class="stat-cell"><?=$row['read_by']?></td>
											</tr>
										<?php  } ?>
    								    </tbody>
    									</table>
    						        </div><!--//table-responsive-->
    					        </div><!--//app-card-body-->
    				        </div><!--//app-card-->
    			        </div><!--//col-->
    			       
    			        
    			       <!--Most Downloaded -->
				 	<div class="col-12 col-lg-6 py-2">
				        <div class="app-card app-card-stats-table h-100 shadow-sm">
					        <div class="app-card-header p-3">
						        <div class="row justify-content-between align-items-center">
							        <div class="col-auto">
						                <h4 class="app-card-title">Most Downloaded</h4>
							        </div><!--//col-->
							        <div class="col-auto">
								        <div class="card-header-action">
									        <!--<a href="#">View report</a>-->
								        </div><!--//card-header-actions-->
							        </div><!--//col-->
						        </div><!--//row-->
					        </div><!--//app-card-header-->
							        <div class="app-card-body p-3 p-lg-4">
						        <div class="table-responsive">
							        <table class="table table-borderless mb-0">
										<thead>
											<tr>
												<th class="meta">Book</th>
												<th class="meta stat-cell">Downloads</th>
											</tr>
										</thead>
										<tbody>
                                <?php
							       $downloads_query = mysqli_query($conn, "SELECT * FROM `books` WHERE type='e_book' ORDER BY `downloads` DESC LIMIT 5") ;
							       while($row = mysqli_fetch_assoc($downloads_query)){
							           $book_title = $row['title']
							      
							    ?>
							     <!--Download Details MOdal-->
                                   <div class="modal fade" id="detailBook<?=$row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?=$row['title']?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body d-flex">
                                            <div class='w-50 d-flex align-items-center justify-content-center'>
                                                <img class='w-50' src='../assets/covers/<?=$row["cover"]?>' alt='' />
                                            </div>
                                            <div>
                                                <h4><?=
                                                $row['title']?></h4>
                                                <div class='d-flex flex-column'>
                                                    <span>Published: <?=$row['publish_year']?></span>
                                                    <span>Language: <?=$row['language']?></span>
                                                    <span>Downloads: <?=$row['downloads']?> </span>
                                                    <span>Author: <?=$row['author']?> </span>
                                                    <span>Edition: <?=$row['edition']?> </span>
                                                </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                           <a href='e-books?search=<?=$book_title?>'> <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">Search</button></a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                       <!-- Downloads Details Modal Ends-->
							    
											<tr class='border-top'>
												<td><a style='cursor:pointer' class='text-primary' data-bs-toggle="modal" data-bs-target="#detailBook<?=$row['id']?>"><?=$book_title?></a></td>
												<td class="stat-cell"><?=$row['downloads']?></td>
											</tr>
										<?php  } ?>
    								    </tbody>
    									</table>
    						        </div><!--//table-responsive-->
    					        </div><!--//app-card-body-->
    				        </div><!--//app-card-->
    			        </div><!--//col-->
    			      </div>
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    

	    

	    <!--Add new books modal ends -->
<?php require_once('footer.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

 
    <!-- Javascript -->          
<?php require_once('scripts.php') ?>

</body>
</html> 

