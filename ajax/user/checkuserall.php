<?php 
session_start();

// includes
require_once '../../tools/functions.php';
require_once '../../classes/users.class.php';
$userObj = new Users();

// set attributes
if(isset($_GET['email']) && isset($_GET['username']) && isset($_GET['phone'])){
    $userObj->setuser_name($_GET['username']);
    $userObj->setuser_email($_GET['email']);
    $userObj->setuser_phone_number($_GET['phone']);
    if($userObj->user_duplicateAll()){
        echo '0';
    }else{
        echo '1';
    }
}else{
    echo '0';
}



