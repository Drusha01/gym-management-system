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
    <h5 class="col-12 fw-bold mb-3">Payment</h5>
    <div class="container-fluid">
        <div class="row g-2 mb-2 mt-1">
            <div class="form-group col-12 col-sm-5 table-filter-option">
                <label for="keyword">Search</label>
                <input type="text" name="keyword" id="keyword" placeholder="Enter Name Here" class="form-control ms-md-2">
            </div>
              <div class="table-responsive table-1">
                <table id="table-1" class="table table-striped table-bordered nowrap" style="width:100%;border: 2px solid grey;">
                    <thead class="table-light">
                        <tr>
                            <th class="d-lg-none"></th>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Total Amount</th>
                            <th class="text-center">Total Paid</th>
                            <th class="text-center">Total Balance</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="d-lg-none"></td>
                            <td class="text-center">1</td>
                            <td class="text-center">Trinidad, James Lorenz</td>
                            <td class="text-center">₱800</td>
                            <td class="text-center">₱500</td>
                            <td class="text-center">₱300</td>
                            <td class="text-center"><a href="viewpayment.php" class="btn btn-success btn-sm" role="button">View Payment</a></td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>