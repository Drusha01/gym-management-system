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
        <div class="row">
            <h5 class="col-8 col-lg-4 fw-bold mb-3">Edit Locker</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="locker.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
        </div>
        <div class="container">
            <h5 class="fw-bold fs-5">Customer: <span class="fw-light fs-5">Trinidad, James Lorenz</span></h5>
            <h5 class="fw-bold fs-5">Owned Lockers: <span class="fw-light fs-5">3</span></h5>
            <div class="col-12 col-lg-6">
            <table class="table table-striped table-borderless" style="width:100%; border: 3px solid black;">
                <thead class="table-dark">
                    <tr>
                    <th class="text-center">LOCKER ID</th>
                    <th class="text-center col-5">CHANGE LOCKER</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">Locker_2</td>
                        <td class="text-center">
                        <select class="form-select form-select-sm" name='users' id="users" style="width:100%;">
                            <option value="None" selected>Select Locker</option>
                            <option value="None" >Locker_2</option>
                            <option value="None" >Locker_5</option> 
                            <option value="None" >Locker_7</option> 
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">Locker_5</td>
                        <td class="text-center">
                        <select class="form-select form-select-sm" name='users' id="users" style="width:100%;">
                            <option value="None" selected>Select Locker</option>
                            <option value="None" >Locker_2</option>
                            <option value="None" >Locker_5</option> 
                            <option value="None" >Locker_7</option> 
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">Locker_7</td>
                        <td class="text-center">
                        <select class="form-select form-select-sm" name='users' id="users" style="width:100%;">
                            <option value="None" selected>Select Locker</option>
                            <option value="None" >Locker_2</option>
                            <option value="None" >Locker_5</option> 
                            <option value="None" >Locker_7</option> 
                        </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div class="row d-flex flex-row-reverse">
                <div class="col-12  d-grid d-lg-flex pt-3 pt-lg-1">
                    <button type="submit" class="btn btn-success  border-0 rounded" name="add_offer" value="add_offer" id="submit" >Save</button>
                </div>
            </div>
        </div>
  </div>
</main>

</body>

</html>