<?php 

    require_once('../../classes/users.class.php');
    $userObj = new users();

    if($stats = $userObj->accounts_stats()){
        echo json_encode($stats);
    }else{
        echo 'No Data';
    }

?>