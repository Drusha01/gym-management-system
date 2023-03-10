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

        // get trainer_user_id
        if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){
            if(isset($_GET['trainer_add_with_id'])){
                require_once '../../classes/trainers.class.php';

                $trainerObj = new trainers();
                if($trainerObj->add_trainer_with_id($_GET['trainer_add_with_id'])){
                    echo '1';
                }else{
                    echo '0';
                }
            }
        }elseif(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Read-Only'){
            //d
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