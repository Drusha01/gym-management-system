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
            if(isset($_GET['user_id'])){
                // 
                require_once '../../classes/subscriptions.class.php';

                $subscriptionsObj = new subscriptions();

                
                if($locker_subscription_data = $subscriptionsObj->fetchUserLockerPendingSubscription($_GET['user_id'])){
                    // get activated locker subscription
                    // get number of lockers
                    require_once('../../classes/admin_settings.class.php');
                    require_once('../../classes/lockers.class.php');
                    $lockerObj = new lockers();
                    $settingObj = new admin_settings();
                    $setting_data = $settingObj->fetch_one();
                    if($subscription_data = $subscriptionsObj->get_number_of_locker_use()){
                        if($setting_data){
                            // first update the lockers
                            if($invalid_lockers = $lockerObj->fetch_invalid_lockers()){
                                foreach ($invalid_lockers as $key => $invalid_locker_item) {
                                    $lockerObj->delete($invalid_locker_item['locker_id']);
                                }
                            }
                            if(($setting_data['setting_num_of_lockers'] - $subscription_data['number_of_locker_use'])>=$locker_subscription_data['subscription_quantity']){
                                $user_number_of_lockers = $locker_subscription_data['subscription_quantity'];
                                
                                $locker_uid=1;
                                $counter =0;
                                $lockerlist = $lockerObj->fetch_all_lockers();
                                while($counter<$user_number_of_lockers){
                                    $valid =true;
                                    foreach ($lockerlist as $key => $locker_list_item) {
                                        if($locker_list_item['locker_UID'] == $locker_uid){
                                            $valid =false;
                                        }
                                    }
                                    // insert the id here 
                                    if($valid){
                                        if($lockerObj->insert($locker_subscription_data['subscription_id'],$locker_uid)){
                                            $counter++;
                                           
                                        }
                                    }
                                    $locker_uid++;
                                }
                            }else{
                                echo 'lockers not available';
                            }
                        }
                    }
                }
                
                if($subscriptionsObj->activate_pending_subscription($_GET['user_id'])){
                    // notification

                    require_once '../../classes/notifications.class.php';
                    $notificationObj = new notifications();
                    $notification_info ='Your Availed Subscriptions is now active. ';
                    if(!$notificationObj->insert($_SESSION['admin_user_id'],$_GET['user_id'],'Activate','activated.png', $notification_info)){
                        exit('notification insert error');
                    }
                    if(!$customer_details = $subscriptionsObj->get_user_details_with_user_id($_GET['user_id'])){
                        echo 'error getting customer data';
                        return;
                    }

                    if($_SESSION['admin_user_type_details'] != 'admin'){
                        require_once('../../classes/admins.class.php');
                        require_once('../../classes/notifications.class.php');
                        $adminObj = new admins();
                        $notificationObj = new notifications();
                        if($admin_id_data = $adminObj->fetch_admin_id_of_admins()){
                            foreach ($admin_id_data as $key => $value) {
                                
                                $notification_info ='Staff '.$_SESSION['admin_user_lastname'].', '.$_SESSION['admin_user_firstname'].' '.$_SESSION['admin_user_middlename'].' activated a subscription of '.$customer_details['user_fullname'].'.';
                                
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