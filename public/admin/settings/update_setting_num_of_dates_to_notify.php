<?php 
session_start();
if(isset($_SESSION['user_id'])){
    header('location:../user/user-page.php');
}

if(isset($_SESSION['admin_id'])){
    // check admin user details
    if($_SESSION['admin_user_status_details'] == 'active'){
        // do nothing
        if($_SESSION['admin_user_type_details'] != 'admin'){
            header('location:../dashboard/dashboard.php');
        }
        if($_SESSION['admin_user_type_details'] == 'admin'){
            // get the admin details
            if(isset($_GET['setting_num_of_dates_to_notify']) && intval($_GET['setting_num_of_dates_to_notify'])>0){
                require_once('../../classes/admin_settings.class.php');
                $settingObj = new admin_settings();
                if($settingObj->update_setting_num_of_dates_to_notify($_GET['setting_num_of_dates_to_notify'])){
                    echo '1';
                }else{
                    echo '0';
                }
            }else{
                echo '0';
            }
            
        }else{
            // go to dashboard
            header('location:../dashboard/dashboard.php');
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
