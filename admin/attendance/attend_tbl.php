<?php 
session_start();
if(isset($_SESSION['admin_attendance_restriction_details']) && $_SESSION['admin_attendance_restriction_details'] == 'Modify'){

}elseif(isset($_SESSION['admin_attendance_restriction_details']) && $_SESSION['admin_attendance_restriction_details'] == 'Read-Only'){
    //
}else{
    //do not load the page
    header('location:../dashboard/dashboard.php');
}
?>
<table id="attendance-table" class="table table-borderless table-striped" style="width:100%; border: 3px solid black;">
    <thead class="table-dark" >
        <tr>
        <th class="d-lg-none"></th>
        <th class="text-center d-none d-sm-table-cell">#</th>
        <th class="w-25">USERNAME</th>
        <th class="w-25">FULL NAME</th>
        <th class="text-center">TIME IN</th>
        <th class="text-center">TIME OUT</th>
        <th class="text-center">DATE</th>
        <?php 
            if(isset($_SESSION['admin_attendance_restriction_details']) && $_SESSION['admin_attendance_restriction_details'] == 'Modify'){
                echo '<th class="text-center">ACTION</th>';
            }
        ?>
        
        </tr>
    </thead>
    <tbody>
    <?php 
        require_once '../../classes/attendances.class.php';

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
        if($attendance_datas = $attendanceObj->fetch_all_attendances()){
            $counter =1;
            foreach ($attendance_datas as $key => $value) {
                if(!isset($value['time_out'])){
                    $value['time_out'] = '-- -- --';
                    $date1=date_create($value['date_time_in']);
                    $date2=date_create($value['date_now']);
                    $diff=date_diff($date1,$date2);
                    // force time out automatically
                   
                }
                echo '
    <tr>
        <th class="d-lg-none"></th>
        <td class="text-center d-none d-sm-table-cell">'.$counter.'</td>
        <td id="user_name_'.$value['attendance_id'].'">'.htmlentities($value['user_name']).'</td>
        <td id="user_fullname_'.$value['attendance_id'].'">'.htmlentities($value['user_fullname']).'</td>
        <td class="text-center">'.htmlentities($value['time_in']).'</td>
        <td class="text-center">'.htmlentities($value['time_out']).'</td>
        <td class="text-center">'.htmlentities(date_format(date_create($value['date_time_in']), "F d,Y")).'</td>';
        if(isset($_SESSION['admin_attendance_restriction_details']) && $_SESSION['admin_attendance_restriction_details'] == 'Modify'){
            echo '<td class="text-center"><button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete" onclick="delete_attendance('.htmlentities($value['attendance_id']).')">Delete</button></td>
            </tr>';
        }
        
                $counter++;
            }
        }
        
        ?>
    </tbody>
</table>