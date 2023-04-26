

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
        if($notification_data = $notificationObj->get_three_latest_notifications($_SESSION['user_id'])){
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