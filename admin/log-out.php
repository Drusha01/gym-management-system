<?php
    //resume session
    session_start();
    //destroy session
    session_destroy();
    //then send user to login page
    header('location: admin_control_log_in.php');
    

?>