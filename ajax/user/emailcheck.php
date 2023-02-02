<?php 
session_start();

// includes
require_once '../../tools/functions.php';
require_once '../../classes/users.class.php';
$userObj = new Users();

// set attributes
if(isset($_POST['email']) && validate_email($_POST)){
    $userObj->setuser_email($_POST['email']);
    if($userObj->user_duplicateEmail()){
        echo '0';
    }else{
        echo '1';
    }
}else{
    echo '0';
}

