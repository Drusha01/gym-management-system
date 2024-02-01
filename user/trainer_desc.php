<?php
// start session
session_start();

// includes


if(isset($_SESSION['admin_id'])){
  header('location:../admin/admin_control_log_in.php');
}
// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if($_SESSION['user_status_details'] =='active'){
    // check what type of user are we
    if($_SESSION['user_type_details'] =='admin'){
      // go to admin
    }else if($_SESSION['user_type_details'] == 'normal'){
      // do nothing
    
        require_once '../classes/trainers.class.php';
        $trainerObj = new trainers();
        if(!$trainers_data = $trainerObj->fetch_my_details($_SESSION['user_id'])){
            echo 'not nice';
            return;
        }
        
        
      
    } 
  }else if($_SESSION['user_status_details'] =='inactive'){
    // handle inactive user details
  }else if($_SESSION['user_status_details'] =='deleted'){
    // handle deleted user details
  }
} else {
  // go to login page
  header('location:../login/log-in.php');
}

?>




<div class="container-fluid" style="min-height: 450px;">
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Tell Us About Yourself and What do you focus on.</label>
  <input type="number" id="trainer_id" value="<?php echo $trainers_data['trainer_id'] ?>" style="visibility:hidden;">
  <textarea class="form-control"  rows="3" id="trainer_status_description"><?php if(isset($trainers_data['trainer_status_description']))echo $trainers_data['trainer_status_description']?></textarea>
  <div class="form-group col-12 ">
      <button class="btn btn-success" role="button" id="save_trainer_status_description">Save</button>
  </div>
</div>
</div>
<script>
  $('#save_trainer_status_description').click(function (){
    if($('#trainer_status_description').val().length>0){
      var trainer_desc = new FormData();
      trainer_desc.append( 'trainer_id', $('#trainer_id').val());  
      trainer_desc.append( 'trainer_status_description', $('#trainer_status_description').val());  
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "trainer_desc_update.php",
        data: trainer_desc,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function ( result ) {
          console.log(result);
          if(result == 1){
                $.ajax({
                type: "GET",
                url: 'trainer_desc.php',
                success: function(result)
                {
                    $('#description').html(result);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }
            });
          }else{
            alert('error editing description');
          }
          

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
      });
    }else{
      alert('please add description')
    }
  });
</script>