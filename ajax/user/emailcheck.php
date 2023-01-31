<?php 
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';
$userObj = new Users();

// set attributes
if(isset($_GET['email']) ){
    $userObj->setuser_email($_GET['email']);
    if($userObj->user_duplicateEmail()){
        echo '0';
    }else{
        echo '1';
    }
}else{
    echo '0';
}

