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
           
            if(isset($_POST['equipment_id']) && intval($_POST['equipment_id'])>0 && isset($_POST['remarks']) && isset($_POST['remark_equipment_condition_details'])){
                $equipment_id = $_POST['equipment_id'];
                $remark_remarks = trim($_POST['remarks']);
                $remark_equipment_condition_details = trim($_POST['remark_equipment_condition_details']);
                $remark_file = '';
                // check if we have picture
                if(isset($_FILES['file'])){
                    require_once '../../tools/functions.php';
                    $type = array('png', 'bmp', 'jpg');

                    $size = (1024 * 1024) * 5; // 2 mb
                    if (validate_file($_FILES, 'file', $type, $size)) {
                        
                        $remarks_file_dir = dirname(__DIR__,2) . '/img/remarks/';
                        $remarks_file_dir_original =$remarks_file_dir. 'original/';
                        $remarks_file_resized = $remarks_file_dir.'remarks-resized/';
                        
                        
                        if(!is_dir($remarks_file_dir)){
                            // create directory
                            mkdir($remarks_file_dir);
                        }
                        
                        // check if the folder exist  
                        if(!is_dir($remarks_file_dir_original)){
                            // create directory
                            mkdir($remarks_file_dir_original);
                        }
                        $extension = getFileExtensionfromFilename($_FILES['file']['name']);
                        $filename = md5($_FILES['file']['name']).'.'.$extension;
                        $counter = 0;
                        // only move if the filename is unique
                        while(file_exists($remarks_file_dir_original.$filename)){
                            $counter++;
                            $filename = md5($_FILES['file']['name'].$counter).'.'.$extension;
                        }
                        switch($extension){
                            case 'png':
                                $img = imagecreatefrompng($_FILES['file']['tmp_name']);
                                // convert jpeg
                                imagejpeg($img,$remarks_file_dir_original.$filename,100);
                                break;
                            case 'bmp':
                                $img = imagecreatefrompng($_FILES['file']['tmp_name']);
                                // convert jpeg
                                imagejpeg($img,$remarks_file_dir_original.$filename,100);
                                break;
                            case 'jpg':
                                move_uploaded_file($_FILES['file']['tmp_name'], $remarks_file_dir_original.$filename);
                                break;
                        }
                        // check if the resize folder exist
                        if(!is_dir($remarks_file_resized)){
                            // create directory
                            mkdir($remarks_file_resized);
                        }
                        // resize file
                    
                        // 
                        $result = resizeImage_2($remarks_file_dir_original,$remarks_file_resized,$filename,$filename,80,1920,1080);
                        if($result){
                            $remark_file = $filename;
                        }                      
                    }
                }
                require_once '../../classes/remarks.class.php';
                $remarksObj = new remarks();
                // insert db
                if($remarksObj->insert($equipment_id,$remark_equipment_condition_details,$_SESSION['admin_id'],$remark_remarks,$remark_file)){
                    if(!$equipments_data = $remarksObj->fetch_remark_details_with_equipment_id($_POST['equipment_id'])){
                        echo '0';
                        return;
                    }
                    if($_SESSION['admin_user_type_details'] != 'admin'){
                        require_once('../../classes/admins.class.php');
                        require_once('../../classes/notifications.class.php');
                        
                        $adminObj = new admins();
                        $notificationObj = new notifications();
                        if($admin_id_data = $adminObj->fetch_admin_id_of_admins()){
                            foreach ($admin_id_data as $key => $value) {
                                
                                $notification_info ='Staff '.$_SESSION['admin_user_lastname'].', '.$_SESSION['admin_user_firstname'].' '.$_SESSION['admin_user_middlename'].' added a remark on equipment  ('.$equipments_data['equipment_name'].').';
                                
                                if(!$notificationObj->insert($_SESSION['admin_user_id'],$value['user_id'],'Logs','logs.png', $notification_info)){
                                    exit('notification insert error');
                                }
                            }
                        }
                        
                    }
                    echo '1';
                }else{
                    echo '0';
                }
                
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