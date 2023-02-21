<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';

if(isset($_SESSION['admin_id'])){
  header('location:../admin/admin_control_log_in2.php');
}
// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if($_SESSION['user_status_details'] =='active'){
    // check what type of user are we
    if($_SESSION['user_type_details'] =='admin'){
      // go to admin
    }else if($_SESSION['user_type_details'] == 'normal'){
      // validate if the email is taken
      $userObj = new users();
      $userObj->setuser_email($_SESSION['user_email']);
      $user_email = $userObj->user_duplicateEmail();

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


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMAIL VERIFICATION</title>
</head>
<body>
    <h3>EMAIL VERIFICATION</h3>
    <form action="user-change-email-verify.php" method="POST">
        <label for="">New email address</label>
        <input type="text" name="email" value="<?php if(!isset($user_email['user_id'])){echo_safe($_SESSION['user_email']);} ?>" placeholder="<?php if(isset($user_email['user_id'])){echo_safe($_SESSION['user_email'].' email taken');} ?>">
        <input type="submit" value="next" name="next" >
    </form>
</body>
</html>