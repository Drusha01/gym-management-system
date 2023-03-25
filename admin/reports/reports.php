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
    <h5 class="col-12 fw-bold mb-3">Reports</h5>
        <ul class="nav nav-tabs application" id="myTab" role="tablist">
            <li class="nav-item active" role="presentation">
                <button class="nav-link active text-dark" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Sales & Revenue</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Most Availed Offer</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Most Frequent Customer</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">1</div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">2</div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">3</div>
        </div>
        <div class="row pb-3">
            <div class="col-lg-6"></div>
            <div class="col-12 col-lg-6 pb-2 d-flex justify-content-end">
                <div id="reportrange" class="pull-right rounded" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width:100%;">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                </div>
            </div>
        </div>

        <div class="bg-light rounded h-100 p-4">
            <canvas id="salse-revenue"></canvas>
        </div>

  </div>
</main>
<script src="../../lib/chart/chart.min.js"></script>
<script src="../../js/reportchart.js"></script>
<script type="text/javascript" src="../../js/reportdatepicker.js"></script>
<script>
$(".nav-item").on("click", function(){
            $(".nav-item").removeClass("active");
            $(this).addClass("active");

        });
</script>
</body>

</html>