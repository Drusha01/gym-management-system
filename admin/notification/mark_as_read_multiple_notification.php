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
        if(isset($_POST['notificatiton_arr']) ){
            require_once '../../classes/notifications.class.php';
            $notificationObj = new notifications();
            foreach ($_POST['notificatiton_arr'] as $key => $value) {
                if(intval($value)>0){
                    if($notification_data = $notificationObj->fetch_notification_with_id($value)){
                        if($notification_data['notification_target'] == $_SESSION['admin_user_id']){
                            // update here
                            if(!$notificationObj->update($value)){
                                echo '0';
                                break;
                            }
                        }
                    }
                }
            }
            echo '1';
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