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
    header('location:../admin_control_log_in2.php');
}

?>



<?php require_once '../includes/header.php'; ?>

<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>
<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
    <div class="w-100">
        <div class="container-fluid">
            <ul class="nav nav-tabs application">
                <li class="nav-item active ">
                    <a class="nav-link" href="#tab-avail" data-bs-toggle="tab">Avail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab-pay" data-bs-toggle="tab">Payment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab-acc" data-bs-toggle="tab">Account</a>
                </li>
            </ul>
            <div class="tab-content">
            <div class="tab-pane active show fade" id="tab-avail">
                <section id="subscription" class="pt-3">
                <?php require_once 'subscription.php';?>
                </section>
                <br>
                <section id="expiration">
                <?php require_once 'expiration.php';?>
                </section>
                <br>
                <section id="walk-in">
                <?php require_once 'walk-in.php';?>
                </section>
                </div>
            <div class="tab-pane show fade" id="tab-pay">
                <section id="pending" class="pt-3">
                <?php require_once 'pending.php';?>
                </section>
                <section id="partial" class="pt-3">
                <?php require_once 'partial.php';?>
                </section>
                <section id="unpaid" class="pt-3">
                <?php require_once 'unpaid.php';?>
                </section>
                <section id="overdue" class="pt-3">
                <?php require_once 'overdue.php';?>
                </section>
            </div>
            <div class="tab-pane show fade" id="tab-acc">
                <section id="pending" class="pt-3">
                <?php require_once 'account.php';?>
                </section>
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

</body>
</html>