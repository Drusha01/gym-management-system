
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
        require_once '../../classes/subscriptions.class.php';
        $subscriptionsObj = new subscriptions();
            
        if($subscription_data =$subscriptionsObj->fetchUserActiveAndPendingSubscription($_POST['user_id'])){
            header('location:user-profile.php?active=Subscription-tab');
            exit('already availed');
        }

        if(isset($_POST['gym_use_id']['offer_id']) && isset($_POST['gym_use_multiplier']) && intval($_POST['gym_use_multiplier'])>0 && isset($_POST['user_id']) && intval($_POST['user_id'])>0){
            
            require_once '../../classes/offers.class.php';
            require_once '../../classes/trainers.class.php';
            $offersObj = new offers();
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
                if($subscriptionsObj->insert_subscription(1,$_POST['user_id'],$gym_use_data['offer_name'],$gym_use_data['type_of_subscription_id'],$gym_use_data['offer_duration'],$gym_use_data['offer_price'],$gym_use_data['offer_duration']*$gym_use_multiplier)){
                    if(isset($locker_use_data)){
                        if(!$subscriptionsObj->insert_subscription($locker_quantity,$_POST['user_id'],$locker_use_data['offer_name'],$locker_use_data['type_of_subscription_id'],$locker_use_data['offer_duration'],$locker_use_data['offer_price'],$locker_use_data['offer_duration']*$locker_multiplier)){
                            exit('locker insert error');
                        }
                    }
                    if(isset($trainer_use_data)){
                        if(!$subscriptionsObj->insert_subscription($trainer_quantity,$_POST['user_id'],$trainer_use_data['offer_name'],$trainer_use_data['type_of_subscription_id'],$trainer_use_data['offer_duration'],$trainer_use_data['offer_price'],$trainer_use_data['offer_duration']*$trainer_multiplier)){
                            exit('trainer insert error');
                        }else{
                            // get subscription id of trainer subs
                            if($trainersub_data = $subscriptionsObj->get_sub_id($_POST['user_id'])){
                                // insert trainers here
                                require_once '../../classes/subscriber_trainers.class.php';

                                $subscriber_trainersObj = new subscriber_trainers();
                                foreach ($trainer_id as $key => $value) {
                                    $subscriber_trainersObj->insert_subscriber_trainers($_POST['user_id'],$value['trainer_id'],$trainersub_data['subscription_id']);
                                }
                            }
                            
                        }
                        // get subscription id of trainer subs
                        
                    }
                    if(isset($programs_use_id)){
                        $counter=0;
                        foreach ($programs_use_id as $key => $value) {
                            if(!$subscriptionsObj->insert_subscription(1,$_POST['user_id'],$value['offer_name'],$value['type_of_subscription_id'],$value['offer_duration'],$value['offer_price'],intval($_POST['programs_multiplier'][$counter]['duration']))){
                                exit('programs insert error');
                            }
                            $counter++;
                        }
                    }
                }else{
                    exit('gym insert error');
                }
                echo '1';
            } 
        }else{
            exit('gym_subscription error');
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


