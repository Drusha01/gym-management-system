<?php 

// check if we are subscribed
if(isset($_POST['user_id']) && intval($_POST['user_id'])>0 && isset($_POST['password']) && strlen($_POST['password'])>=12){
    require_once '../../classes/subscriptions.class.php';
    require_once '../../classes/attendances.class.php';
    $subscriptionObj = new subscriptions();
    $attendanceObj = new attendances();
    if($user_data = $subscriptionObj->one_active_subscribed_user($_POST['user_id'])){
        // check if we already time in this day and it also have timout
        if($attedance_data = $attendanceObj->fetch_current_attendance($_POST['user_id'])){
            if(isset($attedance_data['attendance_time_in']) ){
                if($attendanceObj->update($attedance_data['attendance_id'])){
                    echo '1';
                }else{
                    echo '0';
                }
                // time out here
            }
        }else{
            if (password_verify($_POST['password'], $user_data['user_password_hashed'])) {
                if($attendanceObj->insert($_POST['user_id'])){
                    echo '1';
                }else{
                    echo '0';
                }
                return;
            }
        }
    }else{
        echo '0';
    }
    
}else{
    echo '0';
}






?>