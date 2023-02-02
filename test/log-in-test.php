<?php 
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';
$userObj = new Users();

if(isset($_GET['login'])){
    $userObj->setuser_name($_GET['login']);
    $userObj->setuser_email($_GET['login']);
    $userObj->setuser_phone_number($_GET['login']);
    $data = $userObj->login();
    if(!$data){
        echo '0';
    }else{
        print_r($data);
    }
}else{
    echo '0';
}
