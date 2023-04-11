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
<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4" id="main-body-content">
    <div class="w-100">
    <section id="subscription" class="pt-3 ps-3 ps-lg-0">
        <?php require_once 'subscription.php';?>
    </section>
    <br>
        <!-- charts -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card rounded-4 border-0 shadow text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Total Subscriptions for the Week</h6>
                        March 20-25, 2023
                    </div>
                    <div style="height: 300px">
                        <canvas id="total-subs"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row g-4">
            <div class="col-sm-12 col-xl-8">
                <div class="card rounded-4 border-0 shadow text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Sales & Revenue</h6>
                        March 20-25, 2023
                    </div>
                    <canvas id="salse-revenue"></canvas>
                </div>
            </div>
            <div class="col-sm-12 col-xl-4">
                <div class="card rounded-4 border-0 shadow rounded h-100 p-4">
                    <h6 class="mb-4">Accounts</h6>
                    <div style="height: 300px">
                        <canvas id="pie-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- charts    -->
    <br>
        <div class="row g-4">
            <div class="col-sm-12 col-xl-5">
                <div class="card rounded-4 border-0 shadow h-100 p-4">
                    <h6 class="mb-4">Status of Subscriptions</h6>
                    <canvas id="doughnut-chart"></canvas>
                </div>
            </div>
            <div class="col-xl-7">
                <div class="col-sm-12 col-xl-auto pb-3">
                    <div class="card rounded-4 border-0 shadow p-4 w-100">
                        <h6 class="mb-4">Recent Customers Subscribed</h6>
                        <?php 
                        require_once('../../classes/subscriptions.class.php');
                        $subscriptionsObj = new subscriptions();

                        if($subscription_data = $subscriptionsObj->recent_customers_subscribed()){
                            echo'
                            <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col" class="text-center">Total Number of Availed Offers</th>
                                </tr>
                            </thead>
                            <tbody>';
                            $counter=1;
                            foreach ($subscription_data as $key => $subscription_data_value) {
                                $total = 0;
                                if($subscription_data_total = $subscriptionsObj->total_number_of_availed_offers($subscription_data_value['subscription_subscriber_user_id'])){
                                    $total = $subscription_data_total['total'];
                                } else{
                                    $total=0;
                                }
                                echo '
                                <tr>
                                    <th scope="row">'.$counter.'</th>
                                    <td>'.htmlentities($subscription_data_value['user_fullname']).'</td>
                                    <td class="text-center">'.htmlentities($total).'</td>
                                </tr>';
                                $counter++;
                            }
                            echo '
                                </tbody>
                            </table>';
                        }else{
                            echo '<h6 class="mb-4">No Data</h6>';
                        }
                        
                        ?>
                        
                    </div>
                </div>
                <div class="col-sm-12 col-xl-auto">
                    <div class="card rounded-4 border-0 shadow p-4 w-100">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Total walk-In For this Week</h6>
                            <span>March 20-25, 2023</span>
                        </div>
                        <div style="height: 200px">
                        <canvas id="bar-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- <script>
$(".nav-item").on("click", function(){
            $(".nav-item").removeClass("active");
            $(this).addClass("active");

        });
</script> -->
<script src="../../lib/chart/chart.min.js"></script>
<script src="../../js/customdash.js"></script>
</body>
</html>