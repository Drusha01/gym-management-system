<?php 

    require_once('../../classes/subscriptions.class.php');
    $subscriptionsObj = new subscriptions();

    


    if($status_of_subscriptions = $subscriptionsObj->status_of_subscriptions()){
        
        echo json_encode($status_of_subscriptions);
    }else{
        echo 'No Data';
    }
    

    
?>