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
        if(isset($_POST['notification_id']) && intval($_POST['notification_id'])>0){
            
            require_once '../../classes/notifications.class.php';
            $notificationObj = new notifications();
    
            // check if the notification owns by the target
            if($notification_data = $notificationObj->fetch_notification_with_id($_POST['notification_id'])){
                if($notification_data['notification_target'] == $_SESSION['admin_user_id']){
                    // update here
                    if($notificationObj->update($_POST['notification_id'])){
                        echo '1';
                    }else{
                        echo '0';
                    }
                }
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