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
            if(isset($_GET['trainer_id']) && isset($_GET['trainer_status']) ){
                // include the db
                require_once '../../classes/trainers.class.php';
                require_once '../../classes/subscriber_trainers.class.php';
                require_once '../../classes/admins.class.php';
                require_once '../../tools/functions.php';
    
                
                // admin password??
                $trainerObj = new trainers();
                if($trainerObj->update_trainer_availability($_GET['trainer_id'],$_GET['trainer_status'])){
                    // notification
                    require_once '../../classes/notifications.class.php';
                    $notificationObj = new notifications();
                    
                    $subscriber_trainersObj = new subscriber_trainers();
                    if($subscriber_ids = $subscriber_trainersObj->fetch_subscriber_trainers_subscriber_ids($_GET['trainer_id'])){
                        
                        foreach ($subscriber_ids as $key => $value) {
                            
                            $notification_info ='Your trainer '.htmlentities($value['user_fullname']).' is '.htmlentities(strtolower($_GET['trainer_status'])).' for today. ';
                            if($_GET['trainer_status'] == 'Available'){
                                if(!$notificationObj->insert($_SESSION['admin_user_id'],$value['subscriber_trainers_subscriber_id'],'Trainer','trainer.png', $notification_info)){
                                    exit('notification insert error');
                                }
                            }else{
                                if(!$notificationObj->insert($_SESSION['admin_user_id'],$value['subscriber_trainers_subscriber_id'],'Trainer','trainer_not.png', $notification_info)){
                                    exit('notification insert error');
                                }
                            }
                            
                        }
                        
                    }

                    

                    require_once('../../classes/admins.class.php');
                    require_once('../../classes/notifications.class.php');
                    $adminObj = new admins();
                    $notificationObj = new notifications();
                    if($admin_id_data = $adminObj->fetch_admin_id_of_admins()){
                        foreach ($admin_id_data as $key => $value) {
                            
                            $notification_info ='Staff '.$_SESSION['admin_user_lastname'].', '.$_SESSION['admin_user_firstname'].' '.$_SESSION['admin_user_middlename'].' modified ('.htmlentities(strtolower($_GET['trainer_status'])).') the trainer account.';
                            
                            if(!$notificationObj->insert($_SESSION['admin_user_id'],$value['user_id'],'Logs','logs.png', $notification_info)){
                                exit('notification insert error');
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