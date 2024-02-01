<?php
// start session
session_start();

// includes


// check if we are normal user
if(isset($_SESSION['user_id'])){
    header('location:../user/user-page.php');
}


if(isset($_SESSION['admin_id'])){
    // check admin user details
    if($_SESSION['admin_user_status_details'] == 'active'){
        // do nothing
       
        $user_id = $_SESSION['admin_user_id'];
      session_write_close();
      require_once '../../classes/notifications.class.php';
      $notificationObj = new notifications();
      if(isset($_GET['number_of_notification']) && intval($_GET['number_of_notification'])>=0){
        $timer = 25;
        $number_of_notification = $_GET['number_of_notification'];
        while($timer--){
          if($notification_data = $notificationObj->get_number_of_notifications( $user_id )){
            if($notification_data['number_of_notification']>$number_of_notification ){
              echo htmlentities($notification_data['number_of_notification']);
              return;
            }else{
              echo '0';
            }
            // just set it back
            $number_of_notification = $notification_data['number_of_notification'];
            sleep(1);
          }
        }
      }
      else{
        if($notification_data = $notificationObj->get_number_of_notifications( $user_id )){
          echo htmlentities($notification_data['number_of_notification']); 
          return; 
  
        }else{
          echo '0';
        } 
      }
    }else if($_SESSION['admin_user_status_details'] == 'inactive'){
        // do this
    }else if($_SESSION['admin_user_status_details'] == 'deleted'){
        // go to deleted user page
    }

}else{
    // go to admin login
    header('location:../admin_control_log_in.php');
}

?>