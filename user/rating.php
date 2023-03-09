<!DOCTYPE html>
<?php require_once('include.php')?>

<?php 
        if(isset($_POST['book_id'])){
            $_SESSION['book_id'] = $_POST['book_id'];
        }
         $book_id =  $_SESSION['book_id'] ;

        $book_query = mysqli_query($conn, "SELECT * FROM books WHERE status='active' AND id='$book_id' LIMIT 1");
        
        $book = mysqli_fetch_assoc($book_query);
?>

<html lang="en"> 
<head>
    <title>Rating | <?=$app_title?></title>
    
    <!-- Meta -->
    
  <?php require_once('links.php') ?>

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
 	
        <?php require_once('navbar.php') ?>
        
        <?php require_once('sidebar.php') ?>

    </header><!--//app-header-->
    <?php require_once('../config/controllers/members.php') ?>
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Rating</h1>
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
			    
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">

							    <div class="table-responsive p-2">
							    <div class="container">
                                	<h3 class="mt-2 mb-2"><?=$book['title']?></h3>
                                	<div class="card">
                                		<div class="card-header">Book Rating</div>
                                		<div class="card-body">
                                			<div class="row">
                                				<div class="col-sm-4 text-center">
                                					<h1 class="text-warning mt-4 mb-4">
                                						<b><span id="average_rating">0.0</span> / 5</b>
                                					</h1>
                                					<div class="mb-3">
                                						<i class="fas fa-star star-light mr-1 main_star"></i>
                                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                            	    				</div>
                                					<h3><span id="total_review">0</span> Review</h3>
                                				</div>
                                				<div class="col-sm-4">
                                					<p>
                                                        <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>
                            
                                                        <div class="progress-label-right">(<span id="total_five_star_review">10</span>)</div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="3" aria-valuemin="3" aria-valuemax="100" id="five_star_progress"></div>
                                                        </div>
                                                    </p>
                                					<p>
                                                        <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                                                        
                                                        <div class="progress-label-right">(<span id="total_four_star_review">5</span>)</div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                                                        </div>               
                                                    </p>
                                					<p>
                                                        <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                                                        
                                                        <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                                                        </div>               
                                                    </p>
                                					<p>
                                                        <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                                                        
                                                        <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                                                        </div>               
                                                    </p>
                                					<p>
                                                        <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                                                        
                                                        <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                                                        </div>               
                                                    </p>
                                				</div>
                                				<div class="col-sm-4 text-center">
                                					<h3 class="mt-4 mb-3">Rate and Review</h3>
                                					<button type="button" name="add_review" id="add_review" class="btn btn-primary text-white">Rate and Review</button>
                                				</div>
                                			</div>
                                		</div>
                                	</div>
                                	<div class="mt-5" id="review_content"></div>
                                </div>
                            <?php 
                            $book_com_query = mysqli_query($conn, "SELECT * FROM rating WHERE book_id ='$book_id' ORDER BY id DESC LIMIT 20");
                            $review_count = mysqli_num_rows($book_com_query);
                            if($review_count > 0){
                                
                            
                            while($row = mysqli_fetch_assoc($book_com_query)){
                                $user_id = $row['rater'];
                                
                                $user_query =  mysqli_query($conn , "SELECT fullname FROM users WHERE id='$user_id'");
                                $user = mysqli_fetch_assoc($user_query);
                            
                           
                            ?>
                                <div class="card mb-2">
                                  <div class="card-header">
                                    <?=$user['fullname']?>
                                  </div>
                                  <div class="card-body">
                                    <h5 class="card-title"><?=str_repeat('<i class="fas fa-star text-warning"></i>',$row['rating'])?></h5>
                                    <p class="card-text"><?=$row['review']?></p>
                                  </div>
                                  <div class="card-footer text-muted text-end">
                                    <?=$row['date']?>
                                  </div>
                                </div>
                            <?php  } }else{
                            ?>
                            <div class="card mb-2">
                                  
                                  <div class="card-body text-center">
                                    <h5 class="card-title fst-italic">No Review Yet</h5>
                                    
                                  </div>
                                  
                                </div>
                            <?php
                            }?>        
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
					
						
			        </div><!--//tab-pane-->
			        <!--Active Users-->
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
<?php require_once('footer.php') ?><!--//app-footer-->
<div id="review_modal" class="modal " tabindex="-1" >
  	<div class="modal-dialog" >
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title">Rate and Review</h5>
	        	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	        
	        	</button>
	      	</div>
	      	<div class="modal-body">
	      		<h4 class="text-center mt-2 mb-4">
	        		<i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
	        	</h4>
	        
	        	<div class="form-group">
	        		<textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here" style='min-height: 100px'></textarea>
	        	</div>
	        	<div class="form-group text-center mt-4">
	        		<button type="button" class="btn btn-primary text-white" id="save_review">Submit</button>
	        	</div>
	      	</div>
    	</div>
  	</div>
</div>
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>

<script>
    var rating_data = 0;

    $('#add_review').click(function(){

        $('#review_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function(){

        var rating = $(this).data('rating');
        rating_data = rating;
        reset_background();

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count).addClass('text-warning');

        }

    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

        for(var count = 1; count <= rating_data; count++)
        {

            $('#submit_star_'+count).removeClass('star-light');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });

   

$('#save_review').click(function(){


        var user_review = $('#user_review').val();

        if(user_review == '' || rating_data == 0)
        {
            alert("Please Rate And Review");
            return false;
        }
        else
        {
            $.ajax({
                url:"../config/controllers/rating.php",
                method:"POST",
                data:{rating_data:rating_data, book_id:'<?=$book_id?>', user_review:user_review},
                success:function(data)
                {
                    $('#review_modal').modal('hide');

                    // load_rating_data();

                    window.location = ''
                }
            })
        }

    });

    

    function load_rating_data()
    {
        $.ajax({
            url:"../config/controllers/rating.php",
            method:"POST",
            data:{load_data:'<?=$book["id"]?>'},
            dataType:"JSON",
            success:function(data)
            {
             
               data.average_rating = ((5 * data.five_star_review) + (4 * data.four_star_review)+ (3 * data.three_star_review) + (2* data.two_star_review) + (1* data.one_star_review))/data.total_review || 0;

                $('#average_rating').text((Math.round(data.average_rating * 10) / 10));
                $('#total_review').text(data.total_review);

                var count_star = 0;

                $('.main_star').each(function(){
                 
                    count_star++;
                    if(Math.ceil(data.average_rating) >= count_star)
                    {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });
                
                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

              
            }
        })
    }
load_rating_data();
</script>
</body>
</html> 

