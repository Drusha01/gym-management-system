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
    <h5 class="col-12 fw-bold mb-3">Maintenance</h5>
    <div class="container-fluid">
        <div class="row g-2 mb-2 mt-1">
            <div class="form-group col-12 col-sm-8 table-filter-option">
                <label for="keyword">Search</label>
                <input type="text" name="keyword" id="keyword" placeholder="Enter Name Here" class="form-control ms-md-2">
            </div>
            <div class="table-responsive table-container table-1">
                <table id="table-2" class="table table-striped table-borderless table-custom" style="width:100%">
                    <thead class="bg-dark text-light">
                        <tr>
                        <th class="d-lg-none"></th>
                        <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
                        <th>NAME</th>
                        <th class="text-center ">PARTIAL PAYMENT</th>
                        <th class="text-center ">UNPAID</th>
                        <th scope="col" class="text-center">OVERDUE AMOUNT</th>
                        <th scope="col" class="text-center">TOTAL AMOUNT</th>
                        <th scope="col" class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th class="d-lg-none"></th>
                        <th scope="row" class="text-center d-none d-sm-table-cell">1</th>
                        <td>Trinidad, James Trinidad</td>
                        <td class="text-center">---</td>
                        <td class="text-center ">₱800.00</td>
                        <td class="text-center">₱100.00</td>
                        <td class="text-center">₱900.00</td>
                        <td class="text-center"><button class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">PAID</button></td>
                        </tr>

                        <tr>
                        <th class="d-lg-none"></th>
                        <th scope="row" class="text-center d-none d-sm-table-cell">2</th>
                        <td>Nicholas, Shania Gabrielle </td>
                        <td class="text-center">₱500.00 <button type="button" class="btn btn-sm btn-circle bg-transparent" data-bs-toggle="modal" data-bs-target="#ModalPartial"><i class='bx bx-plus-circle' ></i></button></td>
                        <td class="text-center ">₱300.00</td>
                        <td class="text-center">---</td>
                        <td class="text-center">₱300.00</td>
                        <td class="text-center"><button class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">PAID</button></td>
                        </tr>

                        <tr>
                        <th class="d-lg-none"></th>
                        <th scope="row" class="text-center d-none d-sm-table-cell">2</th>
                        <td>Lim, Robbie John</td>
                        <td class="text-center"><button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalPartial">Add amount</button></td>
                        <td class="text-center ">₱800.00</td>
                        <td class="text-center">---</td>
                        <td class="text-center">₱800.00</td>
                        <td class="text-center"><button class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">PAID</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure this Customer has already paid his debt?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalPartial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Partial Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col">
            <label for="inputZip" class="form-label">Enter Amount</label>
            <input type="number" class="form-control" id="inputZip">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Save Changes</button>
      </div>
    </div>
  </div>
</div>


</body>
</html>