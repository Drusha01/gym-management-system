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
            if(isset($_GET['trainer_id']) && isset($_GET['trainer_status']) && $_SESSION['admin_user_type_details']=='admin'){
                // include the db
                require_once '../../classes/trainers.class.php';
                require_once '../../classes/admins.class.php';
                require_once '../../tools/functions.php';
    
                
                // admin password??
                $trainerObj = new trainers();
                if($trainerObj->update_trainer_availability($_GET['trainer_id'],$_GET['trainer_status'])){
                    echo '1';
                }else{
                    echo '0';
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