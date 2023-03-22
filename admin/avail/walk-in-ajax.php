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
        // 
        
        if(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Modify'){
            // query the user information with id
            require_once('../../classes/walk_ins.class.php');
            $walk_insObj = new walk_ins();
            if(isset($_POST['user_id']) && isset($_POST['trainer_id'])){
                // 
                
                if($walk_insObj->insert_gym_and_trainer_walk_in($_POST['user_id'],$_POST['trainer_id'])){
                    echo '1';
                }else{
                    echo '0';
                }
            }else if(isset($_POST['user_id'])){
                if($walk_insObj->insert_gym_walk_in($_POST['user_id'])){
                    echo '1';
                }else{
                    echo '0';
                }
            }else{
                header('location:account.php');
            }
        }elseif(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Read-Only'){
            header('location:avail.php');
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
    header('location:../admin_control_log_in2.php');
}

?>