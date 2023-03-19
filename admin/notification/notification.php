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
    <h5 class="col-12 fw-bold mb-3">Notification</h5>
    <div class="card border-0 shadow rounded-3">
        <table class="table">
            <thead>
                <tr>
                <th colspan="2">
                    <div class="box-title py-2 d-flex justify-content-end">
                        <button type="button" class="btn bg-transparent">Mark as All Read</button>
                    </div>
                </th>
                </tr>
            </thead>
            <!-- No Notifcations -->
            <!-- <tbody>
                <tr>
                    <td colspan="2" class="text-center fw-bold">No Notifications</td>
                </tr>
            </tbody> -->
            <tbody>
                <tr class="bg-danger bg-opacity-10">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center">
                        <img
                            src="https://cdn-icons-png.flaticon.com/512/814/814647.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Locker</div>
                                <div class="fw-light">Your Locker is nearing Expiration.</div>
                            </div>
                        </div>
                    </td>
                    <td class="col-1">
                        <span class="ms-auto mb-auto">
                            <div class="btn-group rounded ms-5">
                                <button type="button" class="btn btn-light btn-sm dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <button class="dropdown-item" type="button"><i class='bx bxs-trash'></i> Delete</button>
                                    <button class="dropdown-item" type="button"><i class='bx bx-book-reader'></i> Mark as Read</button>
                                </ul>
                            </div>
                            <br/>
                            <div class="text-end text-muted pt-1">3d</div>
                        </span>
                    </td>
                </tr>
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center">
                        <img
                            src="https://cdn-icons-png.flaticon.com/512/9775/9775707.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Account</div>
                                <div class="fw-light">Your Account has been verified.</div>
                            </div>
                        </div>
                    </td>
                    <td class="col-1">
                        <span class="ms-auto mb-auto">
                            <div class="btn-group rounded ms-5">
                                <button type="button" class="btn btn-light btn-sm dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <button class="dropdown-item" type="button"><i class='bx bxs-trash'></i> Delete</button>
                                    <button class="dropdown-item" type="button"><i class='bx bx-book-reader'></i> Mark as Read</button>
                                </ul>
                            </div>
                            <br/>
                            <div class="text-end text-muted pt-1">3d</div>
                        </span>
                    </td>
                </tr>
                <tr class="bg-danger bg-opacity-10">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center">
                        <img
                            src="https://cdn-icons-png.flaticon.com/512/8920/8920580.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Partial</div>
                                <div class="fw-light">You have only paid an amount of ₱500.00, you still have an outstanding balance of ₱2500.00.</div>
                            </div>
                        </div>
                    </td>
                    <td class="col-1">
                        <span class="ms-auto mb-auto">
                            <div class="btn-group rounded ms-5">
                                <button type="button" class="btn btn-light btn-sm dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <button class="dropdown-item" type="button"><i class='bx bxs-trash'></i> Delete</button>
                                    <button class="dropdown-item" type="button"><i class='bx bx-book-reader'></i> Mark as Read</button>
                                </ul>
                            </div>
                            <br/>
                            <div class="text-end text-muted pt-1">3d</div>
                        </span>
                    </td>
                </tr>
                <tr class="bg-danger bg-opacity-10">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center">
                        <img
                            src="https://cdn-icons-png.flaticon.com/512/1019/1019709.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Payment</div>
                                <div class="fw-light">Your Payment for Gym-Use is now verified. This offer is now Paid.</div>
                            </div>
                        </div>
                    </td>
                    <td class="col-1">
                        <span class="ms-auto mb-auto">
                            <div class="btn-group rounded ms-5">
                                <button type="button" class="btn btn-light btn-sm dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <button class="dropdown-item" type="button"><i class='bx bxs-trash'></i> Delete</button>
                                    <button class="dropdown-item" type="button"><i class='bx bx-book-reader'></i> Mark as Read</button>
                                </ul>
                            </div>
                            <br/>
                            <div class="text-end text-muted pt-1">3d</div>
                        </span>
                    </td>
                </tr>
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center">
                        <img
                            src="https://cdn-icons-png.flaticon.com/512/4334/4334479.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Overdue</div>
                                <div class="fw-light">You have an overdue amount of ₱4200.00.</div>
                            </div>
                        </div>
                    </td>
                    <td class="col-1">
                        <span class="ms-auto mb-auto">
                            <div class="btn-group rounded ms-5">
                                <button type="button" class="btn btn-light btn-sm dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <button class="dropdown-item" type="button"><i class='bx bxs-trash'></i> Delete</button>
                                    <button class="dropdown-item" type="button"><i class='bx bx-book-reader'></i> Mark as Read</button>
                                </ul>
                            </div>
                            <br/>
                            <div class="text-end text-muted pt-1">3d</div>
                        </span>
                    </td>
                </tr>
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center">
                        <img
                            src="https://cdn-icons-png.flaticon.com/512/4091/4091120.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Activated</div>
                                <div class="fw-light">Your Availed Subscriptions is now active.</div>
                            </div>
                        </div>
                    </td>
                    <td class="col-1">
                        <span class="ms-auto mb-auto">
                            <div class="btn-group rounded ms-5">
                                <button type="button" class="btn btn-light btn-sm dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <button class="dropdown-item" type="button"><i class='bx bxs-trash'></i> Delete</button>
                                    <button class="dropdown-item" type="button"><i class='bx bx-book-reader'></i> Mark as Read</button>
                                </ul>
                            </div>
                            <br/>
                            <div class="text-end text-muted pt-1">3d</div>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container d-flex justify-content-center justify-content-lg-end pb-3 pt-4">
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
</main>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<script>
      
</script>
</html>