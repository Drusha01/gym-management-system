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
            <h5 class="col-7 col-lg-4 fw-bold mb-3 ms-2">View Payment</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="payment.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
        </div>
            <div class="container-fluid">
                <div class="row pb-2">
                    <div class="col-12 col-lg-10">
                        <h5 class="fw-bold ">Trinidad, James Lorenz</h5>
                    </div>
                    <div class="col-lg-1 d-none d-lg-flex justify-content-end">
                        <div class="btn-group dropstart">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Save As
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="min-width:30px;">
                            <li><button class="dropdown-item d-flex align-items-center justify-content-end" type="button">Word <i class='bx bxs-file-doc fs-5'></i></button></li>
                            <li><button class="dropdown-item d-flex align-items-center justify-content-end" type="button">PDF <i class='bx bxs-file-pdf fs-5' ></i></button></li>
                            <li><button class="dropdown-item d-flex align-items-center justify-content-end" type="button">Print <i class='bx bx-printer fs-5' ></i></button></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-1 d-grid d-lg-flex justify-content-lg-end">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmpayment">Confirm</button>
                    </div>
                </div>
                
              <div class="table-responsive table-1">
                <table id="table-1" class="table table-striped table-bordered " style="width:100%;border: 2px solid grey;">
                    <thead class="table-secondary">
                        <tr>
                            <th class="d-lg-none"></th>
                            <th class="text-center">#</th>
                            <th class="ps-3">Payment Description</th>
                            <th class="text-center">Discount</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Penalties Due</th>
                            <th class="text-center">Paid Amount</th>
                            <th class="text-center">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="d-lg-none"></td>
                            <td class="text-center">1</td>
                            <td class="ps-3">1-Month Gym-Use Subscription</td>
                            <td class="text-center"><button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#add_discount">Add Discount</button></td>
                            <td class="text-end">₱800</td>
                            <td class="text-end">None</td>
                            <td class="text-end">₱800</td>
                            <td class="text-end">₱0</td>
                        </tr>
                        <tr>
                            <td class="d-lg-none"></td>
                            <td class="text-center">2</td>
                            <td class="ps-3">1-Month Trainer Subscription</td>
                            <td class="text-center"><button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#add_discount">Add Discount</button></td>
                            <td class="text-end">₱1500</td>
                            <td class="text-end">₱100</td>
                            <td class="text-end">₱300</td>
                            <td class="text-end">₱1200</td>
                        </tr>
                        <tr>
                            <td class="d-lg-none"></td>
                            <td class="text-center">3</td>
                            <td class="ps-3">1-Month Locker Subscription</td>
                            <td class="text-center"><button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#add_discount">Add Discount</button></td>
                            <td class="text-end">₱100</td>
                            <td class="text-end">None</td>
                            <td class="text-end">₱100</td>
                            <td class="text-end">₱0</td>
                        </tr>
                        <tr>
                            <td class="d-lg-none"></td>
                            <td class="text-center">4</td>
                            <td class="ps-3">Zumba</td>
                            <td class="text-end"><button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#edit_discount"><i class='bx bx-edit align-middle'></i></button>%20</td>
                            <td class="text-end">₱500</td>
                            <td class="text-end">None</td>
                            <td class="text-end">₱300</td>
                            <td class="text-end">₱100</td>
                        </tr>
                    </tbody>
                    <tfoot class="table-success">
                        <tr>
                            <td class="d-lg-none"></td>
                            <td colspan="3" class="text-end fw-bolder fs-5 ">Total:</td>
                            <td class="text-end">₱2900</td>
                            <td class="text-end">₱100</td>
                            <td class="text-end">₱1500</td>
                            <td class="text-end fw-bolder fs-5">₱1300</td>
                        </tr>
                    </tfoot>
                </table>
              </div>
            </div>
            <div class="container">
                <p class="fw-bolder fs-5">Partial Payment</p>
                <hr>
                <div class="row">
                    <div class="col-6 col-lg-1 d-flex align-items-center">
                        <label for="partialfixed" class="text-nowrap pe-3">Partial Fixed</label>
                    </div>
                    <div class="col-6 col-lg-3 d-flex align-items-center">
                        <input type="number" class="form-control" id="partialfixed" placeholder="₱00.00">
                    </div>
                    <div class="col-6 col-lg-1 d-flex align-items-center pt-3 pt-lg-0">
                        <label for="partialpercent" class=" pe-3">Partial Percentage</label>
                    </div>
                    <div class="col-6 col-lg-3 d-flex align-items-center pt-3 pt-lg-0">
                        <input type="number" class="form-control" id="partialpercent" placeholder="00%">
                    </div>
                    
                    <div class="col-12 col-lg-2 d-grid d-lg-inline pt-3 pt-lg-1">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmpartial">Confirm</button>
                    </div>
                </div>
            </div>
            <div class="container pt-3">
                <p class="fw-bolder fs-5">Void Payment</p>
                <hr>
                <div class="row">
                    <div class="col-6 col-lg-1 d-flex align-items-center">
                        <label for="voidfixed" class="text-nowrap pe-3">Void Fixed</label>
                    </div>
                    <div class="col-6 col-lg-3 d-flex align-items-center">
                        <input type="number" class="form-control" id="voidfixed" placeholder="₱00.00">
                    </div>
                    <div class="col-6 col-lg-1 d-flex align-items-center pt-3 pt-lg-0">
                        <label for="voidpercent" class=" pe-3">Void Percentage</label>
                    </div>
                    <div class="col-6 col-lg-3 d-flex align-items-center pt-3 pt-lg-0">
                        <input type="number" class="form-control" id="voidpercent" placeholder="00%">
                    </div>
                    
                    <div class="col-12 col-lg-2 d-grid d-lg-inline pt-3 pt-lg-1">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmvoid">Confirm</button>
                    </div>
                </div>
            </div>
    </div>
