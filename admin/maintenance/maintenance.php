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
    <h5 class="col-12 fw-bold mb-3">Maintenance</h5>
    <div class="row pb-3">
        <div class="form-group col-12 col-sm-4 table-filter-option">
            <label for="keyword">Search</label>
            <input type="text" name="keyword" id="keyword" placeholder="Enter Equipment Here" class="form-control ms-md-2">
        </div>
        <div class="col-12 col-sm-3 form-group table-filter-option">
            <label for="categoryFilter">Condition</label>
            <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="Good">Good</option>
                <option value="In-Maintenance">In-Maintenance</option>
            </select>
        </div>
        <div class="col-12 col-sm-3 form-group table-filter-option">
            <label for="categoryFilter">Type</label>
            <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="Good">Weights</option>
                <option value="In-Maintenance">Machine</option>
                <option value="In-Maintenance">Tool</option>
            </select>
        </div>
        <div class="col-12 col-sm-2 d-grid d-lg-inline-flex justify-content-lg-end form-group h-50">
            <a href="add-maintenance.php" class="btn btn-success" role="button">Add Equipment</a>
        </div>
    </div>
    <div class="table-responsive table-container">
        <table id="attendance" class="table table-borderless table-striped" style="width:100%; border: 3px solid black;">
            <thead class="table-dark" >
                <tr>
                <th class="d-lg-none"></th>
                <th class="text-center d-none d-sm-table-cell">#</th>
                <th class="text-center w-25">EQUIPMENT</th>
                <th class="text-center">TYPE</th>
                <th class="text-center">CONDITION</th>
                <th class="text-center">DATE AND TIME</th>
                <th class="text-center">LAST CHECKED BY</th>
                <th class="text-center">VIEW REMARKS</th>
                <th class="text-center">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th class="d-lg-none"></th>
                <td class="text-center d-none d-sm-table-cell">1</td>
                <td class="text-center">TreadMill Machine A</td>
                <td class="text-center">Machine</td>
                <td class="text-center">Good</td>
                <td class="text-center">March 23, 2023 (3:30 PM)</td>
                <td class="text-center">Trinidad, James Lorenz</td>
                <td class="text-center"><a href="view_rem.php" class="btn btn-outline-dark btn-sm">View All <i class='bx bx-show-alt' style="font-size:20px; vertical-align: middle;"></i></a></td>
                <td class="text-center"><button class="btn btn-outline-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-plus-circle'></i></button><button class="btn btn-outline-primary btn-circle btn-sm"><i class='bx bx-edit-alt'></i></button><button class="btn btn-outline-danger btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#delete"><i class='bx bx-trash' ></i></button></td>
                </tr>
                <tr>
                <th class="d-lg-none"></th>
                <td class="text-center d-none d-sm-table-cell">2</td>
                <td class="text-center">TreadMill Machine B</td>
                <td class="text-center">Machine</td>
                <td class="text-center">Good</td>
                <td class="text-center">March 26, 2023 (3:30 PM)</td>
                <td class="text-center">Trinidad, James Lorenz</td>
                <td class="text-center"><a href="view_rem.php" class="btn btn-outline-dark btn-sm">View All <i class='bx bx-show-alt' style="font-size:20px; vertical-align: middle;"></i></a></td>
                <td class="text-center"><button class="btn btn-outline-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-plus-circle'></i></button><button class="btn btn-outline-primary btn-circle btn-sm"><i class='bx bx-edit-alt'></i></button><button class="btn btn-outline-danger btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#delete"><i class='bx bx-trash' ></i></button></td>
                </tr>
                <tr>
                <th class="d-lg-none"></th>
                <td class="text-center d-none d-sm-table-cell">3</td>
                <td class="text-center">20 lb Dumbell A</td>
                <td class="text-center">Weights</td>
                <td class="text-center">In-Maintenance</td>
                <td class="text-center">March 24, 2023 (3:30 PM)</td>
                <td class="text-center">Lim, Robbie John</td>
                <td class="text-center"><a href="view_rem.php" class="btn btn-outline-dark btn-sm">View All <i class='bx bx-show-alt' style="font-size:20px; vertical-align: middle;"></i></a></td>
                <td class="text-center"><button class="btn btn-outline-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-plus-circle'></i></button><button class="btn btn-outline-primary btn-circle btn-sm"><i class='bx bx-edit-alt'></i></button><button class="btn btn-outline-danger btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#delete"><i class='bx bx-trash' ></i></button></td>
                </tr>
                <tr>
                <th class="d-lg-none"></th>
                <td class="text-center d-none d-sm-table-cell">3</td>
                <td class="text-center">Ab-Roller A</td>
                <td class="text-center">Tool</td>
                <td class="text-center">In-Maintenance</td>
                <td class="text-center">March 24, 2023 (3:30 PM)</td>
                <td class="text-center">Lim, Robbie John</td>
                <td class="text-center"><a href="view_rem.php" class="btn btn-outline-dark btn-sm">View All <i class='bx bx-show-alt' style="font-size:20px; vertical-align: middle;"></i></a></td>
                <td class="text-center"><button class="btn btn-outline-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bx bx-plus-circle'></i></button><button class="btn btn-outline-primary btn-circle btn-sm"><i class='bx bx-edit-alt'></i></button><button class="btn btn-outline-danger btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#delete"><i class='bx bx-trash' ></i></button></td>
                </tr>
            </tbody>
        </table>
    </div>
    


  </div>
</main>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Remarks</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Remarks for: Equipment Name</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Max of 20 characters"></textarea>
        </div>
        <div class="mb-3">
            <label for="formFileSm" class="form-label">Add photo (Not Required)</label>
            <input class="form-control form-control-sm" id="formFileSm" type="file">
        </div>
        Condition
        <br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label" for="inlineRadio1">Good</label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label" for="inlineRadio2">In-Maintenance</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Are you sure you want to delete this (Equipment Name)?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Yes</button>
        <button type="button" class="btn btn-secondary">No</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>