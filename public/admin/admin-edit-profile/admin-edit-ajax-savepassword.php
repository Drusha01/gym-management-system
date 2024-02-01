<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';

$password_change_interval = 0;
// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if ($_SESSION['user_status_details'] == 'active') {
  
    // do nothing
    // validate password

    // only allow to change password password_change_interval at a time
    if (!isset($_SESSION['change_password'])) {
      $_SESSION['change_password'] = time();
      // get password

      $userObj = new users();
      if (isset($_POST['current_password']) && validate_password($_POST, 'new_password') && validate_password_same($_POST, 'new_password', 'confirm_password') && !validate_password_same($_POST, 'new_password', 'current_password')) {
        $current_password = $_POST['current_password'];
        $userObj = new users();
        $userObj->setuser_id($_SESSION['user_id']);
        $data = $userObj->get_user_password_hashed_with_id();
        // check if password is valid
        if (password_verify($current_password, $data['user_password_hashed'])) {
          // save password
          $userObj->setuser_password_hashed(password_hash($_POST['new_password'], PASSWORD_ARGON2I));
          if ($userObj->change_user_password()) {
            echo 'saved';
          } else {
            'error saving password';
          }


        } else {
          echo 'current password invalid';
        }

      } else {
        echo 'invalid password';
      }
    } else if (time() - $_SESSION['change_password'] > $password_change_interval) {
      $_SESSION['change_password'] = time();
      // get password

      $userObj = new users();
      if (isset($_POST['current_password']) && validate_password($_POST, 'new_password') && validate_password_same($_POST, 'new_password', 'confirm_password')) {
        $current_password = $_POST['current_password'];
        $userObj = new users();
        $userObj->setuser_id($_SESSION['user_id']);
        $data = $userObj->get_user_password_hashed_with_id();
        // check if password is valid
        if (password_verify($current_password, $data['user_password_hashed'])) {
          // save password
          $userObj->setuser_password_hashed(password_hash($_POST['new_password'], PASSWORD_ARGON2I));
          if ($userObj->change_user_password()) {
            echo 'saved';
          } else {
            'error saving password';
          }

        } else {
          echo 'current password invalid';
        }
      } else {
        echo 'invalid password';
      }
    } else {
      echo $_SESSION['change_password'] + $password_change_interval - time();
    } 
  } else if ($_SESSION['user_status_details'] == 'inactive') {
    // handle inactive user details
  } else if ($_SESSION['user_status_details'] == 'deleted') {
    // handle deleted user details
  }
} else {
  // go to login page
  header('location:../login/log-in.php');
}

?>

