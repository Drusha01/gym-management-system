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
        if(isset($_SESSION['admin_payment_restriction_details']) && $_SESSION['admin_payment_restriction_details'] == 'Modify'){
            if(isset($_GET['subscription_id']) && isset($_GET['type']) && isset($_GET['discount'])){
                require_once '../../classes/subscriptions.class.php';

                $subscriptionsObj = new subscriptions();
                if($_GET['type'] == 'fixedpercent'){
                    // get sub details
                    if((floatval($_GET['discount'])/100)>0 && (floatval($_GET['discount'])/100)<1 ){
                        if($subscriptionsObj->update_percentage_discount($_GET['subscription_id'],(floatval($_GET['discount'])/100))){
                            echo '1';
                        }else{
                            echo '0';
                        }
                    }else{
                        echo '0';
                    }
                }else if($_GET['type'] == 'fixeddisc'){
                    if(floatval($_GET['discount'])>0){
                        if($subscriptionsObj->update_fixed_discount($_GET['subscription_id'],$_GET['discount'])){
                            echo '1';
                        }else{
                            echo '0';
                        }
                    }else{
                        echo '0';
                    }
                }else if($_GET['type'] == 'remove'){
                    if($subscriptionsObj->update_percentage_discount($_GET['subscription_id'],0)){
                        echo '1';
                    }else{
                        echo '0';
                    }   
                }else{
                    echo '0 ';
                }

            }else{
                echo '0';
            }
        }else if(isset($_SESSION['admin_payment_restriction_details']) && $_SESSION['admin_payment_restriction_details'] == 'Read-Only'){
                
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