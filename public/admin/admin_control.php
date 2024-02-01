<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';


// check if we are logged in
if(isset($_SESSION['admin_user_id'])){
  // check if the user is active
  if($_SESSION['admin_user_status_details'] =='active'){
    // check what type of user are we
    if($_SESSION['admin_user_type_details'] =='admin'){
      // go to admin

    }else if($_SESSION['admin_user_type_details'] == 'normal'){
      // do nothing
    } 
  }else if($_SESSION['admin_user_status_details'] =='inactive'){
    // handle inactive user details
  }else if($_SESSION['admin_user_status_details'] =='deleted'){
    // handle deleted user details
  }
} else {
  // go to login page
  header('location:../login/log-in.php');
}

?>