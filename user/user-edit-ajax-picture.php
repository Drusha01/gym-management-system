<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';

if(isset($_SESSION['admin_id'])){
    header('location:../admin/admin_control_log_in.php');
}
// check if we are logged in
if(isset($_SESSION['user_id'])){
    // check if the user is active
    if($_SESSION['user_status_details'] =='active'){
        // do nothing
            $userObj = new users;
            $valid_id = false;
            if (isset($_FILES['valid_id'])) {
               
                $type = array('png', 'bmp', 'jpg');
                $size = (1024 * 1024) * 5; // 2 mb
                if (validate_file($_FILES, 'valid_id', $type, $size)) {
                    $valid_id_dir = dirname(__DIR__, 1) . '/img/valid-id/';
                    // check if the folder exist  
                    if(!is_dir($valid_id_dir)){
                        // create directory
                        mkdir($valid_id_dir);
                    }
                    $extension = getFileExtensionfromFilename($_FILES['valid_id']['name']);
                    $filename = md5($_FILES['valid_id']['name']).'.'.$extension;
                    $counter = 0;
                    // only move if the filename is unique
                    while(is_dir($filename)){
                        $counter++;
                        $filename = md5($_FILES['valid_id']['name']).$counter.'.'.$extension;
                    }
                    // move file
                    if (move_uploaded_file($_FILES['valid_id']['tmp_name'],$valid_id_dir.$filename )) {
                        $valid_id = true;
                        
                        // change valid id photo in db
                        $userObj->setuser_valid_id_photo($filename);
                        // echo 'moved';
                
                        // resize file?
                    }
                }
            }
            
            $profile_pic = false;
            // check the profile picture file upload
            if (isset($_FILES['profilepic'])) {
                
                $type = array('png', 'bmp', 'jpg');
                $size = (1024 * 1024) * 5; // 2 mb
                if (validate_file($_FILES, 'profilepic', $type, $size)) {
                    $profilepic_dir = dirname(__DIR__, 1) . '/img/profile/';
                    // check if the folder exist  
                    if(!is_dir($profilepic_dir)){
                        // create directory
                        mkdir($profilepic_dir);
                    }
                    $extension = getFileExtensionfromFilename($_FILES['profilepic']['name']);
                    $filename = md5($_FILES['profilepic']['name']);
                    $counter = 0;
                    // only move if the filename is unique
                    while(file_exists($profilepic_dir.$filename.'.jpg')){
                        $counter++;
                        $filename = md5($_FILES['profilepic']['name'].$counter);
                    }
                    switch($extension){
                        case 'png':
                            $img = imagecreatefrompng($_FILES['profilepic']['tmp_name']);
                            // convert jpeg
                            imagejpeg($img,$profilepic_dir.$filename.'.jpg',100);
                            break;
                        case 'bmp':
                            $img = imagecreatefrompng($_FILES['profilepic']['tmp_name']);
                            // convert jpeg
                            imagejpeg($img,$profilepic_dir.$filename.'.jpg',100);
                            break;
                        case 'jpg':
                            move_uploaded_file($_FILES['profilepic']['tmp_name'], $profilepic_dir.$filename.'.jpg');
                            break;
                    }
                
                    $userObj->setuser_profile_picture($filename.'.jpg');
                
                    $profile_resize_dir = dirname(__DIR__, 1) . '/img/profile-resize/';
                    $profile_thumbnail_dir = dirname(__DIR__, 1) . '/img/profile-thumbnail/';
                    // check if the profile-resize folder exist
                    if(!is_dir($profile_resize_dir)){
                        // create directory
                        mkdir($profile_resize_dir);
                    }
                    // check if the resize folder thumbnail
                    if(!is_dir($profile_thumbnail_dir)){
                        // create directory
                        mkdir($profile_thumbnail_dir);
                    }
                    // resize file
                
                    // profile display
                    $result = resizeImage($profilepic_dir,$profile_resize_dir,$filename.'.jpg',$filename,80,500,500);
                    if($result){
                        //echo 'error resize 500x500 <br>';
                    }
                    // thumbnail
                    $result = resizeImage($profilepic_dir,$profile_thumbnail_dir,$filename.'.jpg',$filename,80,150,150);
                    if($result){
                        //echo 'error resize 150x150 <br>';
                    }
                    $profile_pic = true;
                }
            }
            if($profile_pic || $valid_id){
                // update data in database
                $userObj->setuser_id($_SESSION['user_id']);
                $update_result = array();
                if($valid_id){
                    if($userObj->update_valid_id()){
                        
                        // delete the old file if not the default
                        if($_SESSION['user_valid_id_photo'] != 'default.png' && unlink(dirname(__DIR__, 1) . '/img/valid-id/'.$_SESSION['user_valid_id_photo'])){
                            // update session
                            $_SESSION['user_valid_id_photo'] = $userObj->getuser_valid_id_photo();
                            $update_result['valid_id'] = 'saved';
                            $update_result['valid_id_src'] = $userObj->getuser_valid_id_photo();
                        }else{
                            $_SESSION['user_valid_id_photo'] = $userObj->getuser_valid_id_photo();
                            $update_result['valid_id'] = 'saved';
                            $update_result['valid_id_src'] = $userObj->getuser_valid_id_photo();
                        }
                        
                        
                        
                        
                    }else{
                        $update_result['valid_id'] = null;
                    }
                }
                if($profile_pic){
                    if($userObj->update_profile_pic()){
                        
                        // delete the old file
                        if ( $_SESSION['user_profile_picture'] != 'default.png' && unlink(dirname(__DIR__, 1) . '/img/profile/' . $_SESSION['user_profile_picture']) && unlink(dirname(__DIR__, 1) . '/img/profile-resize/' . $_SESSION['user_profile_picture']) && unlink(dirname(__DIR__, 1) . '/img/profile-thumbnail/' . $_SESSION['user_profile_picture'])) {
                            // update session
                            $_SESSION['user_profile_picture'] = $userObj->getuser_profile_picture();
                            $update_result['profile_picture'] = 'saved';
                            $update_result['profile_picture_src'] = $userObj->getuser_profile_picture();
                            
                        }else{
                            $_SESSION['user_profile_picture'] = $userObj->getuser_profile_picture();
                            $update_result['profile_picture'] = 'saved';
                            $update_result['profile_picture_src'] = $userObj->getuser_profile_picture();
                        }
                    }else{
                        $update_result['profile_picture'] = null;
                    }
                }
                echo json_encode($update_result);
                return;
            }
            echo '0';
        
    }else if($_SESSION['user_status_details'] =='inactive'){
        // handle inactive user details
    }else if($_SESSION['user_status_details'] =='deleted'){
        // handle deleted user details
    }
} else {
  // go to login page
  header('location:../login/log-in.php');
}


?>




