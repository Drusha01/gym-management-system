<?php
// start session
session_start();

// includes


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
    header('location:../admin_control_log_in.php');
}

?>



<?php require_once '../includes/header.php'; ?>

<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>
<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
    <div class="w-100">
    
    <section id="subscription" class="pt-3 ps-3 ps-lg-0">
        <?php require_once 'subscription.php';?>
    </section>
    <br>
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Total Subscriptions for the Week</h6>
                    March 20-25, 2023
                </div>
                <canvas id="total-subs"></canvas>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Sales & Revenue</h6>
                    March 20-25, 2023
                </div>
                <canvas id="salse-revenue"></canvas>
            </div>
        </div>
    </div>
               
    </div>
</main>

<script>
$(".nav-item").on("click", function(){
            $(".nav-item").removeClass("active");
            $(this).addClass("active");

        });
</script>
<script src="../../lib/chart/chart.min.js"></script>
<script src="../../js/customdash.js"></script>
</body>
</html>