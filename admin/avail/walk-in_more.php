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
    <div class="row">
        <h5 class="col-7 col-lg-4 fw-bold mb-3 ms-2">More Details (Walk-In)</h5>
        <a class="col text-decoration-none text-black m-0" aria-current="page" href="avail.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
    </div>
    <div class="form-group col-12 col-sm-5 table-filter-option pb-3">
        <label for="keyword">Search</label>
        <input type="text" name="keyword" id="keyword-2" placeholder="Enter Name Here" class="form-control ms-md-2">
    </div>
    <div class="table-responsive table-2">
            <table id="table-2" class="table table-striped table-borderless table-custom" style="width:100%;border: 3px solid black;">
                <thead class="bg-dark text-light">
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
                    <th>NAME</th>
                    <th class="text-center ">AVAILED SERVICE</th>
                    <th scope="col" class="text-center">DATE AVAILED</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="row" class="text-center d-none d-sm-table-cell">1</th>
                    <td>Trinidad, James Trinidad</td>
                    <td class="text-center ">Gym-Use</td>
                    <td class="text-center">October 16, 2022</td>
                    </tr>
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="row" class="text-center d-none d-sm-table-cell">2</th>
                    <td>Nicholas, Shania Gabrielle</td>
                    <td class="text-center ">Gym-Use</td>
                    <td class="text-center">October 16, 2022</td>
                    </tr>
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="row" class="text-center d-none d-sm-table-cell">3</th>
                    <td>Lim, Robbie John</td>
                    <td class="text-center ">Gym-Use/Trainer</td>
                    <td class="text-center">October 16, 2022</td>
                    </tr>
                </tbody>
            </table>
        </div>

  </div>
</main>
<script>
    $(document).ready(function() {
    $('#table-2').DataTable( {
        select: true
    } );
} );
</script>
</body>

</html>