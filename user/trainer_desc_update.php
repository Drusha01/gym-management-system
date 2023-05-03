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
      
      if(isset($_POST['trainer_id']) && intval($_POST['trainer_id'])>0){
        require_once '../classes/trainers.class.php';
        $trainerObj = new trainers();
        
        if(isset($_POST['trainer_status_description']) && strlen($_POST['trainer_status_description'])>0){
            if($trainerObj->update_trainer_status_description($_POST['trainer_id'],$_SESSION['user_id'],$_POST['trainer_status_description'])){
                echo '1';
            }else{
                echo '0';
            }
        }
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

