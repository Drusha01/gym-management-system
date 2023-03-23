<?php 

    require_once('../../classes/subscriptions.class.php');
    $subscriptionsObj = new subscriptions();

    
    $sales_and_stats = array();

    if($years_data = $subscriptionsObj->fetch_distinct_years()){
        foreach ($years_data as $key => $years_value) {
            if($net_at_this_year_data = $subscriptionsObj->fetch_sales_at_year($years_value['YEAR'])){
                foreach ($net_at_this_year_data as $key => $net_at_this_year_value) {
                    array_push($sales_and_stats,array('YEAR'=>$years_value['YEAR'],'Sales_Revenue'=>$net_at_this_year_value['Sales_Revenue']));
                }
                
            }
            
        }
        echo json_encode($sales_and_stats);
    }else{
        echo 'No Data';
    }
    

    
?>