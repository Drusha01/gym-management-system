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
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="box shadow rounded bg-white mb-3">
                        <div class="box-title border-bottom p-3 d-flex justify-content-end">
                            <button type="button" class="btn bg-transparent">Mark as All Read</button>
                        </div>
                        <div class="box-body p-0">
                            <div class="py-3 px-2 p-lg-3 d-flex align-items-center border-bottom bg-danger bg-opacity-10">
                                <div class="dropdown-list-image "><img src="https://cdn-icons-png.flaticon.com/512/814/814647.png" alt="" /></div>
                                <div class="fw-bold ms-1 ms-lg-4">
                                    <div class="text-truncate">Locker</div>
                                    <div class="fw-light">Your Locker is nearing Expiration.</div>
                                </div>
                                <span class="ms-auto mb-auto">
                                    <div class="btn-group rounded">
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
                            </div>

                            <div class="py-3 px-2 p-lg-3 d-flex align-items-center border-bottom bg-danger bg-opacity-10">
                                <div class="dropdown-list-image "><img src="https://cdn-icons-png.flaticon.com/512/9775/9775707.png" alt="" /></div>
                                <div class="fw-bold ms-1 ms-lg-4">
                                    <div class="text-truncate">Account</div>
                                    <div class="fw-light">Your Account has been verified.</div>
                                </div>
                                <span class="ms-auto mb-auto">
                                    <div class="btn-group rounded">
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
                            </div>

                            <div class="py-3 px-2 p-lg-3 d-flex align-items-center border-bottom">
                                <div class="dropdown-list-image "><img src="https://cdn-icons-png.flaticon.com/512/1019/1019709.png" alt="" /></div>
                                <div class="fw-bold ms-1 ms-lg-4">
                                    <div class="text-truncate">Payment</div>
                                    <div class="fw-light">Your Payment for Gym-Use is now verified.</div>
                                </div>
                                <span class="ms-auto mb-auto">
                                    <div class="btn-group rounded">
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
                            </div>

                            <div class="py-3 px-2 p-lg-3 d-flex align-items-center border-bottom bg-danger bg-opacity-10">
                                <div class="dropdown-list-image "><img src="https://cdn-icons-png.flaticon.com/512/833/833602.png" alt="" /></div>
                                <div class="fw-bold ms-1 ms-lg-4">
                                    <div class="text-truncate">Pending</div>
                                    <div class="fw-light">Trainer Subscription is waiting for your payment directly on the gym.</div>
                                </div>
                                <span class="ms-auto mb-auto">
                                    <div class="btn-group rounded">
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
                            </div>

                            <div class="py-3 px-2 p-lg-3 d-flex align-items-center border-bottom">
                                <div class="dropdown-list-image "><img src="https://cdn-icons-png.flaticon.com/512/5267/5267950.png" alt="" /></div>
                                <div class="fw-bold ms-1 ms-lg-4">
                                    <div class="text-truncate">Cancelled</div>
                                    <div class="fw-light">You have cancelled your Payment for Locker Subscription.</div>
                                </div>
                                <span class="ms-auto mb-auto">
                                    <div class="btn-group rounded">
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
                            </div>

                            <div class="py-3 px-2 p-lg-3 d-flex align-items-center border-bottom">
                                <div class="dropdown-list-image "><img src="https://cdn-icons-png.flaticon.com/512/4334/4334479.png" alt="" /></div>
                                <div class="fw-bold ms-1 ms-lg-4">
                                    <div class="text-truncate">Overdue</div>
                                    <div class="fw-light">Your Payment for Trainer has an outstanding balance of ₱900.00.</div>
                                </div>
                                <span class="ms-auto mb-auto">
                                    <div class="btn-group rounded">
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
                            </div>

                            <div class="py-3 px-2 p-lg-3 d-flex align-items-center border-bottom">
                                <div class="dropdown-list-image"><img src="https://cdn-icons-png.flaticon.com/512/9775/9775707.png" alt="" /></div>
                                <div class="fw-bold ms-1 ms-lg-4">
                                    <div class="text-truncate">Partial</div>
                                    <div class="fw-light">You have only paid a partial amount for Gym-Use Subscription.</div>
                                </div>
                                <span class="ms-auto mb-auto">
                                    <div class="btn-group rounded">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container d-flex justify-content-center justify-content-lg-end pb-3">
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