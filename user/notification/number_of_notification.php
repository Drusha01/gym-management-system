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
      $user_id = $_SESSION['user_id'];
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
