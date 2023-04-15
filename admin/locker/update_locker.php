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
        if(isset($_SESSION['admin_locker_restriction_details']) && $_SESSION['admin_locker_restriction_details'] == 'Modify'){
            if(isset($_POST['locker_id']) && intval($_POST['locker_id'])>0 && isset($_POST['locker_UID']) && intval($_POST['locker_UID'])>0){
                require_once '../../classes/lockers.class.php';
                $lockerObj = new lockers();
                
                // get locker data
                if($locker_details = $lockerObj->fetch_locker_details($_POST['locker_id'])){
                    // first check if the locker_UID is available
                    if(!$lockerObj->fetch_locker_details_with_locker_UID($_POST['locker_UID'])){
                        // insert
                        if($lockerObj->insert($locker_details['locker_subscription_id'],$_POST['locker_UID'])){
                            // delete the old locker_UID
                            if($lockerObj->delete($locker_details['locker_id'])){
                                echo '1';
                            }else{
                                echo '0';
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
            }else{
                echo '0';
            }
            
        }else if(isset($_SESSION['admin_locker_restriction_details']) && $_SESSION['admin_locker_restriction_details'] == 'Read-Only'){
            header('location:locker.php');
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