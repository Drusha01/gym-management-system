<?php 
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';
$userObj = new Users();

if(isset($_GET['id'])){
    $userObj->setuser_id($_GET['id']);
    $data = $userObj->get_user_details();
    if(!$data){
        echo '0';
    }else{
        print_r($data);
    }
}else{
    echo '0';
}
