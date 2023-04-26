<?php
// start session
session_start();

// includes


// check if we are normal user
if(isset($_SESSION['user_id'])){
    header('location:../user/user-page.php');
}


if(isset($_SESSION['admin_id'])){
    // check admin user details
    if($_SESSION['admin_user_status_details'] == 'active'){
        // do nothing 
        require_once '../../classes/notifications.class.php';
        $notificationObj = new notifications();

        if($notification_data = $notificationObj->get_notifications($_SESSION['admin_user_id'])){
            foreach ($notification_data as $key => $value) {
                if($value['notification_is_read'] ==0){
                    
                    echo '
        <tr class="bg-danger bg-opacity-10">
            <td class="col-11 ps-3 ps-lg-4">
                <div class="d-flex align-items-center mt-1">
                <img
                    src="../../images/icons_notif/'.htmlentities($value['notification_icon_details']).'"
                    alt=""
                    style="width: 45px; height: 45px"
                    />
                    <div class="fw-bold ms-4">
                        <div class="text-truncate">'.htmlentities($value['notification_type_details']).'</div>
                        <div class="fw-light">'.htmlentities($value['notification_info']).'</div>
                    </div>
                </div>
            </td>
            <td class="col-1">
                <span class="d-flex justify-content-end">
                    <div class="btn-group rounded ms-5">
                        <button type="button" class="btn btn-light btn-sm dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <button class="dropdown-item" type="button" onclick="delete_notification('.$value['notification_id'].')" id=""><i class="bx bxs-trash:" ></i> Delete</button>
                            <button class="dropdown-item" type="button" onclick="mark_as_read_notification('.$value['notification_id'].')" id=""><i class="bx bx-book-reader" ></i> Mark as Read</button>
                        </ul>
                    </div>
                    <br/>
                </span>
                <div class="text-end text-muted pt-1">'.htmlentities($value['notification_date_created']).'</div>
            </td>
        </tr>';
                }else{
                    echo '
        <tr class="">
            <td class="col-11 ps-3 ps-lg-4">
                <div class="d-flex align-items-center mt-1">
                <img
                    src="../../images/icons_notif/'.htmlentities($value['notification_icon_details']).'"
                    alt=""
                    style="width: 45px; height: 45px"
                    />
                    <div class="fw-bold ms-4">
                        <div class="text-truncate">'.htmlentities($value['notification_type_details']).'</div>
                        <div class="fw-light">'.htmlentities($value['notification_info']).'</div>
                    </div>
                </div>
            </td>
            <td class="col-1">
                <span class="d-flex justify-content-end">
                    <div class="btn-group rounded ms-5">
                        <button type="button" class="btn btn-light btn-sm dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <button class="dropdown-item" type="button" onclick="delete_notification('.$value['notification_id'].')" id=""><i class="bx bxs-trash:" ></i> Delete</button>
                        </ul>
                    </div>
                    <br/>
                </span>
                <div class="text-end text-muted pt-1">'.htmlentities($value['notification_date_created']).'</div>
            </td>
        </tr>';
                }
        
            }
        }

        
    }else if($_SESSION['admin_user_status_details'] == 'inactive'){
        // do this
    }else if($_SESSION['admin_user_status_details'] == 'deleted'){
        // go to deleted user page
    }

}else{
    // go to admin login
    header('location:../admin_control_log_in.php');
}

?>