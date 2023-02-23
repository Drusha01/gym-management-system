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
    <h5 class="col-12 fw-bold mb-3">Settings</h5>
    <div class="container-fluid">
        <div class="row g-2 mb-2 mt-1">
            <div class="d-block d-lg-none pb-3">
                <h5 class="col-12 fw-regular ">Account</h5>
                <hr>
                <a href="../profile/profile.php" class="btn btn-outline-dark" role="button">View Profile</a>
            </div>
        <!-- first part -->
            <h5 class="col-12 fw-regular ">Add Account</h5>
            <hr>
            <div class="col-12 col-sm-12 d-grid d-lg-inline-flex justify-content-lg-end form-group h-50">
                <a href="add-user.php" class="btn btn-success" role="button">Add User</a>
            </div>
                <div class="table-responsive table-container">
                    <table id="table-2" class="table table-striped table-borderless table-custom" style="width:100%;border: 3px solid black;">
                        <thead class="bg-dark text-light">
                            <tr>
                            <th class="d-lg-none"></th>
                            <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
                            <th>NAME</th>
                            <th class="text-center ">USER NAME</th>
                            <th scope="col" class="text-center">DATE CREATED</th>
                            <th scope="col" class="text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th class="d-lg-none"></th>
                            <th scope="row" class="text-center d-none d-sm-table-cell">1</th>
                            <td>Trinidad, James Lorenz</td>
                            <td class="text-center ">James_Nolegs</td>
                            <td class="text-center">November 14, 2022</td>
                            <td class="text-center"><a href="edit-user.php" class="btn btn-primary btn-sm" role="button">Edit</a>  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td>
                            </tr>
                            <tr>
                            <th class="d-lg-none"></th>
                            <th scope="row" class="text-center d-none d-sm-table-cell">1</th>
                            <td>Nicholas, Shania</td>
                            <td class="text-center ">Can_squatmoredanYOU</td>
                            <td class="text-center">November 14, 2022</td>
                            <td class="text-center"><a href="edit-user.php" class="btn btn-primary btn-sm" role="button">Edit</a>  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td>
                            </tr>
                            <tr>
                            <th class="d-lg-none"></th>
                            <th scope="row" class="text-center d-none d-sm-table-cell">1</th>
                            <td>Lim, Robbie John</td>
                            <td class="text-center ">Labuyo_Boi</td>
                            <td class="text-center">November 14, 2022</td>
                            <td class="text-center"><a href="edit-user.php" class="btn btn-primary btn-sm" role="button">Edit</a>  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td>

                        </tbody>
                    </table>
                </div>
            <div class="container d-flex justify-content-center justify-content-lg-end ">
                <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>

                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>

                            <li class="page-item" aria-current="page">
                                <a class="page-link text-dark" href="#">2</a>
                            </li>

                            <li class="page-item">
                                <a class="page-link text-dark" href="#">3</a>
                            </li>

                            <li class="page-item">
                            <a class="page-link text-dark" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- end of first part -->
        <!-- 2nd part -->
        <h5 class="col-12 fw-regular ">Notifications</h5>
        <hr>
        <div class="row">
            <div class="col-lg-2">
                Select Number of Days to notify about expiration
            </div>
            <div class="col-lg-1 pt-2">
                <input type="number" class="form-control" value="" id="offer_name" name="offer_name"placeholder="30" required>
            </div>
        </div>
        <!-- end of second aprt -->

        <!-- 2nd part -->
        <h5 class="col-12 fw-regular pt-4">Walk-In</h5>
        <hr>
        <div class="row">
            <div class="col-lg-3 mt-3">
                Price of Walk-In Gym-Use
            </div>
            <div class="col-lg-1 pt-2">
                <input type="number" class="form-control" value="" id="offer_name" name="offer_name"placeholder="30" required>
            </div>
            <div class="col-lg-3 mt-3">
                Price of Walk-In Trainer
            </div>
            <div class="col-lg-1 pt-2">
                <input type="number" class="form-control" value="" id="offer_name" name="offer_name"placeholder="30" required>
            </div>
        </div>
        <!-- end of second aprt -->
        <br>

        <h5 class="col-12 fw-regular">Overdue</h5>
        <hr>
        <div class="row">
            <div class="col-lg-3 ">
                Choose percentage of Penalty of Payment Per Day
            </div>
            <div class="col-lg-1 pt-2">
                <input type="number" class="form-control" value="" id="offer_name" name="offer_name"placeholder="30" required>
            </div>
        </div>
        <br>


    </div>
</main>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<script>
      
</script>
</html>