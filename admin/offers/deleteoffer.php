
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

        // get offer id
        if(isset($_GET['id']) && $_SESSION['admin_user_type_details']=='admin' && isset($_SESSION['admin_offer_restriction_details']) && $_SESSION['admin_offer_restriction_details'] == 'Modify'){
            // include the db
            require_once '../../classes/offers.class.php';
            require_once '../../tools/functions.php';

            $offersObj = new offers();
            // delete offer data in database
            $result = $offersObj->delete_offer($_GET['id']);
            if($result){
                //header('location:offer.php');
                echo '1';
            }else{
                echo '0';
            }
            // admin password??


            

        }else if(isset($_SESSION['admin_offer_restriction_details']) && $_SESSION['admin_offer_restriction_details'] == 'Read-Only'){
            header('location:offer.php');
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