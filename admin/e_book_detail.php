<!DOCTYPE html>
<?php require_once('include.php')?>


<html lang="en"> 
<head>
    <title> <?=ucfirst(strtolower($e_book['title']))?> | <?=$app_title?></title>
    
    <!-- Meta -->
    
  <?php require_once('links.php') ?>

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>

    </header><!--//app-header-->
    <?php  require_once('../config/controllers/book.php')?>
    
    <?php 
        if(isset($_POST['e_book_id'])){
            $_SESSION['e_book_id'] = $_POST['e_book_id'];
        }
         $e_book_id =  $_SESSION['e_book_id'] ;

        $e_book_query = mysqli_query($conn, "SELECT * FROM books WHERE type='e_book' AND status='active' AND id='$e_book_id' LIMIT 1");
        
        $e_book = mysqli_fetch_assoc($e_book_query);
?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 ">
				    <div class="col-auto d-flex justify-content-between w-100">
			            <h1 class="app-page-title mb-0"><a href='e-books'><i class="bi bi-arrow-left text-primary pe-2"></i></a><?=ucfirst(strtolower($e_book['title']))?></h1>
			            <div> 
    					<form action='edit_book' method='post' style='display:inline-block'>
			                <button name='book_id' value='<?=$e_book["id"]?>' class='btn btn-info text-white ' title=edit><i class="fas fa-pencil-alt" ></i> Edit</button>
                        </form>					
    						<button  class='btn btn-danger text-white' title=archive data-bs-toggle="modal" data-bs-target="#archiveBook<?=$e_book['id']?>"> <i class="fa-solid fa-box-archive"></i> Archive</button>
					</div>
				    </div>
				    
				</div><!--//col-auto-->
			    </div><!--//row-->
			    <?=$status_msg?>
				     <!-- Archive Book Modal -->
                           
                            <div class="modal fade" id="archiveBook<?=$e_book['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?=$e_book['title']?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                 <form action='e-books' method='post'>
                                  <div class="modal-body">
                                   <div class='form-group'>
                                       <textarea class='form-control mb-2' name='reason' placeholder='Why are you archiving this book?' style='min-height:100px' required></textarea>
                                   </div>
                                    <input hidden name='book_id' value='<?=$e_book['id']?>' />
                                  <input hidden name='title' value='<?=$e_book['title']?>' />
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
			    <!--Edit Book Modal -->
                        <div class="modal fade" id="editBook<?=$e_book['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?=$e_book['title']?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action='' method='post'>
                          <div class="modal-body">
                                <div class='form-group mt-2'>
                                    <label for='title'>Book Title</label>
                                    <input class='form-control' type='text' name='title' required placeholder='Book Title' value='<?=$e_book['title']?>'/>
                                </div>
                                <div class='form-group  mt-2'>
                                    <label for='title'>Book Author</label>
                                    <input class='form-control' type='text' name='author' required placeholder='Book Author' value='<?=$e_book['author']?>'/>
                                </div>
                                <div class='form-group  mt-2'>
                                    <label for='title'>Number Of Pages</label>
                                    <input class='form-control' type='number' name='pages' min=1 required placeholder='Number Of Pages' value='<?=$e_book['pages']?>'/>
                                </div>
                                
                                <div class='form-group  mt-2'>
                                    <label for='title'>ISBN Number</label>
                                    <input class='form-control' type='text' name='isbn' required placeholder='ISBN Number' value='<?=$e_book['isbn']?>'/>
                                </div>
                                <div class='form-group  mt-2'>
                                    <label for='title'>Genre</label>
                                    <?php $genre = ['Action','Art/architecture','history','autobiography','anthology', 'biography','chick','business/economics','children','crafts/hobbies','classic', 'Cookbook', 'Comic', 'Diary', 'Coming-of-age', 'Dictionary', 'Crime', 'Education', 'Encyclopedia', 'Drama', 'Guide', 'Fairytale', 'Health/fitness', 'Fantasy', 'History', 'Home/garden', 'Historical_fiction', 'Humor', 'Horror', 'Journal', 'Mystery', 'Math', 'Paranormal_romance', 'Memoir', 'Picture_book', 'Philosophy', 'Poetry', 'Prayer', 'Political thriller', 'Religion', 'spirituality', 'Romance', 'Textbook', 'Satire', 'True_crime', 'Science_fiction', 'Review', 'Short_story', 'Science', 'Suspense', 'Self_help', 'Thriller', 'Sports/leisure', 'Western', 'Travel', 'Young adult', 'True_crime'];?>
                                    <select required name='genre' class='form-control'>
                                        <option>--- SELECT GENRE ----</option>
                                        <?php for($i=0; $i < count($genre); $i++): ?>
                                        
                                        <option <?=$select = str_replace(" ","_",strtolower($genre[$i])) == $e_book['category'] ? 'selected':'' ?> value='<?=strtolower($genre[$i])?>'>
                                            <?=str_replace("_"," ", ucfirst($genre[$i]))?>
                                        </option>
                                        <?php endfor?>
                                    </select>
                                </div>
                                <div class='form-group  mt-2'>
                                    <label for='title'>Price</label>
                                    <input class='form-control' type='text' name='price' required placeholder='Price' value='<?=$e_book['price']?>'/>
                                </div>
                                <div class='form-group  mt-2'>
                                    <label for='price'>Price</label>
                                    <input class='form-control' type='text' name='price' required placeholder='ISBN Number' value='<?=$e_book['price']?>'/>
                                </div>
                                <div class='form-group  mt-2'>
                                    <label for='description'>Description</label>
                                    <input class='form-control' type='text' name='description' required placeholder='Description' value='<?=$e_book['description']?>'/>
                                </div>
                                <input hidden name='book_id' value='<?=$e_book['id']?>'/>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name='update_book'  class="btn btn-primary text-white">Save</button>
                          </div>
                          </form>
                        </div>
                        </div>
                        </div>
                
				             <!--Edit Book Modal Ends -->
	
			    
			    
			    
			    
			    
			    	<div class="tab-content  d-flex justify-content-center" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5 w-100">
						    <div class="app-card-body w-100 p-4">
						        
						        
                            <div class="card mb-3" style="max-width: 540px;">
                              <div class="row g-0">
                                <div class="col-md-4">
                                  <img class='border border-secondary rounded p-2 w-100 mb-2' src='../assets/covers/<?=$e_book['cover']?>' alt='Book Cover'/>
                                  <center>
                                  <form action='open_file' method='post' target='_blank'>
						                <button class='btn btn-secondary mb-2' name='file' value='<?=$e_book['file']?>'><i class="bi bi-book-fill me-2"></i>Read Online</button>
						          </form>
						           <a href="../assets/books/<?=$e_book['file']?>" download="<?=$e_book['title']?>"> <button class='btn btn-secondary mb-2'><i class="bi bi-download me-2"></i> Download Book</button></a>

                                </center>
                                </div>
                                <div class="col-md-8">
                                  <div class="card-body">
                                    <h5 class="card-title"><?=ucfirst(strtolower($e_book['title']))?></h5>
                                    <p class="card-text"><small class="text-muted"><?=ucfirst(strtolower($e_book['author']))?></small></p>
                                    <p class="card-text"><?=$e_book['description']?></p>
                                  </div>
                                </div>
                              </div>
                            </div>
						        
						       
						    </div>
						    
						</div
					
						
			        </div>
		    </div>
	    </div>
			    
		    
	    </div><!--//app-content-->
	    
<?php require_once('footer.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>
</body>
</html> 

