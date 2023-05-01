<?php
// start session
session_start();

// includes


// check if we are normal user
if(isset($_SESSION['admin_id'])){
    header('location:../admin/admin_control_log_in.php');
}
if(isset($_SESSION['user_id'])){
    // check if the user is active
    if($_SESSION['user_status_details'] =='active'){
      // check what type of user are we
      if(isset($_GET['offer_id']) && $_GET['offer_id'] ){
       
        print_r($_GET);
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