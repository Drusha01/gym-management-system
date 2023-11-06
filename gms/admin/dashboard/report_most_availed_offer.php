<?php 

    require_once('../../classes/subscriptions.class.php');
    $subscriptionsObj = new subscriptions();

    
    $report_most_availed_offer = array();

    if($report_most_availed_offer_data = $subscriptionsObj->report_most_availed_offer()){
        
        foreach ($report_most_availed_offer_data as $key => $value) {
            array_push($report_most_availed_offer,array(
                'subscription_offer_name'=>$value['subscription_offer_name'],
                'subscription_quantity'=>$value['subscription_quantity']));
        }

        echo json_encode($report_most_availed_offer);
    }else{
        echo 'No Data';
    }
    

    
?>