</main>

<div class="modal fade" id="confirmpartial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Partial Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        User: Drusha01
        <br>
        <div class="form-group pt-1">
            <label for="pass">Password:</label>
            <input type="password" class="form-control" id="pass">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn-success" data-bs-dismiss="modal">Confirm</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="confirmvoid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Void Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        User: Drusha01
        <br>
        <div class="form-group pt-1">
            <label for="pass">Password:</label>
            <input type="password" class="form-control" id="pass">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn-success" data-bs-dismiss="modal">Confirm</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="confirmpayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Full Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        User: Drusha01
        <br>
        <div class="form-group pt-1">
            <label for="pass">Password:</label>
            <input type="password" class="form-control" id="pass">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn-success" data-bs-dismiss="modal">Confirm</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="add_discount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Discount</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-6 col-lg-2 d-flex align-items-center">
                    <label for="fixeddisc" class="pe-3">Fixed</label>
                </div>
                <div class="col-6 col-lg-3 d-flex align-items-center">
                    <input type="number" class="form-control" id="fixeddisc" placeholder="₱00.00">
                </div>
                <div class="col-6 col-lg-2 d-flex align-items-center pt-3 pt-lg-0">
                    <label for="fixedpercent" class=" pe-3">Percent</label>
                </div>
                <div class="col-6 col-lg-3 d-flex align-items-center pt-3 pt-lg-0">
                    <input type="number" class="form-control" id="fixedpercent" placeholder="00%">
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn-success" data-bs-dismiss="modal">Confirm</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="edit_discount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Discount</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="row d-flex justify-content-center">
                <div class="col-6 col-lg-2 d-flex align-items-center">
                    <label for="fixeddisc" class="pe-3">Fixed</label>
                </div>
                <div class="col-6 col-lg-3 d-flex align-items-center">
                    <input type="number" class="form-control" id="fixeddisc" placeholder="₱00.00">
                </div>
                <div class="col-6 col-lg-2 d-flex align-items-center pt-3 pt-lg-0">
                    <label for="fixedpercent" class=" pe-3">Percent</label>
                </div>
                <div class="col-6 col-lg-3 d-flex align-items-center pt-3 pt-lg-0">
                    <input type="number" class="form-control" id="fixedpercent" placeholder="00%">
                </div>
            </div>
            <div class="d-flex">
              <hr class="my-auto flex-grow-1">
              <div class="px-4">or</div>
              <hr class="my-auto flex-grow-1">
            </div>
            <div class="text-center ">
                <button type="button" class="btn btn-danger" >Remove Discount <i class='bx bx-minus-circle fs-5' style="vertical-align: middle;"></i></button>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn-success" data-bs-dismiss="modal">Confirm</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>