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
        require_once '../../classes/notifications.class.php';
        $notificationObj = new notifications();
        if($notification_data = $notificationObj->get_three_latest_notifications($_SESSION['admin_user_id'])){
            echo '<tbody>';
            foreach ($notification_data as $key => $value) {
                echo '
                <tr>
                    <td class="w-100 ps-3"><strong>'.htmlentities($value['notification_info']).'</strong><br> <p class="pb-0 mb-0 fw-light">'.htmlentities($value['notification_date_created']).'</p></td>
                </tr>';          
            }
            echo '</tbody>';
        }else{
            echo '0';
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