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
            if(isset($_GET['gym_price']) && intval($_GET['gym_price'])>0){
                require_once('../../classes/walk_in_prices.class.php');
                $walk_in_pricesObj = new walk_in_prices();
    
                if($walk_in_pricesObj->update('Gym-Use',$_GET['gym_price'])){
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
