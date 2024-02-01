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

            if(!$walk_ins_data = $walk_insObj->get_walk_in_details_with_walk_in_id($_POST['walk_in_id'])){
                echo '0';
                return;
            }
            if(isset($_POST['walk_in_id'])){
                if($walk_insObj->delete_walk_in($_POST['walk_in_id'])){
                    if($_SESSION['admin_user_type_details'] != 'admin'){
                        require_once('../../classes/admins.class.php');
                        
                        require_once('../../classes/notifications.class.php');
                        $adminObj = new admins();
                        $notificationObj = new notifications();
                        if($admin_id_data = $adminObj->fetch_admin_id_of_admins()){
                            foreach ($admin_id_data as $key => $value) {
                                
                                $notification_info ='Staff '.$_SESSION['admin_user_lastname'].', '.$_SESSION['admin_user_firstname'].' '.$_SESSION['admin_user_middlename'].' deleted a customer Walk-In, ('.$walk_ins_data['user_fullname'].'.';
                                
                                if(!$notificationObj->insert($_SESSION['admin_user_id'],$value['user_id'],'Logs','logs.png', $notification_info)){
                                    exit('notification insert error');
                                }
                            }
                        }
                        
                    }
                    echo '1';
                }else{
                    echo '0';
                }
            }else{
                echo '0';
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