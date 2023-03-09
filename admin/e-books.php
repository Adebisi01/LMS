<!DOCTYPE html>
<?php require_once('include.php') ?>
<html lang="en"> 
<head>
    <title>E-Books | <?=$app_title?> </title>
    
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
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			           <a href='e-books'><h1 class="app-page-title mb-0">E-Books</h1></a>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    <form class="docs-search-form row gx-1 align-items-center" action=''>
					                    <div class="col-auto">
					                        <input type="text" id="search-docs" name="search" class="form-control search-docs" placeholder="Search" required>
					                    </div>
					                    <div class="col-auto">
					                        <button type="submit" class="btn app-btn-secondary">Search</button>
					                    </div>
					                </form>
					                
							    </div><!--//col-->
							  
                            <div class="dropdown col-auto">
                              <a class="btn app-btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                     Add Book
                              </a>
                            
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form action='add_book' method='post'>
                                    <li><button class="dropdown-item" name='book_type' type='submit' value='hard_copy'>Hard Copy</button></li>
                                    <li><button class="dropdown-item" name='book_type' type='submit' value='e_book'>E-Book</button></li>
                                </form>
                              </ul>
                            </div>

						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			     <?php 
			        if(isset($_GET['search'])){
			            $search_key = $_GET['search'];
			            $books = mysqli_query($conn, "SELECT * FROM books WHERE (title LIKE '%$search_key%' OR author LIKE '%$search_key%') AND status='active' AND type='e_book' ORDER BY id DESC");
			        
			            $search_count = mysqli_num_rows($books);
			        }else{
			            $books = mysqli_query($conn, "SELECT * FROM books WHERE status='active' AND type='e_book' ORDER BY id DESC LIMIT 10 "); 
			        }?>
			        
			        <?php if(mysqli_num_rows($books) <= 0){ echo '<h5 class="text-center">No Result For This Search</h5>' ;}
			        ?>
			    
			    
			   <?php if(isset($_GET['search'])){echo '<h4> Search result for ' . $_GET["search"] . ' - '. $search_count .' books found </h4>';}?>
			       
		
			   <?=$status_msg?>
			    
			    <div class="row g-4">
			      
				        <?php while($row = mysqli_fetch_assoc($books)): ?>
				        
                    
                       <!--Detail MOdal-->
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
                                        <span>Read By: </span>
                                        <span>Author: <?=$row['author']?> </span>
                                        <span>Edition: <?=$row['edition']?> </span>
                                    </div>
                                  
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                       <!--Details Modal Ends-->
				        
				     
	
				        
				    <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
			
					    <div class="app-card app-card-doc shadow-sm h-100">
						    <div class="app-card-thumb-holder p-3" data-bs-toggle="modal" data-bs-target="#detailBook<?=$row['id']?>" >
							    <span class="icon-holder">
	                             <img class='w-75' src='../assets/covers/<?=$row["cover"]?>' alt='' />
	                            </span>
	                            
	                              <?php 
                                        $date1 = str_replace('/','-', $row['date']);
                                        $date2 = str_replace('/','-',$current_date);
                                        $diff = abs(strtotime($date2) - strtotime($date1));
                                        $days = $diff/(60*60*24);
	                            ?>
	                            <?php if($days <= 30):?>
	                                <span class="badge bg-success">NEW</span>
	                            <?php endif?>
	                            
	                             <a class="app-card-link-mask"></a></a>
						    </div>
						    <div class="app-card-body p-3 has-card-actions">
							    
							    <h4 class="app-doc-title truncate mb-0"><a><?=ucwords(strtolower($row['title']))?></a></h4>
							    <div class="app-doc-meta">
								    <ul class="list-unstyled mb-0">
									    <li><span class="text-muted">Author:</span> <?=ucwords(strtolower($row['author']))?></li>
									    <li><span class="text-muted">Length:</span> <?=$row['pages']?> Pages</li>
									   <li><span class="text-muted">Published:</span> <?=$row['publish_year']?></li>
								    </ul>
							    </div><!--//app-doc-meta-->
							  
								<div class='d-flex flex-wrap justify-content-center mt-2 gap-2'>
								    <form action='e_book_detail' method='post'>
								        <button class='btn btn-primary text-white p-2' title=view type='submit' name='e_book_id' value="<?=$row['id']?>"> View </button>
								     </form>
								    
								</div>
						    </div><!--//app-card-body-->

						</div><!--//app-card-->
				    </div><!--//col-->
						<?php endwhile?>
			    </div><!--//row-->
			    
			    
			    
			    
			 <!--   <nav class="app-pagination mt-5">-->
				<!--	<ul class="pagination justify-content-center">-->
				<!--		<li class="page-item disabled">-->
				<!--			<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>-->
				<!--	    </li>-->
				<!--		<li class="page-item active"><a class="page-link" href="#">1</a></li>-->
				<!--		<li class="page-item"><a class="page-link" href="#">2</a></li>-->
				<!--		<li class="page-item"><a class="page-link" href="#">3</a></li>-->
				<!--		<li class="page-item">-->
				<!--		    <a class="page-link" href="#">Next</a>-->
				<!--		</li>-->
				<!--	</ul>-->
				<!--</nav><!--//app-pagination-->
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    

	    
	    
	   <?php require_once('footer.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					
<?php require_once('scripts.php') ?>

</body>
</html> 

