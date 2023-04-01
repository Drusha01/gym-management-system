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
                <button class="nav-link active text-dark" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales" type="button" role="tab" aria-controls="sales" aria-selected="true">Sales & Revenue</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark" id="subs-tab" data-bs-toggle="tab" data-bs-target="#subs" type="button" role="tab" aria-controls="subs" aria-selected="false">Subscriptions</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark" id="most_availed-tab" data-bs-toggle="tab" data-bs-target="#most_availed" type="button" role="tab" aria-controls="most_availed" aria-selected="false">Most Availed Offer</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark" id="frequent-tab" data-bs-toggle="tab" data-bs-target="#frequent" type="button" role="tab" aria-controls="frequent" aria-selected="false">Most Frequent Customer</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-dark" id="availed_trainer-tab" data-bs-toggle="tab" data-bs-target="#availed_trainer" type="button" role="tab" aria-controls="availed_trainer" aria-selected="false">Most Availed Trainer</button>
            </li>
        </ul>
        <div class="row my-2">
            <div class="col-lg-6 d-grid d-lg-inline"><button class="btn btn-outline-dark  me-1 py-1 ">Print</button><button class="btn btn-outline-dark me-1 py-1">PDF</button><button class="btn btn-outline-dark me-1 py-1">Excel</button></div>
            <div class="col-12 col-lg-6 pb-2 d-flex justify-content-end">
                <div id="reportrange_1" class="pull-right rounded" style="background: #fff; cursor: pointer; padding: 4px 10px; border: 1px solid #ccc; width:100%;">
                    <i class='bx bxs-calendar'></i>&nbsp;
                    <span></span> <b class="caret"></b>
                </div>
            </div>
        </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                <div class="bg-light rounded h-100 p-4">
                    <canvas id="salse-revenue"></canvas>
                </div>
            </div>

            <div class="tab-pane fade" id="subs" role="tabpanel" aria-labelledby="subs-tab">
                <div class="bg-light rounded h-100 p-4">
                    <canvas id="subscriptions"></canvas>
                </div>
            </div>

            <div class="tab-pane fade" id="most_availed" role="tabpanel" aria-labelledby="most_availed-tab">
                <div class="bg-light rounded h-100 p-4">
                    <select class="form-select-sm" aria-label="Default select example">
                        <option selected>All</option>
                        <option value="1">Gym Subscription</option>
                        <option value="2">Trainer Subscription</option>
                        <option value="3">Locker Subscription</option>
                        <option value="4">Program Subscription</option>
                        <option value="5">Walk-In</option>
                    </select>
                    <canvas id="most-availed"></canvas>
                </div>
            </div>

            <div class="tab-pane fade" id="frequent" role="tabpanel" aria-labelledby="frequent-tab">
                <div class="bg-light rounded h-100 p-4">
                    <select class="form-select-sm" aria-label="Default select example">
                        <option selected>Per Hour Per Day</option>
                        <option value="1">Presence per Month</option>
                    </select>
                    <canvas id="most-frequent"></canvas>
                </div>
            </div>

            <div class="tab-pane fade" id="availed_trainer" role="tabpanel" aria-labelledby="availed_trainer-tab">
                <div class="bg-light rounded h-100 p-4">
                    <canvas id="trainer_most"></canvas>
                </div>
            </div>
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