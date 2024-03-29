<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';

if(isset($_SESSION['admin_id'])){
  header('location:../admin/admin_control_log_in.php');
}
// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if($_SESSION['user_status_details'] =='active'){
    // check what type of user are we
    if($_SESSION['user_type_details'] =='admin'){
      // go to admin
    }else if($_SESSION['user_type_details'] == 'normal'){
      // do nothing
        require_once '../classes/subscriptions.class.php';
        $subscriptionsObj = new subscriptions();
            
        if($subscription_data =$subscriptionsObj->fetchUserActiveAndPendingSubscription($_SESSION['user_id'])){
            header('location:user-profile.php?active=Subscription-tab');
            exit('already availed');
        }

        if(isset($_POST['gym_use_id']['offer_id']) && isset($_POST['gym_use_multiplier']) && intval($_POST['gym_use_multiplier'])>0){
            
            require_once '../classes/offers.class.php';
            require_once '../classes/trainers.class.php';
            require_once '../classes/notifications.class.php';
            require_once '../classes/admins.class.php';
            $adminObj = new admins();
            $offersObj = new offers();
            $notificationObj = new notifications();
            $notification_info = $_SESSION['user_lastname'].', '.$_SESSION['user_firstname'].' '.$_SESSION['user_middlename'].' has availed';
            // check if the gym use id is valid
            if($gym_use_data = $offersObj->fetch_offer($_POST['gym_use_id']['offer_id'])){
                //print_r($gym_use_data);
                $gym_use_offer_id = $_POST['gym_use_id']['offer_id'];
                $gym_use_multiplier =intval($_POST['gym_use_multiplier']);


                // check locker id if it is valid
                if(isset($_POST['locker_use_id']['offer_id']) && isset($_POST['locker_multiplier']) && intval($_POST['locker_multiplier'])>0 && isset($_POST['locker_quantity']) && intval($_POST['locker_quantity'])>0 ){
                    if($locker_use_data = $offersObj->fetch_offer($_POST['locker_use_id']['offer_id'])){
                        $locker_multiplier = intval($_POST['locker_multiplier']);
                        $locker_quantity = intval($_POST['locker_quantity']);
                        //validate duration
                        if($locker_use_data['offer_duration']*intval($_POST['locker_multiplier'])<=$gym_use_data['offer_duration']*$gym_use_multiplier){
                            // validate slot/s
                            // never mind this (just validate this in admin side when the admin will activate the subscription)
                            //print_r($locker_use_data);
                        }else{
                            exit('locker_subscription error');
                        }
                    }
                }

                // check trainer id if it is valid
                if(isset($_POST['trainer_use_id']['offer_id']) && isset($_POST['trainer_multiplier']) && intval($_POST['trainer_multiplier'])>0 && isset($_POST['trainers_id'])){
                    if($trainer_use_data = $offersObj->fetch_offer($_POST['trainer_use_id']['offer_id'])){
                        $trainer_multiplier = intval($_POST['trainer_multiplier']);
                        $trainer_id = $_POST['trainers_id'];
                        // validate duration
                        if($trainer_use_data['offer_duration']*intval($_POST['trainer_multiplier'])<=$gym_use_data['offer_duration']*$gym_use_multiplier){
                            // check trainers id if available
                            $trainer_quantity = 0;
                            foreach ($trainer_id as $key => $value) {
                                $trainerObj = new trainers();
                                if($trainer_data = $trainerObj->fetch_trainer_with_id($value['trainer_id'])){
                                    if($trainer_data['trainer_availability_details'] == 'Available'){
                                        //print_r($value);
                                        $trainer_quantity++;
                                    }else{
                                        exit('trainers_id error');
                                    }
                                }
                            }
                        }else{
                            exit('trainer_subscription error');
                        }
                    }
                }
                //print_r($_POST['programs_multiplier']['0']['duration']);

                if(isset($_POST['programs_use_id'])){
                    $counter=0;
                    $programs_use_id=array();
                    foreach ($_POST['programs_use_id'] as $key => $value) {
                        if(isset($value['offer_id']) && isset($_POST['programs_multiplier'][$counter])&& intval($_POST['programs_multiplier'][$counter])>0){
                            // check program if it is valid
                            if($program_use_data = $offersObj->fetch_offer($value['offer_id'])){
                                array_push($programs_use_id,$program_use_data);
                                // validate duration
                                $program_multiplier =intval($_POST['programs_multiplier'][$counter]['duration']);
                                if($program_multiplier<= $gym_use_data['offer_duration']*$gym_use_multiplier){
                                    //print_r($program_use_data);
                                    // validate slot/s
                                }else{
                                    exit('program_subscription error');
                                }
                            }
                        }
                        $counter++;
                    }              
                }
                
                //print_r($programs_use_id);
                // no errors insert now
                // insert gym
                if($subscriptionsObj->insert_subscription(1,$_SESSION['user_id'],$gym_use_data['offer_name'],$gym_use_data['type_of_subscription_id'],$gym_use_data['offer_duration'],$gym_use_data['offer_price'],$gym_use_data['offer_duration']*$gym_use_multiplier)){
                    $notification_info .= ' gym-use';
                    if(isset($locker_use_data)){
                        $notification_info .= ', locker';
                        if(!$subscriptionsObj->insert_subscription($locker_quantity,$_SESSION['user_id'],$locker_use_data['offer_name'],$locker_use_data['type_of_subscription_id'],$locker_use_data['offer_duration'],$locker_use_data['offer_price'],$locker_use_data['offer_duration']*$locker_multiplier)){
                            exit('locker insert error');
                        }
                    }
                    if(isset($trainer_use_data)){
                        $notification_info .= ', trainer';
                        if(!$subscriptionsObj->insert_subscription($trainer_quantity,$_SESSION['user_id'],$trainer_use_data['offer_name'],$trainer_use_data['type_of_subscription_id'],$trainer_use_data['offer_duration'],$trainer_use_data['offer_price'],$trainer_use_data['offer_duration']*$trainer_multiplier)){
                            exit('trainer insert error');
                        }else{
                            // get subscription id of trainer subs
                            if($trainersub_data = $subscriptionsObj->get_sub_id($_SESSION['user_id'])){
                                // insert trainers here
                                require_once '../classes/subscriber_trainers.class.php';

                                $subscriber_trainersObj = new subscriber_trainers();
                                foreach ($trainer_id as $key => $value) {
                                    $subscriber_trainersObj->insert_subscriber_trainers($_SESSION['user_id'],$value['trainer_id'],$trainersub_data['subscription_id']);
                                }
                            }
                            
                        }
                        // get subscription id of trainer subs
                        
                    }
                    if(isset($programs_use_id)){
                        $counter=0;
                        $notification_info .= ', program';
                        foreach ($programs_use_id as $key => $value) {
                            if(!$subscriptionsObj->insert_subscription(1,$_SESSION['user_id'],$value['offer_name'],$value['type_of_subscription_id'],$value['offer_duration'],$value['offer_price'],intval($_POST['programs_multiplier'][$counter]['duration']))){
                                exit('programs insert error');
                            }
                            $counter++;
                        }
                    }
                }else{
                    exit('gym insert error');
                }

                // insert notification here
                $notification_info .= '.';
                // fetch all admins and admin_id
                if($admin_id_data = $adminObj->fetch_all_admin_id()){
                    foreach ($admin_id_data as $key => $value) {
                        if(!$notificationObj->insert($_SESSION['user_id'],$value['admin_user_id'],'Avail','avail.png', $notification_info)){
                            exit('notification insert error');
                        }
                    }
                    
                }
                
                echo '1';
            } 
        }else{
            exit('gym_subscription error');
        }
    } 
  }else if($_SESSION['user_status_details'] =='inactive'){
    // handle inactive user details
  }else if($_SESSION['user_status_details'] =='deleted'){
    // handle deleted user details
  }
} else {
  // go to login page
  header('location:../login/log-in.php');
}

?>


