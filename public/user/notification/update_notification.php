
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
        require_once '../../classes/notifications.class.php';
        $notificationObj = new notifications();

        // check if the notification owns by the target
        if($notification_data = $notificationObj->fetch_notification_with_id($_POST['notification_id'])){
            if($notification_data['notification_target'] == $_SESSION['user_id']){
                // update here
                if($notificationObj->update($_POST['notification_id'])){
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