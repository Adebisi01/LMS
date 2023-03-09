<!DOCTYPE html>
<?php require_once('include.php')?>
<?php  require_once('../config/controllers/borrow_book.php')?>

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
			            <h1 class="app-page-title mb-0"><a href='books'><i class="bi bi-arrow-left text-primary pe-2"></i></a> <?=ucfirst(strtolower($book['title']))?></h1>
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
			    
			    <?=$status_msg?>
			    
			      <!--Borrow Book Modal -->
                        <div class="modal fade" id="borrowBook<?=$book['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Request for <?=$book['title']?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action='' method='post'>
                          <div class="modal-body">
                                <div class='form-group mb-2'>
                                    <label for='return_date'>Expected Return Date</label>
                                    <input class='form-control' type='date' name='return_date' required />
                                </div>
                              <h5 class='text-danger'>If you dont return this book on or before the expected date, You will be fined</h5>
                              <input hidden name='book_id' value='<?=$book['id']?>'/>
                              <input hidden name='author' value='<?=$book['author']?>'/>
                              <input hidden name='title' value='<?=$book['title']?>'/>
                              <input hidden name='book_sub' value='<?=$book['subscription']?>'/>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name='borrow_book'  class="btn btn-primary text-white">Request</button>
                          </div>
                          </form>
                        </div>
                        </div>
                        </div>
				    <!--Borrow Book Modal Ends -->
				    <!--Pre Request  Modal -->
                        <div class="modal fade" id="preRequestBook<?=$book['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pre Request for <?=$book['title']?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action='' method='post'>
                          <div class="modal-body">
                                <div class='form-group mb-2'>
                                    <label for='return_date'>If you got the book today when would you return it?</label>
                                    <input class='form-control' type='date' name='return_date' required />
                                </div>
                              <h5 class='text-danger'>If you dont return this book on or before the expected date, You will be fined</h5>
                              <input hidden name='book_id' value='<?=$book['id']?>'/>
                              <input hidden name='author' value='<?=$book['author']?>'/>
                              <input hidden name='title' value='<?=$book['title']?>'/>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name='pre_request'  class="btn btn-primary text-white">Request</button>
                          </div>
                          </form>
                        </div>
                        </div>
                        </div>
				    <!--Pre Request Modal Ends -->
			    
			    
			    
			    
			    
			    
			    
			    	<div class="tab-content  d-flex justify-content-center" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5 w-100">
						    <div class="app-card-body w-100 p-4">
						        
						        
                            <div class="card mb-3" style="max-width: 540px;">
                              <div class="row g-0">
                                <div class="col-md-4">
                                  <img class='border border-secondary rounded p-2 w-100 mb-2' src='../assets/covers/<?=$book["cover"]?>' alt='Book Cover'/>
                                  <center>
						        
						              <!--action buttons--> 
						          <div class='d-flex flex-wrap justify-content-center mt-2 gap-2'>
								    <?php if($book['available'] <= 0): ?>
    								    <button class='btn btn-info text-white p-2' title=Pre-request data-bs-toggle="modal" data-bs-target="#preRequestBook<?=$book['id']?>">Pre-request</button>
								     <?php else:?>
								        <button class='btn btn-info text-white p-2' title=borrow data-bs-toggle="modal" data-bs-target="#borrowBook<?=$book['id']?>">Borrow</button>
								     <?php endif ?>
								    <form action='rating' method='post'>
								        <button class='btn btn-danger text-white p-2' title='Rate and Review' name='book_id' value='<?=$book['id']?>'>Review</button>
								    </form>
								    </div>
								
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
		    </div>
	    </div>
			    
	    </div><!--//app-content-->
	    
<?php require_once('footer.php') ?><!--//app-footer-->
<?php require_once('modal.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>


</body>
</html> 

