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
            <div class="form-group col-12 col-sm-8 table-filter-option">
                <label for="keyword">Search</label>
                <input type="text" name="keyword" id="keyword" placeholder="Enter Name Here" class="form-control ms-md-2">
            </div>
              <div class="table-responsive table-1">
                <table id="table-1" class="table table-bordered table-striped " style="width:100%;border: 3px solid black;">
                    <thead class="table-dark ">
                        <tr>
                        <th class="text-center align-middle d-none d-sm-table-cell" rowspan="3">#</th>
                        <th class="text-center align-middle" rowspan="3" >NAME</th>
                        <th class="text-center" colspan="8">SUBSCRIPTION TYPE</th>
                        <th class="text-center align-middle" rowspan="3">ACTION</th>
                        </tr>
                        <tr>
                        <th class="text-center" colspan="2">Gym-Use</th>
                        <th class="text-center" colspan="2">Trainer</th>
                        <th class="text-center" colspan="2">Locker</th>
                        <th class="text-center" colspan="2">Program</th>
                        </tr>
                        <tr>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Paid</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Paid</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Paid</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                      <td class="text-center">1</td>
                      <td class="text-center">Trinidad, James Lorenz</td>
                      <td class="text-center">1</td>
                      <td class="text-center">1</td>
                      <td class="text-center">1</td>
                      <td class="text-center">1</td>
                      <td class="text-center">1</td>
                      <td class="text-center">1</td>
                      <td class="text-center">1</td>
                      <td class="text-center">1</td>
                      <td class="text-center"><a href="#" class="btn btn-primary btn-sm" role="button">Edit</a> <button href="#" class="btn btn-danger btn-sm"">Delete</button></td>
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</main>




</body>
</html>