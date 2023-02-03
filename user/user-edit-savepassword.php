<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';


// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if($_SESSION['user_status_details'] =='active'){
    // validate password
    


    $userObj = new Users();
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

?>    