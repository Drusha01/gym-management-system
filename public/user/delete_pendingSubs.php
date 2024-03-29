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
      if(isset($_GET['user_id']) && $_GET['user_id'] == $_SESSION['user_id']){
        require_once '../classes/subscriptions.class.php';

        $subscriptionsObj = new subscriptions();


        if($subscriptionsObj->delete_pending_subscription($_GET['user_id'])){
            require_once '../classes/notifications.class.php';
            $notificationObj = new notifications();
            require_once '../classes/admins.class.php';
            $adminObj = new admins();
            $notification_info ='Customer '.$_SESSION['user_lastname'].', '.$_SESSION['user_firstname'].' '.$_SESSION['user_middlename'].' has cancelled availing their subscription.';
            if($admin_id_data = $adminObj->fetch_all_admin_id()){
              foreach ($admin_id_data as $key => $value) {
                  if(!$notificationObj->insert($_SESSION['user_id'],$value['admin_user_id'],'Cancel','cancelled.png', $notification_info)){
                      exit('notification insert error');
                  }
              }
              
            }
            echo '1';
        }else{
            echo '0';
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