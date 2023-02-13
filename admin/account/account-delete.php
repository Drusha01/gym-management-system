<?php
// start session
session_start();

// includes


// check if we are normal user
if(isset($_SESSION['user_id'])){
    header('location:../user/user-page.php');
}

print_r($_GET);

if(isset($_SESSION['admin_id'])){
    // check admin user details
    if($_SESSION['admin_user_status_details'] == 'active'){
        // do nothing

        // get offer id
        if(isset($_GET['id']) && $_SESSION['admin_user_type_details']=='admin'){
            // include the db
            require_once '../../classes/users.class.php';
            require_once '../../tools/functions.php';

            
            // admin password??


            

        }
        

    }else if($_SESSION['admin_user_status_details'] == 'inactive'){
        // do this
    }else if($_SESSION['admin_user_status_details'] == 'deleted'){
        // go to deleted user page
    }

}else{
    // go to admin login
    header('location:../admin_control_log_in2.php');
}

?>