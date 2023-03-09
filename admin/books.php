<!DOCTYPE html>
<?php require_once('include.php') ?>
<html lang="en"> 
<head>
    <title>Books | <?=$app_title?> </title>
    
  <?php require_once('links.php') ?>

</head> 

<body class="app">   	
	   	<?php require_once('modal.php') ?>  
            <header class="app-header fixed-top">	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>
    </header><!--//app-header-->
     <?php  require_once('../config/controllers/book.php')?>
     <?php  require_once('../config/functions/query_functions.php')?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			           <a href='books'><h1 class="app-page-title mb-0">Books</h1></a>
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
  <a class="btn app-btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> Add Book
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
			            
			            
			            $generated_search_query = gen_mul_team_query("SELECT * FROM books WHERE (title LIKE '%$search_key%'  OR author LIKE '%$search_key%') AND status='active' AND type='hard_copy'",  $active_team_array);
			            
			            $books = mysqli_query($conn, $generated_search_query." ORDER BY id DESC");
			            $search_count = mysqli_num_rows($books);
			        }else{
			            
			            $generated_query = gen_mul_team_query("SELECT * FROM books WHERE status='active' AND type='hard_copy'",  $active_team_array);
			       
			            $books = mysqli_query($conn, $generated_query." ORDER BY id DESC LIMIT 10 "); 
			        }?>
			    
			    
			   <?php if(isset($_GET['search'])){echo '<h4> Search result for ' . $_GET["search"] .' - '. $search_count .' books found </h4>';}?>
			       
		
			   <?=$status_msg?>
			    
			    <div class="row g-4">
			       
			        
			        <?php if(mysqli_num_rows($books) <= 0){ echo '<h5 class="text-center">No Result For This Search</h5>' ;}
			        ?>
				        <?php while($row = mysqli_fetch_assoc($books)): ?>
				        
				        <!-- Archive Book Modal -->
                           
                            <div class="modal fade" id="archiveBook<?=$row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?=$row['title']?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                 <form action='' method='post'>
                                  <div class="modal-body">
                                 <textarea class='form-control mb-2' name='reason' placeholder='Why are you archiving this book' required style='min-height:100px'></textarea>

                                    <input hidden name='book_id' value='<?=$row['id']?>' />
                                  <input hidden name='title' value='<?=$row['title']?>' />
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name='archive_book' class="btn btn-danger text-white">Archive</button>
                                  </div>
                                 </form>
                                </div>
                              </div>
                            </div>
                        <!--Archive modal ends -->
                        
                       <!--Detail Modal-->
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
				        
				      <!--Edit Book Modal -->
                        <div class="modal fade" id="editBook<?=$row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?=$row['title']?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action='' method='post'>
                          <div class="modal-body">
                                <div class='form-group mt-2'>
                                    <label for='title'>Book Title</label>
                                    <input class='form-control' type='text' name='title' required value='<?=$row['title']?>'/>
                                </div>
                                <div class='form-group  mt-2'>
                                    <label for='author'>Book Author</label>
                                    <input class='form-control' type='text' name='author' required value='<?=$row['author']?>'/>
                                </div>
                                <div class='form-group  mt-2'>
                                    <label for='pages'>Number Of Pages</label>
                                    <input class='form-control' type='number' name='pages' min=1 required value='<?=$row['pages']?>'/>
                                </div>
                                <div class='form-group  mt-2'>
                                    <label for='copies'>Number of Copies</label>
                                    <input class='form-control' type='number' name='copies' min=1 required value='<?=$row['copies']?>'/>
                                </div>
                                <div class='form-group  mt-2'>
                                    <label for='isbn'>ISBN Number</label>
                                    <input class='form-control' type='text' name='isbn' required placeholder='' value='<?=$row['isbn']?>'/>
                                </div>
                                <div class='form-group  mt-2'>
                                    <?php $genre = ['Action','Art/architecture','history','autobiography','anthology', 'biography','chick','business/economics','children','crafts/hobbies','classic', 'Cookbook', 'Comic', 'Diary', 'Coming-of-age', 'Dictionary', 'Crime', 'Education', 'Encyclopedia', 'Drama', 'Guide', 'Fairytale', 'Health/fitness', 'Fantasy', 'History', 'Home/garden', 'Historical_fiction', 'Humor', 'Horror', 'Journal', 'Mystery', 'Math', 'Paranormal_romance', 'Memoir', 'Picture_book', 'Philosophy', 'Poetry', 'Prayer', 'Political thriller', 'Religion', 'spirituality', 'Romance', 'Textbook', 'Satire', 'True_crime', 'Science_fiction', 'Review', 'Short_story', 'Science', 'Suspense', 'Self_help', 'Thriller', 'Sports/leisure', 'Western', 'Travel', 'Young adult', 'True_crime'];?>
                                    <label for='genre'>SELECT GENRE </label>
                                    <select required name='genre' class='form-control'>
                                        <option>--- SELECT GENRE ----</option>
                                        <?php for($i=0; $i < count($genre); $i++): ?>
                                        
                                        <option <?=$select = str_replace(" ","_",strtolower($genre[$i])) == $row['category'] ? 'selected':'' ?> value='<?=strtolower($genre[$i])?>'>
                                            <?=str_replace("_"," ", ucfirst($genre[$i]))?>
                                        </option>
                                        <?php endfor?>
                                    </select>
                                </div>
                                <input hidden name='book_id' value='<?=$row['id']?>'/>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name='update_book'  class="btn btn-primary text-white">Save</button>
                          </div>
                          </form>
                        </div>
                        </div>
                        </div>
                
				             <!--Edit Book Modal Ends -->
	
				        
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
	                             <a class="app-card-link-mask"></a>
						    </div>
						    <div class="app-card-body p-3 has-card-actions">
							    
							    <h4 class="app-doc-title truncate mb-0"><a href="#file-link"><?=ucwords(strtolower($row['title']))?></a></h4>
							    <div class="app-doc-meta">
								    <ul class="list-unstyled mb-0">
									    <li><span class="text-muted">Author:</span> <?=ucwords(strtolower($row['author']))?></li>
									    <li><span class="text-muted">Length:</span> <?=$row['pages']?> Pages</li>
									    <li><span class="text-muted">Available:</span> <?=$row['copies']?> copies</li>
									    <li><span class="text-muted">Location:</span> <?=$row['location']?></li>
								    </ul>
							    </div><!--//app-doc-meta-->
							 
								<div class='d-flex flex-wrap justify-content-center mt-2 gap-2'>
								<form action='book_detail' method='post'>
								    <button class='btn btn-primary text-white' name='book_id' value='<?=$row['id']?>' title=view> View </button>
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

