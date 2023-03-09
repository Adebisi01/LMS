<!DOCTYPE html>
<?php require_once('include.php')?>
<?php  require_once('../config/controllers/book.php')?>

<?php 
        if(isset($_POST['book_id'])){
            $_SESSION['book_id'] = $_POST['book_id'];
        }
         $book_id =  $_SESSION['book_id'] ;

        $book_query = mysqli_query($conn, "SELECT * FROM books WHERE type='hard_copy' AND status='active' AND id='$book_id' LIMIT 1");
        
        $book = mysqli_fetch_assoc($book_query);
?>
<html lang="en"> 
<head>
    <title> <?=ucfirst(strtolower($book['title']))?> | <?=$app_title?></title>
    <!-- Meta -->
    
  <?php require_once('links.php') ?>

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>

    </header><!--//app-header-->

    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0"><a href='books'><i class="bi bi-arrow-left text-primary pe-2"></i></a><?=ucfirst(strtolower($book['title']))?></h1>
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
			    
			    <!-- Archive Book Modal -->
			             
                           <?=$status_msg?>
                            <div class="modal fade" id="archiveBook<?=$book['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?=$book['title']?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                 <form action='books' method='post'>
                                  <div class="modal-body">
                                 <textarea class='form-control mb-2' name='reason' placeholder='Why are you archiving this book' required style='min-height:100px'></textarea>

                                    <input hidden name='book_id' value='<?=$book['id']?>' />
                                  <input hidden name='title' value='<?=$book['title']?>' />
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
                        <div class="modal fade" id="editBook<?=$book['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?=$book['title']?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action='' method='post'>
                          <div class="modal-body">
                                <div class='form-group mt-2'>
                                    <label for='title'>Book Title</label>
                                    <input class='form-control' type='text' name='title' required value='<?=$book['title']?>'/>
                                </div>
                                <div class='form-group  mt-2'>
                                    <label for='author'>Book Author</label>
                                    <input class='form-control' type='text' name='author' required value='<?=$book['author']?>'/>
                                </div>
                                <div class='form-group  mt-2'>
                                    <label for='pages'>Number Of Pages</label>
                                    <input class='form-control' type='number' name='pages' min=1 required value='<?=$book['pages']?>'/>
                                </div>
                                <div class='form-group  mt-2'>
                                    <label for='copies'>Number of Copies</label>
                                    <input class='form-control' type='number' name='copies' min=1 required value='<?=$book['copies']?>'/>
                                </div>
                                <div class='form-group  mt-2'>
                                    <label for='isbn'>ISBN Number</label>
                                    <input class='form-control' type='text' name='isbn' required placeholder='' value='<?=$book['isbn']?>'/>
                                </div>
                                <div class='form-group  mt-2'>
                                    <?php $genre = ['Action','Art/architecture','history','autobiography','anthology', 'biography','chick','business/economics','children','crafts/hobbies','classic', 'Cookbook', 'Comic', 'Diary', 'Coming-of-age', 'Dictionary', 'Crime', 'Education', 'Encyclopedia', 'Drama', 'Guide', 'Fairytale', 'Health/fitness', 'Fantasy', 'History', 'Home/garden', 'Historical_fiction', 'Humor', 'Horror', 'Journal', 'Mystery', 'Math', 'Paranormal_romance', 'Memoir', 'Picture_book', 'Philosophy', 'Poetry', 'Prayer', 'Political thriller', 'Religion', 'spirituality', 'Romance', 'Textbook', 'Satire', 'True_crime', 'Science_fiction', 'Review', 'Short_story', 'Science', 'Suspense', 'Self_help', 'Thriller', 'Sports/leisure', 'Western', 'Travel', 'Young adult', 'True_crime'];?>
                                    <label for='genre'>SELECT GENRE </label>
                                    <select required name='genre' class='form-control'>
                                        <option>--- SELECT GENRE ----</option>
                                        <?php for($i=0; $i < count($genre); $i++): ?>
                                        
                                        <option <?=$select = str_replace(" ","_",strtolower($genre[$i])) == $book['category'] ? 'selected':'' ?> value='<?=strtolower($genre[$i])?>'>
                                            <?=str_replace("_"," ", ucfirst($genre[$i]))?>
                                        </option>
                                        <?php endfor?>
                                    </select>
                                </div>
                                <input hidden name='book_id' value='<?=$book['id']?>'/>
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
			    
				<div class="tab-content  d-flex justify-content-center" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5 w-100">
						    <div class="app-card-body w-100 p-4">
						        
						        
                            <div class="card mb-3" style="max-width: 540px;">
                              <div class="row g-0">
                                <div class="col-md-4">
                                  <img class=' p-2 w-100 mb-2' src='../assets/covers/<?=$book['cover']?>' alt='Book Cover'/>
                                  <center>
                                <form  action='edit_book' method='post' style='display: inline-block'>
                                  <button name='book_id' value='<?=$book['id']?>' class='btn btn-info text-white p-2 mb-2' title=edit >Edit</button>
                                </form>
								    <button class='btn btn-danger text-white p-2 mb-2' title=archive data-bs-toggle="modal" data-bs-target="#archiveBook<?=$book['id']?>"> Archive</button>
                                </center>
                                </div>
                                <div class="col-md-8">
                                  <div class="card-body">
                                    <h5 class="card-title"><?=ucfirst(strtolower($book['title']))?></h5>
                                    <p class="card-text"><small class="text-muted"><?=ucfirst(strtolower($book['author']))?></small></p>
                                    <p class="card-text"><?=$book['description']?></p>
                                  </div>
                                </div>
                              </div>
                            </div>
						        
						       
						    </div>
						    
						</div
					
						
			        </div>
			        <!--Active Users-->
		    </div>
	    </div>
	    
<?php require_once('footer.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>
</body>
</html> 

