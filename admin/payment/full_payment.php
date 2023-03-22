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
        if(isset($_SESSION['admin_payment_restriction_details']) && $_SESSION['admin_payment_restriction_details'] == 'Modify'){
            if(isset($_POST['password']) && strlen($_POST['password'])>=12 && isset($_POST['user_id']) && intval($_POST['user_id'])>0){
                require_once('../../classes/subscriptions.class.php');
                require_once('../../classes/admins.class.php');
                $subscriptionsObj = new subscriptions();
                $adminObj = new admins();
                if($admin_data = $adminObj->get_admin_password($_SESSION['admin_id'])){
                    if (password_verify($_POST['password'], $admin_data['user_password_hashed'])) {
                        if($payments_data = $subscriptionsObj->fetch_active_subs_payment($_POST['user_id'])){
                            $error = false;
                            foreach ($payments_data as $key => $value) {
                                if(!$subscriptionsObj->full_payment($value['subscription_id'])){
                                    $error = true;
                                }
                            }
                            if($error){
                                echo '0';
                            }else{
                                echo '1';
                            }
                        }else{
                            echo '0';
                        }
                    }else{
                        echo '0';
                    }
                }else{
                    echo '0';
                }
            }
        }else if(isset($_SESSION['admin_payment_restriction_details']) && $_SESSION['admin_payment_restriction_details'] == 'Read-Only'){
            
        }else{
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