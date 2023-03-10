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
        if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){
            if(isset($_GET['user_id']) && isset($_GET['user_status_details']) && $_SESSION['admin_user_type_details']=='admin'){
                // include the db
                require_once '../../classes/users.class.php';
                require_once '../../classes/admins.class.php';
                require_once '../../tools/functions.php';
    
                
                // admin password??
                $adminObj = new admins();
    
                if(!$adminObj->check_admin($_GET['user_id'])){
                    $userObj = new users();
    
                    if($userObj->update_user_status($_GET['user_id'],$_GET['user_status_details'])){
                        echo '1';
                    }else{
                        echo '0';
                    }
                }else{
                    echo 'the account you are trying to modify is admin';
                }
            }else{
                header('location:account.php');
            }
        }elseif(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Read-Only'){
            header('location:account.php');
        }else{
            //do not load the page
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