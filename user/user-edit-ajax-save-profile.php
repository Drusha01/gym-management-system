<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';
require_once '../classes/genders.class.php';


if(isset($_SESSION['admin_id'])){
    header('location:../admin/admin_control_log_in2.php');
}
// check if we are logged in
if(isset($_SESSION['user_id'])){
    // check if the user is active
    if($_SESSION['user_status_details'] =='active'){
        // check what type of user are we
        if ($_SESSION['user_id'] == $_POST['user_id']) {
        
            $userObj = new users;

            // validate all profile information
            if (validate_profile_info($_POST)) {
                $error = false;

                // validate email
                // make sure that email is not taken
                $userObj->setuser_id($_POST['user_id']);
                $userObj->setuser_email($_POST['email']);
                if ($data = $userObj->user_duplicateEmail()) {
                    if (isset($data['user_id']) && $data['user_id'] != $_SESSION['user_id']) {
                        echo 'email_taken';
                        return -1;
                    }
                }
                
                    // validate phone
                    // make sure that phone is not taken

                $userObj->setuser_phone_number($_POST['phone']);
                if ($data = $userObj->user_duplicatePhone()) {
                    if (isset($data['user_id']) && $data['user_id'] != $_SESSION['user_id']) {
                        echo 'phone_taken';
                        return -1;
                    }
                }
                    
                


                // if new gender is found insert first the new gender then 

                $error = false;
                if(isset($_POST['gender']) &&  ($_POST['gender'] != 'Other' || $_POST['gender'] != 'None')){
                    $userObj->setuser_gender_details($_POST['gender']);
                }else{
                    echo 'error_gender';
                    return -1;
                }
                if(isset($_POST['gender_other']) && strlen($_POST['gender_other'])>0 ){
                    $userObj->setuser_gender_details($_POST['gender_other']);
                    $genderObj = new genders();
                    $genderObj->insert_new_gender($_POST['gender_other']);
                    //echo 'other_gender';
                }else{
                    // echo 'error_gender';
                    // return -1;
                }



    


                // set
                $userObj->setuser_id($_POST['user_id']);
                $userObj->setuser_firstname($_POST['fname']);
                $userObj->setuser_middlename($_POST['mname']);
                $userObj->setuser_lastname($_POST['lname']);

                $userObj->setuser_address($_POST['address']);
                $userObj->setuser_birthdate($_POST['birthdate']);
                if ($userObj->profile_update()) {
                    // updated

                    $user_details = $userObj->get_user_details();
                    // update session
                    $_SESSION['user_id'] = $user_details['user_id'];
                    $_SESSION['user_status_details'] = $user_details['user_status_details'];
                    $_SESSION['user_type_details'] = $user_details['user_type_details'] ;
                    $_SESSION['user_gender_details'] = $user_details['user_gender_details'];
                    $_SESSION['user_phone_contry_code_details'] = $user_details['user_phone_contry_code_details'];

                    $_SESSION['user_phone_number'] = $user_details['user_phone_number'];
                    $_SESSION['user_email'] =$user_details['user_email'];
                    $_SESSION['user_name'] = $user_details['user_name'];
                    $_SESSION['user_password_hashed'] = 'null';
                    $_SESSION['user_firstname'] = $user_details['user_firstname'];
                    $_SESSION['user_middlename'] = $user_details['user_middlename'];

                    $_SESSION['user_lastname'] = $user_details['user_lastname'];
                    $_SESSION['user_address'] = $user_details['user_address'];
                    $_SESSION['user_birthdate'] = $user_details['user_birthdate'];

                    echo 'saved';
                    
                } else {
                    // error
                    echo 'error profile update';
                }


            }else{
                if(!validate_string($_POST, 'fname')){
                    echo 'invalid firstname';
                    return;
                }
                if(!validate_string($_POST, 'lname') ){
                    echo 'invalid lastname';
                    return;
                }
                if(!validate_birthdate($_POST, 'birthdate') ){
                    echo 'invalid birthdate';
                    return;
                }
                if(!validate_phone($_POST, 'phone') ){
                    echo 'invalid phone';
                    return;
                }
                if(!validate_email($_POST) ){
                    echo 'invalid email';
                    return;
                }
                
                    
                // echo 'invalid inputs';
            }
        } else {
            echo '0';
        }
        
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