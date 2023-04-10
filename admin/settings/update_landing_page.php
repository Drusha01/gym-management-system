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
            if(isset($_POST['title'])  && isset($_POST['landing_page_id']) && intval($_POST['landing_page_id'])>0){
                // 
                $title = trim($_POST['title']);

                require_once('../../classes/landing_page.class.php');
                $landing_pageObj = new landing_page();
                if($landing_page_data = $landing_pageObj->fetch_details($_POST['landing_page_id'])){
                    $landing_page_data['landing_page_title']=$title;
                }else{
                    echo '0';
                    return;
                }
            }else{
                echo '0';
                return;
            }
            if(isset($_FILES['file'])){
                $type = array('png', 'bmp', 'jpg');

                $size = (1024 * 1024) * 5; // 2 mb
                if (validate_file($_FILES, 'file', $type, $size)) {
                    if($landing_page_data['landing_page_type_details']=='Carousel'){
                        $website_file_dir = dirname(__DIR__,2) . '/img/carousel/';
                        $website_file_dir_original =$website_file_dir. 'original/';
                        $website_file_resized = $website_file_dir.'carousel-resized/';
                    }else if($landing_page_data['landing_page_type_details']=='Weights Room'){
                        $website_file_dir = dirname(__DIR__,2) . '/img/Weights/';
                        $website_file_dir_original =$website_file_dir. 'original/';
                        $website_file_resized = $website_file_dir.'Weights-resized/';
                    }else if($landing_page_data['landing_page_type_details']=='Function Room'){
                        $website_file_dir = dirname(__DIR__,2) . '/img/Function/';
                        $website_file_dir_original =$website_file_dir. 'original/';
                        $website_file_resized = $website_file_dir.'Function-resized/';
                    }

                    if(!is_dir($website_file_dir)){
                        // create directory
                        mkdir($website_file_dir);
                    }
                    // check if the folder exist  
                    if(!is_dir($website_file_dir_original)){
                        // create directory
                        mkdir($website_file_dir_original);
                    }
                    $extension = getFileExtensionfromFilename($_FILES['file']['name']);
                    $filename = md5($_FILES['file']['name']).'.'.$extension;
                    $counter = 0;
                    // only move if the filename is unique
                    while(file_exists($website_file_dir_original.$filename)){
                        $counter++;
                        $filename = md5($_FILES['file']['name'].$counter).'.'.$extension;
                    }
                    switch($extension){
                        case 'png':
                            $img = imagecreatefrompng($_FILES['file']['tmp_name']);
                            // convert jpeg
                            imagejpeg($img,$website_file_dir_original.$filename,100);
                            break;
                        case 'bmp':
                            $img = imagecreatefrompng($_FILES['file']['tmp_name']);
                            // convert jpeg
                            imagejpeg($img,$website_file_dir_original.$filename,100);
                            break;
                        case 'jpg':
                            move_uploaded_file($_FILES['file']['tmp_name'], $website_file_dir_original.$filename);
                            break;
                    }
                    // check if the profile-resize folder exist
                    if(!is_dir($website_file_resized)){
                        // create directory
                        mkdir($website_file_resized);
                    }
                    // resize file
                
                    // // profile display
                    $result = resizeImage_2($website_file_dir_original,$website_file_resized,$filename,$filename,80,1920,1080);
                    if($result){
                        if($landing_page_data['landing_page_type_details']=='Carousel'){
                            $original_file_path = dirname(__DIR__,2) . '/img/carousel/original/'.$landing_page_data['landing_page_file'];
                            $resize_file_path = dirname(__DIR__,2) . '/img/carousel/carousel-resized/'.$landing_page_data['landing_page_file'];
                        }else if($landing_page_data['landing_page_type_details']=='Weights Room'){
                            $original_file_path = dirname(__DIR__,2) . '/img/Weights/original/'.$landing_page_data['landing_page_file'];
                            $resize_file_path = dirname(__DIR__,2) . '/img/Weights/Weights-resized/'.$landing_page_data['landing_page_file'];
                        }else if($landing_page_data['landing_page_type_details']=='Function Room'){
                            $original_file_path = dirname(__DIR__,2) . '/img/Function/original/'.$landing_page_data['landing_page_file'];
                            $resize_file_path = dirname(__DIR__,2) . '/img/Function/Function-resized/'.$landing_page_data['landing_page_file'];
                        }
                        $original_file = file_exists($original_file_path);
                        $resize_file = file_exists($resize_file_path);
                        if($original_file || $resize_file){
                            if($original_file){
                                unlink($original_file_path);
                            }
                            if($resize_file){
                                unlink($resize_file_path);
                            }
                            $landing_page_data['landing_page_file'] = $filename;
                        }else{
                            echo '0';
                        }
                    }
                }
            } 
            
            if($landing_page_data){
                // update info
                if($landing_pageObj->update($landing_page_data['landing_page_title'],$landing_page_data['landing_page_file'],$landing_page_data['landing_page_id'])){
                    echo json_encode($landing_page_data);
                }
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
