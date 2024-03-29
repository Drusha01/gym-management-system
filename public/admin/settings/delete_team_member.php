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
            if(isset($_POST['team_id']) && intval($_POST['team_id'])>0 ){
                require_once('../../classes/teams.class.php');
                $teamsObj= new teams();
                if($team_data = $teamsObj->fetch_with_id($_POST['team_id'])){
                    // delete the file here
                    $original_file_path = dirname(__DIR__,2) . '/img/team/original/'.$team_data['team_file'];
                    $resize_file_path = dirname(__DIR__,2) . '/img/team/team-resized/'.$team_data['team_file'];

                    $original_file = file_exists($original_file_path);
                    $resize_file = file_exists($resize_file_path);
                    if($original_file || $resize_file){
                        if($original_file){
                            unlink($original_file_path);
                        }
                        if($resize_file){
                            unlink($resize_file_path);
                        }
                        if($teamsObj->delete($_POST['team_id'])){
                            // delete here now
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
