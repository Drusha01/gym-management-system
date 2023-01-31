<?php 
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';
$userObj = new Users();

// set attributes
if(isset($_GET['username']) && strlen($_GET['username'])>6){
    $userObj->setuser_name($_GET['username']);
    if($userObj->user_duplicateUsername()){
        echo '0';
    }else{
        echo '1';
    }
}else{
    echo '0';
}

