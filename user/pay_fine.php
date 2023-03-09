<!DOCTYPE html>
<?php require_once('../config/db.php') ?>
<?php require_once('../config/app-config.php') ?>
<?php require_once('../config/variables.php') ?>
 <?php  
	    $fine_query = mysqli_query($conn, "SELECT * FROM fines WHERE user='$current_user_id' AND status='unpaid'");
	            $fine = mysqli_fetch_assoc($fine_query);
	            
	            $fine_exist = mysqli_num_rows($fine_query);
	            if($fine_exist == 0){
	                ?>
	                <script>
	                    window.location = '../login'
	                </script>
	                <?php
	            }
	            
	            
	    ?>


<html lang="en"> 
<head>
    <title> Pay Fine | <?=$app_title?></title>
    
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
			            <h1 class="app-page-title mb-0">Pay Fine</h1>
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
			    
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5 w-75">
						    <div class="app-card-body">
						        
						        
                    <div class="card">
                      <div class="card-header">
                        Pay Fine
                      </div>
                      <div class="card-body">
                        <form>
                            <script src="https://js.paystack.co/v1/inline.js"></script>
                            <p>Pay a sum of <?=$fine['amount']?></p>
                            <button class='btn btn-primary mb-2 text-white' type="button" onclick="payWithPaystack()"> Pay </button> 
                        </form>
                      </div>
					</div>
							
						       
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
					
						
			        </div><!--//tab-pane-->
			        <!--Active Users-->
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
<?php require_once('footer.php') ?><!--//app-footer-->
<?php require_once('modal.php') ?><!--//app-footer-->

	    
    </div><!--//app-wrapper-->    					

<?php require_once('scripts.php'); ?>
<script>

$('#selected_plan').change(function(){
        
})
     

 function removeFine(){
            $("#loadingModal").modal('show'); 
    
    $.ajax('../config/controllers/fine.php', {
        type: 'POST',  
        data: { amount:"<?=$fine['amount']?>"},  // data to submit
        success: function (data) {
            
            $('#loadingModal').on('hidden.bs.modal', function (e) {
           $("#successModal").modal('show');
           setTimeout(function(){
                window.location='dashboard'
            }, 2000)
           
})            
            $("#loadingModal").modal('hide');
            
            
            
        },
    });
 }




  function payWithPaystack(){
    // let price = selected_plan.value.split("|")[0];
    
    var handler = PaystackPop.setup({
      key: '<?=$pay_stack_test_key?>',
      email: 'binaltechnologies@gmail.com',
      amount: "<?=$fine['amount']?>"+0+0,
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
        //   alert('success. transaction ref is ' + response.reference);
         removeFine();
        
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

