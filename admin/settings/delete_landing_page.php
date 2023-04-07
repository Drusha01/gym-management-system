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
            if(isset($_POST['landing_page_id']) && intval($_POST['landing_page_id'])>0 ){
                require_once('../../classes/landing_page.class.php');
                $landing_pageObj = new landing_page();
                if($landing_page_data = $landing_pageObj->fetch_details($_POST['landing_page_id'])){
                    // delete here now
                    if($landing_pageObj->delete($_POST['landing_page_id'])){
                        // delete the file here
                        if($landing_page_data['landing_page_type_details']=='Carousel'){
                            if(unlink(dirname(__DIR__,2) . '/img/carousel/original/'.$landing_page_data['landing_page_file']) && unlink(dirname(__DIR__,2) . '/img/carousel/carousel-resized/'.$landing_page_data['landing_page_file'])){
                                echo '1';
                            }else{
                                echo '0';
                            }
                        }else if($landing_page_data['landing_page_type_details']=='Weights Room'){
                            if(unlink(dirname(__DIR__,2) . '/img/Weights/original/'.$landing_page_data['landing_page_file']) && unlink(dirname(__DIR__,2) . '/img/Weights/Weights-resized/'.$landing_page_data['landing_page_file'])){
                                echo '1';
                            }else{
                                echo '0';
                            }
                        }else if($landing_page_data['landing_page_type_details']=='Function Room'){
                            if(unlink(dirname(__DIR__,2) . '/img/Function/original/'.$landing_page_data['landing_page_file']) && unlink(dirname(__DIR__,2) . '/img/Function/Function-resized/'.$landing_page_data['landing_page_file'])){
                                echo '1';
                            }else{
                                echo '0';
                            }
                        }
                    }else{
                        echo '0';
                    }
                }else{
                    echo '0';
                }

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
