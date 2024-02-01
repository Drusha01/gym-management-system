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
            if(isset($_POST['announcement_id']) && isset($_POST['order']) ){
                require_once('../../classes/annoucements.class.php');
                $annoucementObj = new annoucements();
                $annoucement_id = $_POST['announcement_id'];
                // get number of announcements
                $number_of_announcement = $annoucementObj->get_number_of_annoucements()['number_of_announcements'];
                // get announcement details
                if($annoucement_details = $annoucementObj->fetch_details($annoucement_id)){
                    // unlink / delete file
                    $move = $_POST['order'];
                    if($annoucement_details['announcement_order'] == $number_of_announcement && $move == 'down'){
                        if($announcement_order_data = $annoucementObj->fetch_down($annoucement_details['announcement_order'])){
                            foreach ($announcement_order_data as $key => $value) {
                                if( $value['announcement_order'] == $annoucement_details['announcement_order']){
                                    $annoucementObj->update_announcement_order($value['announcement_id'],$annoucement_details['announcement_order']-1);
                                }else{
                                    $annoucementObj->update_announcement_order($value['announcement_id'],$annoucement_details['announcement_order']);
                                }
                            }
                            echo '1';
                        }
                        // get this and one down
                    }else if($annoucement_details['announcement_order'] < $number_of_announcement && $annoucement_details['announcement_order']  !=1){
                        if($move == 'down'){
                            // get this and one down
                            if($announcement_order_data = $annoucementObj->fetch_down($annoucement_details['announcement_order'])){
                                foreach ($announcement_order_data as $key => $value) {
                                    if( $value['announcement_order'] == $annoucement_details['announcement_order']){
                                        $annoucementObj->update_announcement_order($value['announcement_id'],$annoucement_details['announcement_order']-1);
                                    }else{
                                        $annoucementObj->update_announcement_order($value['announcement_id'],$annoucement_details['announcement_order']);
                                    }
                                }
                                echo '1';
                            }
                        }else if($move == 'up'){
                            // the this and one up
                            if($announcement_order_data = $annoucementObj->fetch_up($annoucement_details['announcement_order'])){
                                foreach ($announcement_order_data as $key => $value) {
                                    if( $value['announcement_order'] == $annoucement_details['announcement_order']){
                                        $annoucementObj->update_announcement_order($value['announcement_id'],$annoucement_details['announcement_order']+1);
                                    }else{
                                        $annoucementObj->update_announcement_order($value['announcement_id'],$annoucement_details['announcement_order']);
                                    }
                                }
                                echo '1';
                            }
                        }else{
                            echo '0';
                        }
                    }else if($annoucement_details['announcement_order']  == 1 && $move == 'up'){
                        // must be bottom
                        // the this and one up
                        if($announcement_order_data = $annoucementObj->fetch_up($annoucement_details['announcement_order'])){
                            foreach ($announcement_order_data as $key => $value) {
                                if( $value['announcement_order'] == $annoucement_details['announcement_order']){
                                    $annoucementObj->update_announcement_order($value['announcement_id'],$annoucement_details['announcement_order']+1);
                                }else{
                                    $annoucementObj->update_announcement_order($value['announcement_id'],$annoucement_details['announcement_order']);
                                }
                            }
                            echo '1';
                        }
                    }

                    if($_SESSION['admin_user_type_details'] != 'admin'){
                        require_once('../../classes/admins.class.php');
                        require_once('../../classes/notifications.class.php');
                        $adminObj = new admins();
                        $notificationObj = new notifications();
                        if($admin_id_data = $adminObj->fetch_admin_id_of_admins()){
                            foreach ($admin_id_data as $key => $value) {
                                
                                $notification_info ='Staff '.$_SESSION['admin_user_lastname'].', '.$_SESSION['admin_user_firstname'].' '.$_SESSION['admin_user_middlename'].' updated the announcement order.';
                                
                                if(!$notificationObj->insert($_SESSION['admin_user_id'],$value['user_id'],'Logs','logs.png', $notification_info)){
                                    exit('notification insert error');
                                }
                            }
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