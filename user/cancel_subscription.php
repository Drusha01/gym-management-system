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
        if(isset($_POST['subscription_id']) && intval($_POST['subscription_id'])){
            require_once('../classes/subscriptions.class.php');
            $subscriptionsObj = new subscriptions();

            if($subscription_data = $subscriptionsObj->fetchUserActiveAndPendingSubscription($_SESSION['user_id'])){
                $counter =0;
                foreach ($subscription_data as $key => $value) {
                    if($value['subscription_status_details'] =='Pending' ){
                        $counter++;
                    }
                }
                if($counter>1){
                    foreach ($subscription_data as $key => $value) {
                        if($value['subscription_status_details'] =='Pending' && $value['subscription_id'] == $_POST['subscription_id'] && $value['type_of_subscription_details'] !='Gym Subscription' ){
                            // delete the sub here
                            if($subscriptionsObj->delete_pending_sub($value['subscription_id'])){
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
                            return;
                            
                        }
                    }
                    echo '-1';
                    return;
                }else{
                    // only gym use
                    foreach ($subscription_data as $key => $value) {
                        if($value['subscription_status_details'] =='Pending' && $value['type_of_subscription_details'] =='Gym Subscription' ){
                            if($subscriptionsObj->delete_pending_sub($value['subscription_id'])){
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
                            return;
                        }
                    }
                }
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
