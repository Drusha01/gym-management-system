<div class="container-fluid p-3" style="min-height: 450px;">
    <div class="container-sub">
        <div class="row g-2 mb-2">
            <?php 
            session_start();
            require_once '../tools/functions.php';
            require_once '../classes/subscriber_trainers.class.php';
            require_once '../classes/subscriptions.class.php';
            $subscriber_trainersObj = new subscriber_trainers();

            if($trainers_data = $subscriber_trainersObj->fetch_trainers($_SESSION['user_id'])){
                echo '
            <h5 class="col-12 fw-bold">Availed Trainers</h5>
            <div class="form-group col-12 col-sm-4 table-filter-option">
                <label for="keyword" class="ps-2 pb-2">Search</label>
                <input type="text" name="keyword" id="keyword" placeholder="Enter Trainer Name Here" class="form-control ms-md-2">
            </div>
            <div class="container my-3">
                <div class="shadow rounded-3  table-responsive ">
                    <table id="#" class="table align-middle mb-0 bg-white">
                        <thead class="bg-dark text-light">
                            <tr>
                            <th class="d-lg-none"></th>
                            <th class="col-12 col-lg-4 ps-0 ps-lg-5">NAME OF TRAINER</th>
                            <th class="text-center">AGE</th>
                            <th class="text-center">GENDER</th>
                            <th class="text-center">END OF SUBSCRIPTION</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($trainers_data as $key => $value) {
                            echo ' <tr>
                            <th class="d-lg-none"></th>
                            <td class="col-12 col-lg-4 ps-0 ps-lg-5">
                                <div class="d-flex align-items-center">
                                <img
                                    src="../img/profile-resize/'.$value['user_profile_picture'].'"
                                    alt=""
                                    style="width: 45px; height: 45px"
                                    class="rounded-circle"
                                    />
                                <div class="ms-3">
                                    <p class="fw-bold mb-1"><a href="user-trainer-profile.php" class=" text-decoration-none text-dark">'.htmlentities($value['user_fullname']).'</a></p>
                                </div>
                                </div>
                            </td>
                                <td class="text-center">'.htmlentities(getAge($value['user_birthdate'])).'</td>
                                <td class="text-center">'.htmlentities($value['user_gender_details']).'</td>
                                <td class="text-center">'.htmlentities(date_format(date_create($value['subscription_end_date']), "F d, Y")).'</td>
                                <td class="text-center"><span class="badge bg-success rounded-pill">'.htmlentities($value['trainer_availability_details']).'</span></td>';
                          if(strlen($value['subscriber_trainers_subscription_note'])==0){
                            echo '<td class="text-center"><button class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#addnoteModal" onclick="add_note('.$value['subscriber_trainers_id'].','.htmlentities($value['trainer_user_id']).')">Add Note</button></td>';

                          }else{
                            echo '<td class="text-center"><button class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#view/editnoteModal" onclick="edit_note('.$value['subscriber_trainers_id'].','.htmlentities($value['trainer_user_id']).')" id="note_'.$value['subscriber_trainers_id'].'"value="'.htmlentities($value['subscriber_trainers_subscription_note']).'">View/Edit Note</button></td>';
                          }
                        
                                 
                            echo'
                                </tr>';
                        }

                        echo '
                        </tbody>
                    </table>
                </div>
            </div>
                ';
            }else{
                echo '
            <div class="pt-2">
                <h5>Availed Trainer Subscription Go Here.</h5>
                <div class="form-group col-12 pt-3 ">
                    <a class="btn btn-success" role="button" href="user-avail.php">Avail Now</a>
                </div>
            </div>
            ';
            }
            
            
            ?>
        
        </div>
    </div>
</div>
<script>
  var subscriber_trainers_id_var;
  var trainer_user_id_var;
  function add_note(subscriber_trainers_id,trainer_user_id){
    trainer_user_id_var = trainer_user_id;
    subscriber_trainers_id_var= (subscriber_trainers_id);
  }
  function edit_note(subscriber_trainers_id,trainer_user_id){
    trainer_user_id_var = trainer_user_id;
    $('#edit_note_content').html($('#note_'+subscriber_trainers_id).val());
    subscriber_trainers_id_var = (subscriber_trainers_id);

    // get note details
  }
  $('#edit_note_save').click(function (){
    if($('#edit_note_content').val().length>0){
      var note = new FormData();  
    // validation
    note.append( 'subscriber_trainers_id', subscriber_trainers_id_var);  
    note.append( 'trainer_user_id', trainer_user_id_var);  
    
    note.append( 'note',$('#edit_note_content').val());  
    $('#edit_close').click();
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "trainer_note.php",
        data: note,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function ( result ) {
          console.log(result);
          if(result == 1){
            //reload
            $.ajax({
                type: "GET",
                url: 'user-trainer.php',
                success: function(result)
                {
                    $('#trainer').html(result);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }
            });
          }else{
            alert('Error adding note');
          }
          
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });
    }else{
      alert('please put note before adding note.')
    }
  });
  $('#add_note_insert').click( function(){
    if($('#add_note_content').val().length>0){
      $('#add_close').click();
      var note = new FormData();  
    // validation
    note.append( 'subscriber_trainers_id', subscriber_trainers_id_var);  
    note.append( 'trainer_user_id', trainer_user_id_var);  
    note.append( 'note',$('#add_note_content').val());  
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "trainer_note.php",
        data: note,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function ( result ) {
          if(result == 1){
            //reload
            $.ajax({
                type: "GET",
                url: 'user-trainer.php',
                success: function(result)
                {
                    $('#trainer').html(result);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }
            });
          }else{
            alert('Error adding note');
          }
          
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });
    }else{
      alert('please put note before adding note.')
    }
  }
);
</script>
<!-- Modal for add note -->
<div class="modal fade" id="addnoteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Note</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Add Note</label>
            <textarea class="form-control" id="add_note_content" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="add_close">Close</button>
        <button type="button" class="btn btn-outline-dark" id="add_note_insert">Add Note</button>
      </div>
    </div>
  </div>
</div>

<!-- ung add note kapag first time then kapag meron na ung button maing view/edit note na -->
<!-- Modal for view or edit note -->
<div class="modal fade" id="view/editnoteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">View/Edit Note</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">View/Edit</label>
            <textarea class="form-control" id="edit_note_content" rows="3">Cardio and lightweight lng sana po</textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="edit_close">Close</button>
        <button type="button" class="btn btn-outline-dark"  id="edit_note_save">Save Changes</button>
      </div>
    </div>
  </div>
</div>



