<!DOCTYPE html>
<?php require_once('include.php')?>

<?php 

        if(isset($_POST['e_book_id'])){
            $_SESSION['e_book_id'] = $_POST['e_book_id'];
        }
         $e_book_id =  $_SESSION['e_book_id'] ;
         
            
        $e_book_query = mysqli_query($conn, "SELECT * FROM books WHERE type='e_book' AND status='active' AND id='$e_book_id' LIMIT 1");
        
        $e_book = mysqli_fetch_assoc($e_book_query);
        
        // Check if user has previously Purchased the book
        $prev_purchase_query =  mysqli_query($conn, "SELECT purchaser, book FROM purchased_books WHERE purchaser='$current_user_id' AND book='$e_book_id'");
        $prev_purchase = mysqli_num_rows($prev_purchase_query) > 0 ? true : false;
?>
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
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0"><a href='e-books'><i class="bi bi-arrow-left text-primary pe-2"></i></a><?=ucfirst(strtolower($e_book['title']))?></h1>
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
			    
			    
			    	<div class="tab-content  d-flex justify-content-center" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5 w-100">
						    <div class="app-card-body w-100 p-4">
						        
						        
                            <div class="card mb-3" style="max-width: 540px;">
                              <div class="row g-0">
                                <div class="col-md-4">
                                  <img class='border border-secondary rounded p-2 w-100 mb-2' src='../assets/covers/<?=$e_book["cover"]?>' alt='Book Cover'/>
                                  <center>
                                  <?php if($e_book['price'] > 0 && $prev_purchase == false):?>
						          <form>
						              <script src="https://js.paystack.co/v1/inline.js"></script>
						               <button type='button' class='btn btn-secondary mb-2' onclick="payWithPaystack()"><i class="bi bi-cash me-2"></i> Buy Book</button>
						          </form>
						        <?php else:?>
						            <form action='open_file' method='post' target='_blank'>
						                <button class='btn btn-secondary mb-2' name='file' value='<?=$e_book['file']?>'><i class="bi bi-book-fill me-2"></i>Read Online</button>
						          </form>
						           <a href="../assets/books/<?=$e_book['file']?>" download="<?=$e_book['title']?>" onclick="countDownlaod()"> <button class='btn btn-secondary mb-2'><i class="bi bi-download me-2"></i> Download Book</button></a>
						            <?php endif?>
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
<?php require_once('modal.php') ?><!--//app-footer-->
	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php') ?>
<script>
    function countDownlaod(){
    $.ajax('../config/controllers/download.php', {
        type: 'POST',  
        data: { e_book_id: '<?=$e_book_id?>' },  // data to submit
        success: function (data) {
            // alert('Download counted');
        },
    });
 }

        function regPurchase(){
            $("#loadingModal").modal('show');
            
        $.ajax('../config/controllers/purchase.php', {
        type: 'POST',  
        data: { book_id: '<?=$e_book_id?>', price:"<?=$e_book['price']?>",purchaser:'<?=$current_user_id?>', team:'<?=$current_user_team?>' },  // data to submit
        success: function (data) {
            
         $('#loadingModal').on('hidden.bs.modal', function (e) {
           $("#successModal").modal('show');
            })            
            $("#loadingModal").modal('hide');
        },
    });
 }

        function downloadBook() 
            {
                var downloadLink = document.createElement("a");
                // If you don't know the name or want to use
                // the webserver default set name = ''
                downloadLink.href = "../assets/books/<?=$e_book['file']?>"
                downloadLink.download = "<?=$e_book['title']?>";
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            }

  function payWithPaystack(){
    var handler = PaystackPop.setup({
      key: '<?=$pay_stack_test_key?>',
      email: 'binaltechnologies@gmail.com',
      amount: <?=$e_book['price']?>00,
      // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
         custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: "+2348012345678"
            }
         ]
      },
      callback: function(response){
          alert('success. transaction ref is ' + response.reference);
          regPurchase();
          downloadBook();
          countDownlaod();
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }
</script>

</body>
</html> 

