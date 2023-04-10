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
        if(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Modify'){
            if(isset($_POST['remark_id']) && intval($_POST['remark_id'])>0){
                require_once '../../classes/remarks.class.php';
                $remarksObj = new remarks();
                if($remark_data = $remarksObj->fetch_remark_details($_POST['remark_id'])){

                    // check if we have img
                    if(strlen($remark_data['remark_file'])>0){
                        // check if file exist
                        $remark_original_path = dirname(__DIR__,2) . '/img/remarks/original/'.$remark_data['remark_file'];
                        $remark_resize_path = dirname(__DIR__,2) . '/img/remarks/remarks-resized/'.$remark_data['remark_file'];
                        $remark_original = file_exists($remark_original_path);
                        $remark_resize = file_exists($remark_resize_path);
                        // unlink the file / delete the file
                        if($remark_original || $remark_resize){
                            if($remark_original){
                                unlink($remark_original_path);
                            }
                            if($remark_resize){
                                unlink($remark_resize_path);
                            }
                        }
                    }
                    // delete now the remarm
                    if($remarksObj->delete($_POST['remark_id'])){
                        echo '1';
                    }else{
                        echo '0';
                    }
                }else{
                    echo '0';
                }
            }else{
                echo '0';
            }
        }else if(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Read-Only'){
            header('location:maintenance.php');
        }else{
            header('location:../dashboard/dashboard.php');
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


