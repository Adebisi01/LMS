
<!--Feedback modal-->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Feedback</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action='' method='post'>
      <div class="modal-body">
        <div class='form-group mb-2'>
            <input class='form-control' name='subject' type='text' required placeholder='Subject'/>
        </div>
        <div class='form-group mb-2'>
            <textarea name='message' placeholder='message' required class='form-control' style='min-height: 100px'></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name='send_feedback' class="btn btn-primary text-white">Send</button>
      </div>
     </form>
    </div>
  </div>
</div>
<!--Feedback modal ends-->

<!-- Success Modal-->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex flex-column align-items-center">
        <i class="bi bi-check2-circle display-1 text-success"></i>
        <p> Success</p>
      </div>

    </div>
  </div>
</div>
<!--Success Modal End-->

<!--Spinner Modal-->
<div class="modal fade " id="loadingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content d-flex justify-content-center align-items-center p-4 ">
      
      <div class="spinner-grow text-primary " role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    </div>
  </div>
</div>
<!-- Spinner Modal End-->

<!-- Change Password Modal  -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     <form action='' method='post'>
      <div class="modal-body">
        <center class='text-danger mb-2' id='error_msg'></center>
        <div class="form-group">
            <input class='form-control mb-2' type='password' name='password'  required placeholder='Enter Your Current Password'/>
        </div>
        <div class="form-group">
            <input class='form-control mb-2' type='password' name='new_password' id='new_password' required placeholder='Enter Your New Password'/>
        </div>
        <div class="form-group">
            <input class='form-control mb-2' type='password' name='confirm_password' id='confirm_password' required placeholder='Enter Your New Password Again'/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id='saveBtn' name='change_password' class="btn btn-primary text-white">Save </button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- Change Password Modal Ends -->
<!-- Subscription Error Modal -->

<div class="modal fade" id="subErrorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <center> You are already subscribed to this or a  higher subscription plan </center>
      </div>
      
    </div>
  </div>
</div>


<!-- Subscription Error Modal Ends-->