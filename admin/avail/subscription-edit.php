<?php 
session_start();
if(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Modify'){

}elseif(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Read-Only'){
    //d
}else{
    //do not load the page
    header('location:../dashboard/dashboard.php');
}
?>