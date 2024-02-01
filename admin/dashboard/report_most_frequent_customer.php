<?php 

    require_once('../../classes/attendances.class.php');
    $attendancesObj = new attendances();

    
    $report_most_frequent_customer = array();
    $report_users = array();
    $report_dates = array();

    $report_users_data = $attendancesObj->report_users();
    $report_dates_data = $attendancesObj->report_dates();
    $report_most_frequent_customer_data = $attendancesObj->report_most_frequent_customer();

    foreach ($report_users_data as $key => $value_user) {
        array_push($report_users,array(
            'user_id'=>$value_user['user_id'],
            'user_fullname'=>$value_user['user_fullname']));

    }

    foreach ($report_dates_data as $key => $value_date) {
        array_push($report_dates,array(
            'attendance_time_out'=>$value_date['date(attendance_time_out)']));

    }
    foreach ($report_most_frequent_customer_data as $key => $value) {
        array_push($report_most_frequent_customer,array(
            'attendance_date'=>$value['attendance_date'],
            'user_name'=>$value['user_name'],
            'user_fullname'=>$value['user_fullname'],
            'user_id'=>$value['user_id'],
            'time_attended_in_seconds'=>$value['time_attended_in_seconds'],
            'time_attended_in_hours'=>$value['time_attended_in_hours']));

    }

    echo json_encode(array('users'=>$report_users,'dates'=>$report_dates,'report_most_frequent_customer_data'=>$report_most_frequent_customer));
    

    
?>