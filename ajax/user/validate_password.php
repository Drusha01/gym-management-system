<?php 
session_start();

// includes
require_once '../../tools/functions.php';
require_once '../../classes/users.class.php';

// get password from GET
if(isset($_GET['password'])){
    if(strlen($_GET['password']) < 12 ) {
        echo 'password less than 12';
        return;
    }
    elseif(!preg_match("#[0-9]+#",$_GET['password'])) {
        echo 'password must contain numbers';
        return;
    }
    elseif(!preg_match("#[A-Z]+#",$_GET['password'])) {
        echo 'password must have 1 uppercase letter';
        return;
    }
    elseif(!preg_match("#[a-z]+#",$_GET['password'])) {
        echo 'password must have 1 lowercase letter';
        return;
    }
    echo 'valid'; 
}else{
    echo '0';
}
