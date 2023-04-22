<?php 
session_start();
// check if we are normal user
if(isset($_SESSION['user_id'])){
    header('location:../user/user-page.php');
}


if(isset($_SESSION['admin_id'])){
    // check admin user details
    if($_SESSION['admin_user_status_details'] == 'active'){
        // do nothing
    }else if($_SESSION['admin_user_status_details'] == 'inactive'){
        // do this
    }else if($_SESSION['admin_user_status_details'] == 'deleted'){
        // go to deleted user page
    }

}else{
    // go to admin login
    header('location:admin_control_log_in.php');
}



require_once 'includes_v2/header.php'; 
require_once 'includes_v2/top_nav_admin.php';
require_once 'includes_v2/side_nav.php';

?>
<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4" id="main-content">
</main>

</body>
</html>