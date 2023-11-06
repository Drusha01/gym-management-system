<?php 

    require_once('../../classes/walk_ins.class.php');
    $walk_insObj = new walk_ins();
    $walk_ins = array();
    if($walk_ins_data = $walk_insObj->dashboard_walkins()){
        foreach ($walk_ins_data as $key => $value) {
            array_push($walk_ins,array('number_of_walkins'=>$value['number_of_walkins'],'walk_in_date'=>date_format(date_create($value['walk_in_date']), "F d, Y"),'walk_in_day'=>$value['walk_in_day']));
        }
        echo json_encode($walk_ins);
        //print_r($walk_ins_data);
    }

    
?>