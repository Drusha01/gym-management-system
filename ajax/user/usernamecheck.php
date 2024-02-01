<?php 
session_start();

// includes
require_once '../../tools/functions.php';
require_once '../../classes/users.class.php';
$userObj = new Users();

// set attributes
if(isset($_POST['username']) && strlen($_POST['username'])>=6 && !str_contains($_POST['username'], ' ')){
    $userObj->setuser_name(($_POST['username']));
    if($userObj->user_duplicateUsername()){
        echo '0';
    }else{
        echo '1';
    }
}else{
    echo '0';
}

