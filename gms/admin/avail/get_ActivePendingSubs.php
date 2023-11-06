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
            if(isset($_GET['user_id']) && intval($_GET['user_id'])>0){
                // 
                require_once '../../classes/subscriptions.class.php';
               // header('Content-Type: application/json'); 
                $subscriptionsObj = new subscriptions();
                if($user_subscription_data = $subscriptionsObj->fetchAllSubscriptionPerUser_id('Active','Pending','','','',$_GET['user_id'])){
                    
                    echo json_encode(array('subscriptions'=>$user_subscription_data),JSON_FORCE_OBJECT);
                }
            }else{
                header('location:avail.php?active=subs');
            }
        }elseif(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Read-Only'){
            header('location:avail.php?active=subs');
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
<?php 

