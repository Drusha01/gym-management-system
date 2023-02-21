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
    <h5 class="col-12 fw-bold mb-3">Reports</h5>
    <div class="card chart-container">
        <canvas id="chart"></canvas>
    </div>
  </div>
</main>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<script>
      const ctx = document.getElementById("chart").getContext('2d');
      const myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["sunday", "monday", "tuesday",
          "wednesday", "thursday", "friday", "saturday"],
          datasets: [{
            label: 'Last week',
            backgroundColor: 'rgba(161, 198, 247, 1)',
            borderColor: 'rgb(47, 128, 237)',
            data: [3000, 4000, 2000, 5000, 8000, 9000, 2000],
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
              }
            }]
          }
        },
      });
</script>
</html>