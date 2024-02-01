<?php 

    require_once('../../classes/subscriber_trainers.class.php');
    $subscriber_trainersObj = new subscriber_trainers();

    
    $report_most_availed_trainer = array();

    if($report_most_availed_trainer_data = $subscriber_trainersObj->report_most_availed_trainer()){
        
        foreach ($report_most_availed_trainer_data as $key => $value) {
            array_push($report_most_availed_trainer,array(
                'user_fullname'=>$value['user_fullname'],
                'subscriber_trainers_trainer_count'=>$value['subscriber_trainers_trainer_count']));
        }

        echo json_encode($report_most_availed_trainer);
    }else{
        echo 'No Data';
    }
    

    
?>