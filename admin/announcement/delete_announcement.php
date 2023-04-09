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
        if($_SESSION['admin_announcement_restriction_details'] =='Modify'){
            // check post var and file var
            if(isset($_POST['announcement_id']) ){
                require_once('../../classes/annoucements.class.php');
                $annoucementObj = new annoucements();
                $annoucement_id = $_POST['announcement_id'];
                // get number of announcements
                $number_of_announcement = $annoucementObj->get_number_of_annoucements()['number_of_announcements'];
                // get announcement details
                if($annoucement_details = $annoucementObj->fetch_details($annoucement_id)){
                    // unlink / delete file
                    if(file_exists(dirname(__DIR__,2) . '/img/announcement/original/'.$annoucement_details['announcement_file_image']) && file_exists(dirname(__DIR__,2) . '/img/announcement/announcement-resized/'.$annoucement_details['announcement_file_image'])){
                        if(unlink(dirname(__DIR__,2) . '/img/announcement/original/'.$annoucement_details['announcement_file_image']) && unlink(dirname(__DIR__,2) . '/img/announcement/announcement-resized/'.$annoucement_details['announcement_file_image'])){
                            // delete announcement in db
                            if($annoucementObj->delete_with_id($annoucement_id)){
                                // update the order of all rows in table
                                if($annoucement_data = $annoucementObj->fetch_all()){
                                    $index= $number_of_announcement-1;
                                    foreach ($annoucement_data as $key => $value) {
                                        // update
                                        $annoucementObj->update_announcement_order($value['announcement_id'],$index);
                                        $index--;
                                    }
                                }
                                echo json_encode($annoucement_details);
                            }else{
                                echo '0';
                            }
                            
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
        }else if($_SESSION['admin_announcement_restriction_details'] =='Read-Only'){
            header('location:announcement.php');
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