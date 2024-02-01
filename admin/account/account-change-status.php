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
            if(isset($_GET['user_id']) && isset($_GET['user_status_details']) ){
                // include the db
                require_once '../../classes/users.class.php';
                require_once '../../classes/admins.class.php';
                require_once '../../tools/functions.php';
    
                
                // admin password??
                $adminObj = new admins();
    
                if(!$adminObj->check_admin($_GET['user_id'])){
                    $userObj = new users();
    
                    if($userObj->update_user_status($_GET['user_id'],$_GET['user_status_details'])){
                        $userObj->setuser_id($_GET['user_id']);
                        if(!$users_data = $userObj->get_user_details()){
                            echo '0';
                            return;
                        }

                        require_once('../../classes/admins.class.php');
                        require_once('../../classes/notifications.class.php');
                        $adminObj = new admins();
                        $notificationObj = new notifications();
                        if($admin_id_data = $adminObj->fetch_admin_id_of_admins()){
                            foreach ($admin_id_data as $key => $value) {
                                if($_SESSION['admin_user_id']!=$value['user_id']){
                                    $notification_info ='Staff '.$_SESSION['admin_user_lastname'].', '.$_SESSION['admin_user_firstname'].' '.$_SESSION['admin_user_middlename'].' modified ('.$_GET['user_status_details'].') the customer account of ('.$users_data['user_lastname'].', '.$users_data['user_firstname'].' '.$users_data['user_middlename'].').';
                                    
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