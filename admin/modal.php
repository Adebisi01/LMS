<?php require_once('../config/functions/query_functions.php') ?>
	    <!--Add new books modal-->
	    <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <input class='form-control' type='number' name='pages' min=1 required placeholder='Number Of Pages'/>
            </div>
            <div class='form-group  mt-2'>
                <input class='form-control' type='number' name='copies' min=1 required placeholder='Number of Copies'/>
            </div>
            <div class='form-group  mt-2'>
                <input class='form-control' type='text' name='isbn' required placeholder='ISBN Number'/>
            </div>
            <div class='form-group  mt-2'>
                <?php $genre = ['Action','Art/architecture','history','autobiography','anthology', 'biography','chick','business/economics','children','crafts/hobbies','classic', 'Cookbook', 'Comic', 'Diary', 'Coming-of-age', 'Dictionary', 'Crime', 'Education', 'Encyclopedia', 'Drama', 'Guide', 'Fairytale', 'Health/fitness', 'Fantasy', 'History', 'Home/garden', 'Historical_fiction', 'Humor', 'Horror', 'Journal', 'Mystery', 'Math', 'Paranormal_romance', 'Memoir', 'Picture_book', 'Philosophy', 'Poetry', 'Prayer', 'Political thriller', 'Religion', 'spirituality', 'Romance', 'Textbook', 'Satire', 'True_crime', 'Science_fiction', 'Review', 'Short_story', 'Science', 'Suspense', 'Self_help', 'Thriller', 'Sports/leisure', 'Western', 'Travel', 'Young adult', 'True_crime'];?>
                <select required name='genre' class='form-control'>
                    <option>--- SELECT GENRE ----</option>
                    <?php for($i=0; $i < count($genre); $i++): ?>
                    
                    <option value='<?=str_replace(" ","_", strtolower($genre[$i]))?>'>
                        <?=str_replace("_"," ", ucfirst($genre[$i]))?>
                    </option>
                    <?php endfor?>
                </select>
            </div>
            <div class='form-group  mt-2'>
                <input class='form-control' type='file' name='cover' required placeholder='Book Cover'/>
            </div>
            <div class='form-group  mt-2'>
                <input class='form-control' type='text' name='location' required placeholder='Location'/>
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
<!--add book ends-->

<!--Send Broadcast modal-->
<div class="modal fade" id="broadcastModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Broadcast Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <form action='' method='post'>
      <div class="modal-body">
       
            <div class='form-group mb-2'>
                <select class='form-control' name='category' required>
                    <option>
                        Category
                    </option>
                    <option value='staffs'>
                        Staff
                    </option>
                    <option value='users'>
                        Users
                    </option>
                </select>
            </div>
            <div class='form-group mb-2'>
                <input class='form-control' type='text' name='subject' placeholder='Subject' required />
            </div>
            <div class='form-group mb-2'>
                <textarea class='form-control' name='message' placeholder='Message' required style='min-height:100px'></textarea>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary text-white">Reset</button>
        <button type="submit" name='broadcast' class="btn btn-primary text-white" title='delete'><i class="bi bi-send-fill text-white"></i> Send</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!--Send Broadcast Modal Ends-->


<!-- Create Team Modal -->
<div class="modal fade" id="createTeamModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Location</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     <form action='' method='post'>
      <div class="modal-body">
        <div class='form-group mb-2'>
            <input class='form-control' name='team_name' placeholder='Team Name' required/>
        </div>
        <div class='form-group mb-2'>
            <input class='form-control' name='location' placeholder='Team Location' required/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name='create_team' class="btn btn-primary text-white">Create</button>
      </div>
     </form>
    </div>
  </div>
</div>

<!-- Create Team Modal Ends-->

<!-- Create Subscription Modal -->
<div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Subscription Plan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     <form action='' method='post'>
      <div class="modal-body">
        <div class='form-group mb-2'>
            <input class='form-control' type='text' name='plan_name' required placeholder='Plan Name' />
        </div>
        <div class='form-group mb-2'>
            <input class='form-control' type='number' name='plan_price' required placeholder='Plan Price In Naira' />
        </div>
        <div class='form-group mb-2'>
            <select class='form-control' name='plan_duration' required>
                <option>
                    --- Select Duration --- 
                </option>
                <option value='6'>
                    12 Months
                </option>
                <option value='12'>
                    6 Months
                </option>
                <option value='INFINITE'>
                    INFINITE
                </option>
            </select>
        </div>
        <div class='form-group mb-2'>
            <label class='fst-italic fst-bold text-danger'> Info: The cheapest plan should have the lowest level. e.g Free Plan-0, Basic Plan - level 1, Premium Plan- level 2 </label>
            <input class='form-control' type='number' min=0 name='plan_level' required placeholder='Level' />
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name='add_subscription' class="btn btn-primary text-white">Add</button>
      </div>
     </form>
    </div>
  </div>
</div>

<!-- Create Subscription Modal Ends-->
<!-- Physical Request Modal-->
<div class="modal fade" id="physicalRequestModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request A Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action='' method='post'>
      <div class="modal-body">
        <div class='form-group mb-2'>
            <label for='user_select'>Select User</label>
            <select class="form-select" name='user_id' id='user_select'>
                <?php 
                $generated_query = gen_mul_team_query_without_where("SELECT id, fullname, team FROM users", $active_team_array);
                $users_query = mysqli_query($conn, $generated_query) ?>
                <?php while($row = mysqli_fetch_assoc($users_query)): ?>
                <option value="<?=$row['id']?>">
                    <?=$row['fullname']?>
                </option>
                <?php endwhile?>
            </select>
        </div>
        <div class='form-group mb-2'>
            <label for='book_select'>Select Book</label>
            <select class="form-select" name='book_id' id='book_select'>
                <?php 
                $generated_query = gen_mul_team_query("SELECT id, title FROM books WHERE status='active' AND type='hard_copy'", $active_team_array);
                $books_query = mysqli_query($conn, $generated_query) ?>
                <?php while($row = mysqli_fetch_assoc($books_query)): ?>
                <option value="<?=$row['id']?>">
                    <?=$row['title']?>
                </option>
                <?php endwhile?>
            </select>
        </div>
        <div class='form-group mb-2'>
            <label for='due_date'>Due Date</label>
            <input class='form-control' type='date' id='date_picker' name='return_date' required placeholder='Due Date'/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name='physical_request' class="btn btn-primary text-white">Request</button>
      </div>
      </form>
    </div>
  </div>
  </div>
<!-- Physical Request Modal Ends-->
<!-- Report Modal -->
<?php $report_array = ['subscription', 'book', 'downloads', 'book_circulation']?>
<?php foreach($report_array as $report): ?>
<div class="modal fade" id="<?=$report?>Report" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=str_replace('_', ' ', ucfirst($report))?> report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     <form action='' method='post' target=_blank> 
      <div class="modal-body">
        <div class='form-group'>
            <label>Start Date</label>
            <input class='form-control' name='start_date' type='date' required/>
        </div>
        <div class='form-group'>
            <label>End Date</label>
            <input class='form-control' name='end_date' type='date' required/>
        </div>
        <input hidden name='report' value='<?=$report?>' />
      </div>
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary text-white">Generate</button>
      </div>
    </form>
    </div>
  </div>
</div>

<?php endforeach ?>
<!-- Report Modal Ends-->
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
