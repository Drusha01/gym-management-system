<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';

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
        // do 
        // get subscriptions
        if(isset($_POST['subscriber_trainers_id']) && intval($_POST['subscriber_trainers_id'])){
            require_once '../classes/subscriber_trainers.class.php';
            $subscriber_trainersObj = new subscriber_trainers();
            if(strlen($_POST['note'])>0){
                $_POST['note'] = trim($_POST['note']);
            }else{
                echo '0';
                return;
            }
            if($subscriber_trainersObj->update_note($_POST['subscriber_trainers_id'],$_POST['note'])){
                // notification
                if(isset($_POST['trainer_user_id'])){
                    require_once '../classes/notifications.class.php';
                    $notificationObj = new notifications(); 
                    $notification_info = 'Your client added a note: '.$_POST['note'].'.';
                    if(!$notificationObj->insert($_SESSION['user_id'],$_POST['trainer_user_id'],'Trainer','trainer.png', $notification_info)){
                        exit('notification insert error');
                    }
                }
                echo '1';
                return;
            }else{
                echo '0';
            }    
        }

    // if only gym use -> proceed to cancel

    // else if many -> check if canceling is a gym use if so return -1
    // if not gym use then proceed to cancel the sub
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
