<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';


// check if we are logged in
if(isset($_SESSION['user_id'])){
    // check if the user is active
    if($_SESSION['user_status_details'] =='active'){
        // check what type of user are we
        if($_SESSION['user_id'] == $_POST['user_id']){
            $userObj = new users;
            print_r($_POST);
            // validate all profile information
            if (validate_profile_info($_POST)) {
                $error = false;

                // validate email
                // make sure that email is not taken
                $userObj->setuser_id($_POST['user_id']);
                $userObj->setuser_email($_POST['email']);

               if($data = $userObj->user_duplicateEmail()){
                    if(isset($data['user_id']) && $data['user_id']!= $_SESSION['user_id']){
                        echo 'email_taken';
                        return -1;
                    }
                }
                if($data = $userObj)

                // validate phone
                // make sure that phone is not taken
                if(isset($_POST['phone']) && strlen($_POST['phone']) ==10){
                    $userObj->setuser_phone_number($_POST['phone']);
                    if($data = $userObj->user_duplicatePhone()){
                        if(isset($data['user_id']) && $data['user_id']!= $_SESSION['user_id']){
                            echo 'phone_taken';
                            return -1;
                        }
                    }
                }

                
                // if new gender is found insert first the new gender then 
                
                if(isset($_POST['gender']) && $_POST['gender'] != 'None'){
                    $userObj->setuser_gender_details($_POST['gender']);
                }else if(isset($_POST['gender_other']) && strlen($_POST['gender_other'])>0 ){
                    $userObj->setuser_gender_details($_POST['gender_other']);
                    $genderObj = new genders();
                    $genderObj->insert_new_gender($_POST['gender_other']);
                    echo 'other_gender';
                }else{
                echo 'error';
                $error = true;
                }



                echo 'nice';
                

                // set
                $userObj->setuser_id($_POST['user_id']);
                $userObj->setuser_firstname($_POST['fname']);
                $userObj->setuser_middlename($_POST['mname']);
                $userObj->setuser_lastname($_POST['lname']);

                $userObj->setuser_user_address($_POST['address']);
                $userObj->setuser_birthdate($_POST['birthdate']);
                if($userObj->profile_update()){
                    // updated
                }else{
                    // error
                }
                
                
            }
        }else{
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