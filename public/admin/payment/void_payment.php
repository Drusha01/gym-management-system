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
            if(isset($_POST['password']) && strlen($_POST['password'])>=12 && isset($_POST['user_id']) && intval($_POST['user_id'])>0 && isset($_POST['type']) && isset($_POST['void_payment']) && intval($_POST['void_payment'])>0){
                
                require_once('../../classes/subscriptions.class.php');
                require_once('../../classes/admins.class.php');
                require_once('../../classes/payments.class.php');
                $subscriptionsObj = new subscriptions();
                $adminObj = new admins();
                $paymentsObj = new payments();
                if($admin_data = $adminObj->get_admin_password($_SESSION['admin_id'])){
                    if (password_verify($_POST['password'], $admin_data['user_password_hashed'])) {
                        if($payments_data = $subscriptionsObj->fetch_active_subs_payment($_POST['user_id'])){
                            $error = false;

                            $void_payment = $_POST['void_payment'];
                            if($_POST['type'] =='voidfixed'){
                                foreach ($payments_data as $key => $value) {
                                    // get subscriptions
                                    if($void_payment>0){
                                        $balance = ($value['subscription_paid_amount']);
                                        if($void_payment-$balance>=0){
                                            if(!$subscriptionsObj->void_payment($value['subscription_id'],$balance) || !$paymentsObj->insert(-$balance,$value['subscription_id'],'Void payment')){
                                                $error = true;
                                            }
                                        }else{
                                            if(!$subscriptionsObj->void_payment($value['subscription_id'],$void_payment) || !$paymentsObj->insert(-$void_payment,$value['subscription_id'],'Void payment')){
                                                $error = true;
                                            }
                                            
                                        }     
                                        $void_payment -=$balance; 
                                    }else{
                                        break;
                                    }
                                }
                                if($void_payment>0){
                                    echo $void_payment;
                                }
                            }else{
                                // percentage
                                if(floatval($_POST['void_payment']) > 0 && floatval($_POST['void_payment']) <= 100){

                                    $percentage = $_POST['void_payment'];
                                    // get total amount
                                    $total_amount = 0 ;
                                    foreach ($payments_data as $key => $value) {
                                        $total_amount += (($value['subscription_price']*$value['subscription_quantity']*($value['subscription_total_duration']/$value['subscription_duration']))+$value['subscription_penalty_due']-$value['subscription_discount']);
                                    }
                                    $void_payment = floatval($percentage/100) * $total_amount;
                                    foreach ($payments_data as $key => $value) {
                                        // get subscriptions
                                        if($void_payment>0){
                                            $balance = ($value['subscription_paid_amount']);
                                            if($void_payment-$balance>=0){
                                                if(!$subscriptionsObj->void_payment($value['subscription_id'],$balance) || !$paymentsObj->insert(-$balance,$value['subscription_id'],'Void payment')){
                                                    $error = true;
                                                }
                                            }else{
                                                if(!$subscriptionsObj->void_payment($value['subscription_id'],$void_payment) || !$paymentsObj->insert(-$void_payment,$value['subscription_id'],'Void payment')){
                                                    $error = true;
                                                }
                                                
                                            }     
                                            $void_payment -=$balance; 
                                        }else{
                                            break;
                                        }
                                    }
                                    if($void_payment>0){
                                        echo $void_payment;
                                    }                   
                                }else{
                                    $error = true;
                                }   
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