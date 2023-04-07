<?php 
session_start();
if(isset($_SESSION['user_id'])){
    header('location:../user/user-page.php');
}
if(isset($_SESSION['admin_id'])){
    // check admin user details
    if($_SESSION['admin_user_status_details'] == 'active'){
        // do nothing
        if($_SESSION['admin_user_type_details'] != 'admin'){
            header('location:../dashboard/dashboard.php');
        }
        if($_SESSION['admin_user_type_details'] == 'admin'){
            require_once '../../tools/functions.php';
            if(isset($_POST['team_name']) && isset($_POST['position']) && isset($_POST['team_id']) && intval($_POST['team_id'])>0){
                // 
                require_once('../../classes/teams.class.php');
                require_once('../../classes/team_positions.class.php');
                $team_positionsObj = new team_positions();
                $teamsObj = new teams();
                if($team_data = $teamsObj->fetch_with_id($_POST['team_id'])){
                    $team_data['team_name'] = trim($_POST['team_name']);
                    $team_data['team_position_details'] = trim($_POST['position']);
                }else{
                    echo '0';
                    return;
                }
            }
            if(isset($_FILES['file'])){
                $type = array('png', 'bmp', 'jpg');

                $size = (1024 * 1024) * 5; // 2 mb
                if (validate_file($_FILES, 'file', $type, $size)) {
                        $team_file_dir = dirname(__DIR__,2) . '/img/team/';
                        $team_file_dir_original =$team_file_dir. 'original/';
                        $team_file_dir_resized = $team_file_dir.'team-resized/';
                   
                    if(!is_dir($team_file_dir)){
                        // create directory
                        mkdir($team_file_dir);
                    }
                    
                    // check if the folder exist  
                    if(!is_dir($team_file_dir_original)){
                        // create directory
                        mkdir($team_file_dir_original);
                    }
                    $extension = getFileExtensionfromFilename($_FILES['file']['name']);
                    $filename = md5($_FILES['file']['name']).'.'.$extension;
                    $counter = 0;
                    // only move if the filename is unique
                    while(file_exists($team_file_dir_original.$filename)){
                        $counter++;
                        $filename = md5($_FILES['file']['name'].$counter).'.'.$extension;
                    }
                    switch($extension){
                        case 'png':
                            $img = imagecreatefrompng($_FILES['file']['tmp_name']);
                            // convert jpeg
                            imagejpeg($img,$team_file_dir_original.$filename,100);
                            break;
                        case 'bmp':
                            $img = imagecreatefrompng($_FILES['file']['tmp_name']);
                            // convert jpeg
                            imagejpeg($img,$team_file_dir_original.$filename,100);
                            break;
                        case 'jpg':
                            move_uploaded_file($_FILES['file']['tmp_name'], $team_file_dir_original.$filename);
                            break;
                    }
                    // check if the profile-resize folder exist
                    if(!is_dir($team_file_dir_resized)){
                        // create directory
                        mkdir($team_file_dir_resized);
                    }
                    // resize file
                
                    // // profile display
                    $result =resizeImage($team_file_dir_original,$team_file_dir_resized,$filename,$filename,80,500,500);
                    
                    if($result){
                        // update db here
                        
                        if($team_data && unlink(dirname(__DIR__,2) . '/img/team/original/'.$team_data['team_file']) && unlink(dirname(__DIR__,2) . '/img/team/team-resized/'.$team_data['team_file'])){
                            $team_data['team_file'] = $filename;
                        }
                    }
                }else{
                    echo '0';
                }
            }
            $team_positionsObj->insert($team_data['team_position_details']);
            if($teamsObj->update($team_data['team_id'],$team_data['team_position_details'],$team_data['team_name'],$team_data['team_file'])){
                echo json_encode($team_data);
            }else{
                echo '0';
            }
            
        }else{
            // go to dashboard
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
