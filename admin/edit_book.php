.<!DOCTYPE html>
<?php require_once('include.php') ?>

<html lang="en"> 
<head>
    <title>Edit Books | <?=$app_title?> </title>
    
  <?php require_once('links.php') ?>

</head> 

<body class="app">   
        
	   	<?php require_once('modal.php') ?>  
            <header class="app-header fixed-top">	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>
    </header><!--//app-header-->
     
    <div class="app-wrapper">
	    <?php  require_once('../config/controllers/book.php')?>
        <?php
        if(!empty($_POST['book_id'])){
            $_SESSION['book_id'] = $_POST['book_id'];
            
        }
         $book_id = $_SESSION['book_id'] ;
            $book_query = mysqli_query($conn, "SELECT * FROM books WHERE id='$book_id'");
            $book = mysqli_fetch_assoc($book_query);
            $_SESSION['book_type'] = $book['type'];
        ?>
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			           <a href='edit_books'><h1 class="app-page-title mb-0">Edit <?=ucwords($book['title'] . ' by ' . $book['author'])?></h1></a>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
						


						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
		
			   <?=$status_msg?>
			    
			    <div class="row g-4">
			  
			        <div class='card col-12'>
			          
                            <form action='' method='post' enctype="multipart/form-data">
                     
                               <div class="container">
                                     <h4 class='mt-4 '>Update "<?=$book['title']?>" Details</h4>
                                     
                                        <div class='form-group mb-2 d-lg-flex justify-content-between gap-2'>
                                            <div class='w-50 form-group'>
                                                <label>Book Title</label>
                                                <input class='form-control mb-2' type='text' name='title' required placeholder='Book Title' value="<?=$book['title']?>"/>
                                            </div>
                                            <div class='w-50'>
                                                 <label for='author' >Book Author</label>
                                                 <input class='form-control' type='text' name='author' required placeholder='Book Author' value="<?=$book['author']?>"/>
                                            </div>
                                        </div>
                                        
                                        <div class='form-group  mb-2 d-lg-flex justify-content-between gap-2'>
                                            <div class='w-50'>
                                                <label>Number Of Pages</label>
                                                <input class='form-control' type='number' name='pages' min=1 required placeholder='Number Of Pages' value="<?=$book['pages']?>"/>
                                            </div>
                                            <div class='w-50'>
                                                <label>ISBN Number</label>
                                                <input class='form-control mb-2' type='text' name='isbn' required placeholder='ISBN Number' value="<?=$book['isbn']?>"/>
                                            </div>
                                        </div>
                                        
                                    <?php if($_SESSION['book_type'] == 'hard_copy'):?>
                                        <div class='form-group  mb-2 d-lg-flex justify-content-between gap-2'>
                                            <div class='w-50'>
                                                <label>Number Of Copies</label>
                                                <input class='form-control mb-2' type='number' name='copies' min=1 required placeholder='Number of Copies' value="<?=$book['copies']?>"/>
                                            </div>
                                            <div class='w-50'>
                                                <label>Location</label>
                                                <input class='form-control' type='text' name='location' required placeholder='Location' value="<?=$book['location']?>"/>
                                            </div>
                                        </div>
                                    <?php endif?>
                                        <div class='form-group  mb-2 d-lg-flex justify-content-between gap-2'>
                                            <div class='w-50'>
                                                <label>Genre</label>
                                                <?php $genre_list = ['Action','Art/architecture','history','autobiography','anthology', 'biography','chick','business/economics','children','crafts/hobbies','classic', 'Cookbook', 'Comic', 'Diary', 'Coming-of-age', 'Dictionary', 'Crime', 'Education', 'Encyclopedia', 'Drama', 'Guide', 'Fairytale', 'Health/fitness', 'Fantasy', 'History', 'Home/garden', 'Historical_fiction', 'Humor', 'Horror', 'Journal', 'Mystery', 'Math', 'Paranormal_romance', 'Memoir', 'Picture_book', 'Philosophy', 'Poetry', 'Prayer', 'Political thriller', 'Religion', 'spirituality', 'Romance', 'Textbook', 'Satire', 'True_crime', 'Science_fiction', 'Review', 'Short_story', 'Science', 'Suspense', 'Self_help', 'Thriller', 'Sports/leisure', 'Western', 'Travel', 'Young adult', 'True_crime'];?>
                                                <select required name='genre' class='form-control'>
                                                    <option>--- SELECT GENRE ----</option>
                                                    <?php for($i=0; $i < count($genre_list); $i++): ?>
                                                    
                                                    <option value=<?php echo str_replace(" ","_", strtolower($genre_list[$i]))?>  <?=$sel_genre = str_replace(" ","_", strtolower($genre_list[$i])) == $book['category']?'selected': ''?>>
                                                        <?=str_replace("_"," ", ucfirst($genre_list[$i]))?>
                                                    </option>
                                                    <?php endfor?>
                                                </select>
                                            </div>
                                            <div class='w-50'>
                                                <label>Book Language</label>
                                                <input class='form-control' type='text' name='language' required placeholder='Book Language' value="<?=$book['language']?>"/>
                                            </div>
                                        </div>
                                        
                                      
                                    
                                        <div class='form-group mb-2 d-lg-flex justify-content-between gap-2'>
                                            <div class='w-50'>
                                                <label>Publish Year</label>
                                                <input class='form-control' type='number' name='publish_year' required placeholder='Publish Year' value="<?=$book['publish_year']?>"/>
                                            </div>
                                            
                                        <?php if($_SESSION['book_type'] == 'hard_copy'):?>
                                            <?php $sub_query = mysqli_query($conn, "SELECT * FROM subscription_plans") ?>
                                            <?php if(mysqli_num_rows($sub_query) > 0):?>
                                            <div class='w-50'>
                                                <label>Subscription Plan</label>
                                                <select class='form-control' name='subscription'>
                                                    <option>-- Select Subscription Plan ---</option>
                                                    <?php while($row = mysqli_fetch_assoc($sub_query)):?>
                                                    <option value='<?=$row["id"]?>' <?=$sel_sub = $book['subscription'] == $row["id"]?'selected': ''?> >
                                                        <?=$row["name"]?>
                                                    </option>
                                                    <?php endwhile?>
                                                </select>
                                            </div>
                                            <?php endif?>
                                        <?php else: ?>
                                            <div class='w-50'>
                                                <label>Price: Type 0 if book is free</label>
                                                <input class='form-control' type='number' name='price' required placeholder='Price: Type 0 if book is free' value="<?=$book['price']?>"/>
                                            </div>
                                        <?php endif ?>
                                            
                                        </div>
                                 
                                    
                                <?php if($_SESSION['book_type'] == 'hard_copy'):?>
                                    <!--<label for='cover mb-0 mt-1'>Book Cover</label>-->
                                <?php endif?>
                                    <div class='form-group  mb-2 d-lg-flex justify-content-between gap-2'>
                                        <!--<div class='w-50'>-->
                                            <!--<label>Book Cover</label>-->
                                            <?php //if($_SESSION['book_type'] == 'hard_copy'):?>
                                                <!--<input class='form-control mb-2' type='file' name='cover' required placeholder='Book Cover' value="<?=$book['cover']?>"/>-->
                                            <?php //endif;?>
                                        <!--</div>-->
                                        <div class='w-50'>
                                            <label>Book Edition</label>
                                                <input class='form-control mb-2' type='text' name='edition' required placeholder='Book Edition' value="<?=$book['edition']?>"/>
                                        </div>
                                    </div>
                                
                                        <div class='form-group  mb-2'>
                                            <Label>Book Description</Label>
                                            <textarea class='form-control' name='description' required placeholder='Book Description' style='min-height:100px'><?=$book['description']?></textarea>
                                        </div>
                                  
                                <!--<div class='form-group mb-2 mt-2'>-->
                                    <?php //$get_team_query = mysqli_query($conn, "SELECT * FROM teams");?>
                                    <!--<h5>Assign To Location</h5>-->
                                   <!--<div class=''>-->
                                        <?php //while($teams = mysqli_fetch_assoc($get_team_query)): ?>
                                        <!--<div class="form-check form-check-inline">-->
                                        <!--  <input -->
                                        <!--  class="form-check-input" -->
                                        <!--  name="staff_team[]" -->
                                        <!--  type="checkbox" -->
                                        <!--  value="<?php //$teams['team_id']?>" -->
                                        <!--  id="flexCheckDefault<?php //$teams['id']?> "-->
                                        <!--  <?php //$sel_team = $teams['team_id'] == $book['team']?'checked':''?>-->
                                        <!--  >-->
                                          <!--<label class="form-check-label" for="flexCheckDefault<?php //$teams['id']?>">-->
                                          <!--  <?php //$teams['name']?>-->
                                          <!--</label>-->
                                        </div>
                                        <?php //endwhile;?>
                                   <!--</div>-->
                                <!--</div>-->
                                   </div>
                                  <div class="modal-footer mb-2 mb-2">
                                      <input hidden name='book_id' value=<?=$book['id']?>/>
                                    <button type="submit" name='update_book' class="btn btn-primary text-white">Save</button>
                                  </div>
                            </form>
		</div>
			    </div><!--//row-->
			    
			    
			    
			    
	
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    

	    
	    
	   <?php require_once('footer.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->   
    <script>
      $(document).ready(function() {
            $('#selectpicker').bsMultiSelect({
                useCssPatch:true,
        valueMissingMessage:'Select A Location'
        
            }); 
        });

    
        let book_type = document.getElementById('book_type');
        let file = document.getElementById('file');
        let link = document.getElementById('link');
        
        book_type.addEventListener('change', function() {
        if(book_type.value == 'link'){
            link.style.display = 'block';
            link.required = true;
            file.style.display = 'none';
            file.required = false;
        }else if(book_type.value == 'file'){
            file.style.display = 'block';
             file.required = true;
            link.style.display = 'none';
             link.required = false;
        }
        })
    </script>
<?php require_once('scripts.php') ?>

</body>
</html> 

