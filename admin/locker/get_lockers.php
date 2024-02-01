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
        

        if(isset($_GET['subscription_id']) && intval($_GET['subscription_id'])>0){
            require_once '../../classes/lockers.class.php';
            $lockerObj = new lockers();
            $locker_data = $lockerObj->fetch_lockers_id($_GET['subscription_id']);
        }

        if(isset($_SESSION['admin_locker_restriction_details']) && $_SESSION['admin_locker_restriction_details'] == 'Modify'){
           

        }else if(isset($_SESSION['admin_locker_restriction_details']) && $_SESSION['admin_locker_restriction_details'] == 'Read-Only'){

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

<ul class="list-group">
    <?php 
        if($locker_data){
            foreach ($locker_data as $key => $value) {
                echo '<li class="list-group-item">Locker_'.htmlentities($value['locker_UID']).'</li>';
            }
        }
    ?>
</ul>