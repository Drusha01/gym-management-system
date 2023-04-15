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
            require_once '../../classes/lockers.class.php';
            $lockerObj = new lockers();
            $lockerlist = $lockerObj->fetch_all_lockers();
            
        }else if(isset($_SESSION['admin_locker_restriction_details']) && $_SESSION['admin_locker_restriction_details'] == 'Read-Only'){
            require_once '../../classes/lockers.class.php';
            $lockerObj = new lockers();
            $lockerlist = $lockerObj->fetch_all_lockers();
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
require_once('../../classes/admin_settings.class.php');
$settingObj = new admin_settings();
$setting_data = $settingObj->fetch_one();
if($lockerlist){
    $locker_uid =1;
    while($locker_uid<=$setting_data['setting_num_of_lockers']){
        $valid=true;
        foreach ($lockerlist as $key => $value) {
            if($value['locker_UID'] == $locker_uid){
             $valid=false;
             break;
            }    
         }
         if($valid){
             echo '<li class="list-group-item">Locker_'.htmlentities($locker_uid).'</li>';
         }
         $locker_uid++;
    }
    
    
}
?>
</ul>

