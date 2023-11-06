<?php 
session_start();

// includes
require_once '../../tools/functions.php';
require_once '../../classes/users.class.php';

// get password from GET
if(isset($_POST['password'])){
    if(strlen($_POST['password']) < 12 ) {
        echo 'password less than 12';
        return;
    }
    elseif(!preg_match("#[0-9]+#",$_POST['password'])) {
        echo 'password must contain numbers';
        return;
    }
    elseif(!preg_match("#[A-Z]+#",$_POST['password'])) {
        echo 'password must have 1 uppercase letter';
        return;
    }
    elseif(!preg_match("#[a-z]+#",$_POST['password'])) {
        echo 'password must have 1 lowercase letter';
        return;
    }
    echo 'valid'; 
}else{
    echo '0';
}
