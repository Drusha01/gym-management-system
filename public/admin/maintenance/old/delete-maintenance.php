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
        if(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Modify'){
            require_once '../../classes/equipments.class.php';
            require_once '../../tools/functions.php';
            $equipmentsObj = new equipments();
        
            if(isset($_GET['equipment_id'])){

                if(!($equipment_data = $equipmentsObj->delete($_GET['equipment_id']))){
                    echo '0';
                }else{
                    echo '1';
                }
            }
        }elseif(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Read-Only'){
            header('location:maintenance.php');
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