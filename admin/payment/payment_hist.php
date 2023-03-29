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
            <h5 class="col-8 col-lg-4 fw-bold mb-3">Payment History</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="paid.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
        </div>
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                        <img src="../../images/acc_img.png" alt="Admin" class="rounded-circle" width="150">
                        <div class="mt-3">
                            <h4>James_No_Legday</h4>
                            <p class="text-dark fw-bold mb-1">Status: <span class="text-secondary fw-normal">Active</span></p>
                            <p class="text-muted font-size-sm">San Jose, Zamboanga City</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                Trinidad, James Lorenz
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Gender</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                Male
                            </div>
                        </div>
                    </div>
                        <hr>
                    <div class="row">
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                San Jose, Zamboanga City
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Phone Number</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                0921-234-5678
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Age</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                22 Years Old
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-9 text-secondary">
                                James_No_Legday@gmail.com
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Birth Date</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                November 14, 2000
                            </div>
                        </div>
                        <div class="col">
                            <div class="col">
                                <h6 class="mb-0">Account Created</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                December 20, 2019
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row pb-3">
        <div class="form-group col-12 col-sm-5 table-filter-option">
            <label for="keyword">Search</label>
            <input type="text" name="keyword" id="keyword" placeholder="Enter Order_ID" class="form-control ms-md-2">
        </div>
        <div class="col-12 col-sm-2 form-group table-filter-option">
            <label>Type</label>
            <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="Subscription">Subscription</option>
                <option value="Walk-In">Walk-In</option>
            </select>
        </div>
    </div>
    <div class="table-responsive table-container table-hist">
    </div>
  </div>
</main>
<!-- Modal -->
<div class="modal fade" id="hist-view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Availed Subscription (March 26,2023)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive ">
                    <table id="" class="table table-striped table-bordered " style="width:100%;border: 2px solid grey;">
                        <thead class="table-secondary">
                            <tr>
                                <th class="d-lg-none"></th>
                                <th class="text-center">#</th>
                                <th class="ps-3">Payment Description</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Discount</th>
                                <th class="text-center">Penalties Due</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="d-lg-none"></td>
                                <td class="text-center">1</td>
                                <td class="ps-3">1-Month Gym-Use</td>
                                <td class="text-end">₱800.00</td>
                                <td class="text-center">None</td>
                                <td class="text-center">None</td>
                                <td class="text-end">₱800.00</td>
                            </tr>

                            <tr>
                                <td class="d-lg-none"></td>
                                <td class="text-center">2</td>
                                <td class="ps-3">1-Month Locker</td>
                                <td class="text-end">₱100.00</td>
                                <td class="text-center">None</td>
                                <td class="text-center">None</td>
                                <td class="text-end">₱100.00</td>
                            </tr>
                        </tbody>
                        <tfoot class="table-success">
                            <tr>
                                <td class="d-lg-none"></td>
                                <td colspan="3" class="text-end fw-bolder fs-5 ">Total:</td>
                                <td class="text-end">₱</td>
                                <td class="text-end">₱</td>
                                <td class="text-end fw-bolder fs-5">₱900</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success">Show</button>
                    <button type="button" class="btn btn-outline-dark">Download</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
<script>
    $.ajax({
        type: "GET",
        url: 'paid_hist_tbl.php',
        success: function(result)
        {
            $('div.table-hist').html(result);
            dataTable = $("#hist").DataTable({
                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                responsive: true,
            });
            $('input#keyword').on('input', function(e){
                var status = $(this).val();
                dataTable.columns([1]).search(status).draw();
            })
            $('select#categoryFilter').on('change', function(e){
            var status = $(this).val();
            dataTable.columns([2]).search(status).draw();
            })
            new $.fn.dataTable.FixedHeader(dataTable);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });
</script>
</html>