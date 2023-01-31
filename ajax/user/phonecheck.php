<?php 
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';
$userObj = new Users();

// set attributes
if(isset($_GET['phone']) && strlen($_GET['phone']) ==10 ) {
    $userObj->setuser_phone_number($_GET['phone']);
    if($userObj->user_duplicatePhone()){
        echo '0';
    }else{
        echo '1';
    }
}else{
    echo '0';
}

