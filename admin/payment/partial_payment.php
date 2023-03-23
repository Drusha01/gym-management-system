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
            
            if(isset($_POST['password']) && strlen($_POST['password'])>=12 && isset($_POST['user_id']) && intval($_POST['user_id'])>0 && isset($_POST['type']) && isset($_POST['partial_payment']) && intval($_POST['partial_payment'])>0){
                
                require_once('../../classes/subscriptions.class.php');
                require_once('../../classes/admins.class.php');
                $subscriptionsObj = new subscriptions();
                $adminObj = new admins();
                if($admin_data = $adminObj->get_admin_password($_SESSION['admin_id'])){
                    if (password_verify($_POST['password'], $admin_data['user_password_hashed'])) {
                        if($payments_data = $subscriptionsObj->fetch_active_subs_payment($_POST['user_id'])){
                            $error = false;

                            $partial_payment = $_POST['partial_payment'];
                            if($_POST['type'] =='partial_payment_fixed'){
                                foreach ($payments_data as $key => $value) {
                                    // get subscriptions
                                    if($partial_payment>0){
                                        $balance = (($value['subscription_price']*$value['subscription_quantity']*($value['subscription_total_duration']/$value['subscription_duration']))+$value['subscription_penalty_due']-$value['subscription_discount']-$value['subscription_paid_amount']);
                                        if($partial_payment-$balance>=0){
                                            $partial_payment -=$balance;
                                            if(!$subscriptionsObj->full_payment($value['subscription_id'])){
                                                $error = true;
                                            }
                                        }else{
                                            if(!$subscriptionsObj->partial_payment($value['subscription_id'],$partial_payment)){
                                                $error = true;
                                            }
                                            $partial_payment -=$balance;
                                        }      
                                    }else{
                                        break;
                                    }
                                }
                                if($partial_payment>0){
                                    echo $partial_payment;
                                }
                            }else{
                                // percentage
                            }

                            if($error){
                                echo '0';
                            }else{
                                echo '1';
                            }
                        }else{
                            echo '0';
                        }
                    }else{
                        echo '0';
                    }
                }else{
                    echo '0';
                }
            }else{
                echo '0';
            }
        }else if(isset($_SESSION['admin_payment_restriction_details']) && $_SESSION['admin_payment_restriction_details'] == 'Read-Only'){
            header('location:../payment/payment.php');
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