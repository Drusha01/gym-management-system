<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';
require_once '../classes/genders.class.php';

// check if we are logged in
if(isset($_SESSION['user_id'])){
    // check if the user is active
    if($_SESSION['user_status_details'] =='active'){
        // check what type of user are we
        if ($_SESSION['user_id'] == $_POST['user_id']) {
            if ($_SESSION['user_type_details'] == 'normal') {
                
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
                    if ($data = $userObj)

                        // validate phone
                        // make sure that phone is not taken
                        if (isset($_POST['phone']) && strlen($_POST['phone']) == 10) {
                            $userObj->setuser_phone_number($_POST['phone']);
                            if ($data = $userObj->user_duplicatePhone()) {
                                if (isset($data['user_id']) && $data['user_id'] != $_SESSION['user_id']) {
                                    echo 'phone_taken';
                                    return -1;
                                }
                            }
                        }


                    // if new gender is found insert first the new gender then 

                    if (isset($_POST['gender']) && $_POST['gender'] != $_SESSION['user_gender_details']) {
                        $userObj->setuser_gender_details($_POST['gender']);
                    } else if (isset($_POST['gender_other']) && strlen($_POST['gender_other']) > 0) {
                        $userObj->setuser_gender_details($_POST['gender_other']);
                        $genderObj = new genders();
                        $genderObj->insert_new_gender($_POST['gender_other']);
                        //echo 'other_gender';
                    } else {
                        echo 'gender_error';
                        $error = true;
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
                        echo 'error';
                    }


                }
            } else {
                echo '0';
            }
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