
<table id="attendance" class="table shadow-sm rounded-3 content-table" style="width: 100%;">
    <thead class="table-dark" >
        <tr>
        <th class="d-lg-none"></th>
        <th class="ps-lg-5">User name</th>
        <th class="ps-lg-5">Full Name</th>
        <th class="text-center">Status</th>
        <th class="text-center">TIME IN</th>
        <th class="text-center">TIME OUT</th>
        </tr>
    </thead>

    <tbody>
        <?php 
        require_once '../../classes/subscriptions.class.php';
        require_once '../../classes/attendances.class.php';
        $subscriptionObj = new subscriptions();
        $attendanceObj = new attendances();
        if($attendance_datas = $attendanceObj->fetch_all_attendances()){
            $counter =1;
            foreach ($attendance_datas as $key => $value) {
                if(!isset($value['time_out'])){
                    $value['time_out'] = '-- -- --';
                    $date1=date_create($value['date_time_in']);
                    $date2=date_create($value['date_now']);
                    $diff=date_diff($date1,$date2);
                    // force time out automatically
                   
                    if($diff->format("%a")){
                        require_once('../../classes/admin_settings.class.php');
                        $settingObj = new admin_settings();
                        // get the force time out from settings
                        $setting_data = $settingObj->fetch_one();
                        // update
                        $attendanceObj->force_time_out($value['attendance_id'],$setting_data['setting_attendance_force_timeout']);
                    }
                }
                $counter++;
            }
        }
        
        if($user_data = $subscriptionObj->active_subscribed_users()){
            
            foreach ($user_data as $key => $value) {
                // check if user has already time in
                if($attendance_data = $attendanceObj->fetch_current_attendance($value['user_id'])){
                    echo ' 
        <tr>
            <td class="d-lg-none"></td>
            <td class="ps-lg-5" id="user_name_'.$value['user_id'].'">'.htmlentities($value['user_name']).'</td>
            <td class="ps-lg-5" id="user_fullname_'.$value['user_id'].'">'.htmlentities($value['user_fullname']).'</td>
            <td class="text-center">Subscribed</td>
            <td class="text-center">'.htmlentities($attendance_data['attendance_time_in']).'</td>
            <td class="text-center"><button class="btn btn-outline-dark btn-sm btn-circle" style="border: none;" data-bs-toggle="modal" data-bs-target="#attendance_time_out"><i class="bx bx-calendar-x align-center"  onclick="time_out_attendance('.$value['user_id'].')"></i></button></td>
        </tr>';
                }else{
                    echo '
        <tr>
            <td class="d-lg-none"></td>
            <td class="ps-lg-5" id="user_name_'.$value['user_id'].'">'.htmlentities($value['user_name']).'</td>
            <td class="ps-lg-5" id="user_fullname_'.$value['user_id'].'">'.htmlentities($value['user_fullname']).'</td>
            <td class="text-center">Subscribed</td>
            <td class="text-center"><button class="btn btn-outline-dark btn-sm btn-circle" style="border: none;" data-bs-toggle="modal" data-bs-target="#attendance_time_in"><i class="bx bx-calendar-check align-center" onclick="time_in_attendance('.$value['user_id'].')"></i></button></td>
            <td class="text-center"> -- -- --</button></td>
        </tr>';
                }
            }
         
        }
        
        ?>
    </tbody>
</table>