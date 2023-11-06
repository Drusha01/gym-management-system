<?php 
session_start();

// includes
require_once '../../tools/functions.php';
require_once '../../classes/users.class.php';
$userObj = new Users();

// set attributes
if(isset($_GET['username']) && strlen($_GET['username'])>6){
    $userObj->setuser_name($_GET['username']);
    if($data = $userObj->user_duplicateUsername()){
        print_r($data);
    }else{
        echo '1';
    }
}else{
    echo '0';
}

