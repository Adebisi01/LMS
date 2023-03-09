<!DOCTYPE html>
<?php require_once('include.php')?>

<html lang="en"> 
<head>
    <title> Subscribe | <?=$app_title?></title>
    
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
			            <h1 class="app-page-title mb-0">Subscribe</h1>
				    </div>
				    </div><!--//col-auto-->
			    </div><!--//row-->
			    
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5 w-75">
						    <div class="app-card-body">
						        
						        
                    <div class="card">
                      <div class="card-header">
                        Subscribe
                      </div>
                      <div class="card-body">
                    <form>
                    <script src="https://js.paystack.co/v1/inline.js"></script>
 
                       <div class='form-group'>
                           <lable>Pick A Plan</lable>
						        <select name='selected_plan' class='form-control mb-2 py-2' id='selected_plan'>
						            <?php $sub_list_query =  mysqli_query($conn, "SELECT * FROM subscription_plans")  ?>
						            <?php while($row = mysqli_fetch_assoc($sub_list_query)):?>
						                <option  value='<?=$row["price"]?>|<?=$row["id"]?>'><?=$row["name"]?> (<?=$row['duration']?> Month(s)) - <?=$row['price']?> Naira</option>
						            <?php endwhile?>
						        </select>
                        </div>
                     <button class='btn btn-primary mb-2 text-white' type="button" onclick="checkSub()"> Pay </button> 
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
     

 function SendSubscriptionReq(){
            $("#loadingModal").modal('show'); 
            
            $('#loadingModal').on('hidden.bs.modal', function (e) {
                   $("#successModal").modal('show');
                   
                   setTimeout(function(){
                       window.location = 'books';
                   }, 2000)
                   
        })    
    var selectedValue = $("#selected_plan option:selected").text();
    let subId = selected_plan.value.split("|")[1];
    
    $.ajax('../config/controllers/subscribe.php', {
        type: 'POST',  
        data: { sub_plan: selectedValue, sub_id:subId },  // data to submit
        success: function (data) {
        
                    $("#loadingModal").modal('hide');
                    
        },
    });
 }

function checkSub(){
    let subId = selected_plan.value.split("|")[1];
    if(Number('<?=$current_user_subscription?>') >= Number(subId)){
        $('#subErrorModal').modal('show');
    }else{
        payWithPaystack();
    }
}


  function payWithPaystack(){
    let price = selected_plan.value.split("|")[0];
    
    var handler = PaystackPop.setup({
      key: '<?=$pay_stack_test_key?>',
      email: 'binaltechnologies@gmail.com',
      amount: price+0+0,
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
         SendSubscriptionReq();
        
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

