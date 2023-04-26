<?php 

    require_once('../../classes/subscriptions.class.php');
    $subscriptionsObj = new subscriptions();

    
    $report_subscriptions = array();

    if($report_subscription_data = $subscriptionsObj->report_subscriptions()){
        
        foreach ($report_subscription_data as $key => $value) {
            if(!isset($value['subscription_count_per_day'])){
                $value['subscription_count_per_day'] =0;
            }
            if(!isset($value['program_subscriptions_count'])){
                $value['program_subscriptions_count'] =0;
            }
            if(!isset($value['gym_subscriptions_count'])){
                $value['gym_subscriptions_count'] =0;
            }
            if(!isset($value['locker_subscriptions_count'])){
                $value['locker_subscriptions_count'] =0;
            }
            if(!isset($value['trainer_subscriptions_count'])){
                $value['trainer_subscriptions_count'] =0;
            }
            array_push($report_subscriptions,array(
                'subscription_count_per_day'=>$value['subscription_count_per_day'],
                'subscription_start_date'=>date_format(date_create($value['subscription_start_date']), "F d, Y"),
                'program_subscriptions_count'=>$value['program_subscriptions_count'],
                'gym_subscriptions_count'=>$value['gym_subscriptions_count'],
                'locker_subscriptions_count'=>$value['locker_subscriptions_count'],
                'trainer_subscriptions_count'=>$value['trainer_subscriptions_count']));
        }

        echo json_encode($report_subscriptions);
    }else{
        echo 'No Data';
    }
    

    
?>