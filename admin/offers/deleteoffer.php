
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

        // get offer id
        if(isset($_GET['id'])  && isset($_SESSION['admin_offer_restriction_details']) && $_SESSION['admin_offer_restriction_details'] == 'Modify'){
            // include the db
            require_once '../../classes/offers.class.php';
            require_once '../../tools/functions.php';

            $offersObj = new offers();
            // delete offer data in database
            $result = $offersObj->delete_offer($_GET['id']);
            if($result){
                
                //header('location:offer.php');
                if($_SESSION['admin_user_type_details'] != 'admin'){
                    require_once('../../classes/admins.class.php');
                    require_once('../../classes/notifications.class.php');
                    $adminObj = new admins();
                    $notificationObj = new notifications();
                    if($admin_id_data = $adminObj->fetch_admin_id_of_admins()){
                        foreach ($admin_id_data as $key => $value) {
                            
                            $notification_info ='Staff '.$_SESSION['admin_user_lastname'].', '.$_SESSION['admin_user_firstname'].' '.$_SESSION['admin_user_middlename'].' deleted an offer.';
                            
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
            // admin password??


            

        }else if(isset($_SESSION['admin_offer_restriction_details']) && $_SESSION['admin_offer_restriction_details'] == 'Read-Only'){
            header('location:offer.php');
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