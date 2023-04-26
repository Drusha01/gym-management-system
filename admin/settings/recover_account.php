<?php
// start session
session_start();

// includes
require_once '../../tools/functions.php';
require_once '../../classes/users.class.php';

// check if we are normal user
if(isset($_SESSION['user_id'])){
    header('location:../user/user-page.php');
}


if(isset($_SESSION['admin_id'])){
    // check admin user details
    if($_SESSION['admin_user_status_details'] == 'active'){
        // do nothing
        
        if($_SESSION['admin_user_type_details'] == 'admin'){
            if ( isset($_POST['user_id']) && validate_password($_POST, 'new_password') && validate_password_same($_POST, 'new_password', 'confirm_password')) {

                $userObj = new users();
                $userObj->setuser_id($_POST['user_id']);

                $userObj->setuser_password_hashed(password_hash($_POST['new_password'], PASSWORD_ARGON2I));
                if ($userObj->change_user_password()) {
                    echo '1';
                } else {
                    echo '0';
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