<!DOCTYPE html>
<?php require_once('include.php') ?>
<html lang="en"> 
<head>
    <title>Books - <?=$app_title?> </title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="../assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="../assets/css/portal.css">

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
            <header class="app-header fixed-top">	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>
    </header>
    </header><!--//app-header-->
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Books</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    <form class="docs-search-form row gx-1 align-items-center">
					                    <div class="col-auto">
					                        <input type="text" id="search-docs" name="searchdocs" class="form-control search-docs" placeholder="Search">
					                    </div>
					                    <div class="col-auto">
					                        <button type="submit" class="btn app-btn-secondary">Search</button>
					                    </div>
					                </form>
					                
							    </div><!--//col-->
							    <div class="col-auto">
								    
								    <select class="form-select w-auto">
										  <option selected="" value="option-1">All</option>
										  <option value="option-2">Text file</option>
										  <option value="option-3">Image</option>
										  <option value="option-4">Spreadsheet</option>
										  <option value="option-5">Presentation</option>
										  <option value="option-6">Zip file</option>
										  
									</select>
							    </div>
							    <div class="col-auto">
								    <a class="btn app-btn-primary" href="#"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upload me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
  <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
</svg>Upload File</a>
							    </div>
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			    
			    
			    <div class="row g-4">
			       <?php $books = mysqli_query($conn, "SELECT * FROM books ORDER BY id DESC LIMIT 10 "); ?>
				        <?php while($row = mysqli_fetch_assoc($books)): ?>
				      <!--Edit Book Modal -->
                     <div class="modal fade" id="editBook<?=$row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action='' method='post'>
      <div class="modal-body">
            <div class='form-group mt-2'>
                <input class='form-control' type='text' name='title' required placeholder='Book Title'/>
            </div>
            <div class='form-group  mt-2'>
                <input class='form-control' type='text' name='author' required placeholder='Book Author'/>
            </div>
            <div class='form-group  mt-2'>
                <input class='form-control' type='number' name='pages' required placeholder='Number Of Pages'/>
            </div>
            <div class='form-group  mt-2'>
                <input class='form-control' type='number' name='copies' required placeholder='Number of Copies'/>
            </div>
            <div class='form-group  mt-2'>
                <input class='form-control' type='text' name='isbn' required placeholder='ISBN Number'/>
            </div>
            <div class='form-group  mt-2'>
                <?php $genre = ['Action','Art/architecture','history','autobiography','anthology', 'biography','chick','business/economics','children','crafts/hobbies','classic', 'Cookbook', 'Comic', 'Diary', 'Coming-of-age', 'Dictionary', 'Crime', 'Education', 'Encyclopedia', 'Drama', 'Guide', 'Fairytale', 'Health/fitness', 'Fantasy', 'History', 'Home/garden', 'Historical_fiction', 'Humor', 'Horror', 'Journal', 'Mystery', 'Math', 'Paranormal_romance', 'Memoir', 'Picture_book', 'Philosophy', 'Poetry', 'Prayer', 'Political thriller', 'Religion', 'spirituality', 'Romance', 'Textbook', 'Satire', 'True_crime', 'Science_fiction', 'Review', 'Short_story', 'Science', 'Suspense', 'Self_help', 'Thriller', 'Sports/leisure', 'Western', 'Travel', 'Young adult', 'True_crime'];?>
                <select required name='genre' class='form-control'>
                    <option>--- SELECT GENRE ----</option>
                    <?php for($i=0; $i < count($genre); $i++): ?>
                    
                    <option value='<?strtolower($genre[$i])?>'>
                        <?=str_replace("_"," ", ucfirst($genre[$i]))?>
                    </option>
                    <?php endfor?>
                </select>
            </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name='add_book' class="btn btn-primary text-white">Save</button>
      </div>
        </form>
    </div>
  </div>
</div>
				             <!--Edit Book Modal Ends -->
				        
				    <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
			
					    <div class="app-card app-card-doc shadow-sm h-100">
						    <div class="app-card-thumb-holder p-3">
							    <span class="icon-holder">
	                             <i class="fas fa-book"></i>
	                            </span>
	                            <span class="badge bg-success">NEW</span>
	                             <a class="app-card-link-mask" href="#file-link"></a>
						    </div>
						    <div class="app-card-body p-3 has-card-actions">
							    
							    <h4 class="app-doc-title truncate mb-0"><a href="#file-link"><?=$row['title']?></a></h4>
							    <div class="app-doc-meta">
								    <ul class="list-unstyled mb-0">
									    <li><span class="text-muted">Author:</span> <?=$row['author']?></li>
									    <li><span class="text-muted">Length:</span> <?=$row['pages']?> Pages</li>
									    <li><span class="text-muted">Available:</span> <?=$row['copies']?> copies</li>
								    </ul>
							    </div><!--//app-doc-meta-->
							    
							    <div class="app-card-actions">
								    <div class="dropdown">
									    <div class="dropdown-toggle no-toggle-arrow" data-bs-toggle="dropdown" aria-expanded="false">
										    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			  <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
			</svg>
		
									    </div><!--//dropdown-toggle-->
									    <ul class="dropdown-menu">
                                            <li class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#editBook<?=$row['id']?>"><a class="dropdown-item" ><i class="fas fa-eye me-2"></i>View</a></li>
                                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#viewBook<?=$row['id']?>"><i class="fas fa-pencil-alt me-2" ></i>Edit</a></li>
                                           
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item"><i class="fas fa-trash-alt me-2" data-bs-toggle="modal" data-bs-target="#deleteBook<?=$row['id']?>"></i>Delete</a></li>
										</ul>
								    </div><!--//dropdown-->
						        </div><!--//app-card-actions-->
								
						    </div><!--//app-card-body-->

						</div><!--//app-card-->
				    </div><!--//col-->
						<?php endwhile?>
			    </div><!--//row-->
			    
			    
			    
			    
			    <nav class="app-pagination mt-5">
					<ul class="pagination justify-content-center">
						<li class="page-item disabled">
							<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
					    </li>
						<li class="page-item active"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item">
						    <a class="page-link" href="#">Next</a>
						</li>
					</ul>
				</nav><!--//app-pagination-->
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
	   <?php require_once('footer.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

 
<?php require_once('scripts.php') ?>

</body>
</html> 

