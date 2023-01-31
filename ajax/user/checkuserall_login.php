<?php 
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';
$userObj = new Users();

// software firewall // check how many times did the user check in a minute (max would be 5 times in every minute per ip address) although this wont protect the sytem externally, they can just abuse this via
// using new session and abuse it.

// set attributes
if(isset($_GET['login'])){
    $userObj->setuser_name($_GET['login']);
    $userObj->setuser_email($_GET['login']);
    $userObj->setuser_phone_number($_GET['login']);
    if($userObj->user_duplicateAll()){
        echo '0';
    }else{
        echo '1';
    }
}else{
    echo '0';
}



