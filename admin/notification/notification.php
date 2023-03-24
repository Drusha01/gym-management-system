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

<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-md-4 pt-3">
  <div class="w-100">
    <h5 class="col-12 fw-bold mb-3 ps-2">Notification</h5>
    <!-- wag mo to problemahin for reference lng tanggalin lng ito if tapos na -->
    <div class="col-12 d-grid d-lg-inline-flex justify-content-lg-end form-group h-50 pb-3 px-3">
        <a href="referencenotif.php" class="btn btn-success" role="button">Show Reference</a>
    </div>

    <div class="card border-0 shadow rounded-3">
        <table id="example"class="table">
            <thead>
                <tr>
                    <th colspan="2">
                        <div class="box-title py-2 d-flex justify-content-end">
                            <button type="button" class="btn bg-transparent">Mark as All Read</button>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                        <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/partial.png"
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
                        <span class="d-flex justify-content-end">
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
                        </span>
                        <div class="text-end text-muted pt-1">5 min Ago</div>
                    </td>
                </tr>
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/trainer_not.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Trainer</div>
                                <div class="fw-light">Your Trainer (name) is not available for today.</div>
                            </div>
                        </div>
                    </td>
                    <td class="col-1">
                        <span class="d-flex justify-content-end">
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
                        </span>
                        <div class="text-end text-muted pt-1">1 hr Ago</div>
                    </td>
                </tr>
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/partial.png"
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
                        <span class="d-flex justify-content-end">
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
                        </span>
                        <div class="text-end text-muted pt-1">5 min Ago</div>
                    </td>
                </tr>
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/payment.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Payment</div>
                                <div class="fw-light">Your Payment for Gym-Use is now verified. This offer is now Paid. (Ganito Kapag Separate).</div>
                            </div>
                        </div>
                    </td>
                    <td class="col-1">
                        <span class="d-flex justify-content-end">
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
                        </span>
                        <div class="text-end text-muted pt-1">5 min Ago</div>
                    </td>
                </tr>
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/payment.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Payment</div>
                                <div class="fw-light">Your Payment is now verified. The Status of this is now Paid.(ganito kapag as one pili ka na lng)</div>
                            </div>
                        </div>
                    </td>
                    <td class="col-1">
                        <span class="d-flex justify-content-end">
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
                        </span>
                        <div class="text-end text-muted pt-1">1 hr Ago</div>
                    </td>
                </tr>
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/activated.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Activate</div>
                                <div class="fw-light">Your Availed Subscriptions is now Active.</div>
                            </div>
                        </div>
                    </td>
                    <td class="col-1">
                        <span class="d-flex justify-content-end">
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
                        </span>
                        <div class="text-end text-muted pt-1">1 hr Ago</div>
                    </td>
                </tr>
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/trainer.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Trainer</div>
                                <div class="fw-light">Your Trainer (name), is available for today.</div>
                            </div>
                        </div>
                    </td>
                    <td class="col-1">
                        <span class="d-flex justify-content-end">
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
                            
                        </span>
                        <div class="text-end text-muted pt-1">1 hr Ago</div>
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
            <!-- No Notifcations -->
            <!-- <tbody>
                <tr>
                    <td colspan="2"class="text-center fw-bold">Notifications will Appear Here</td>
                </tr>
            </tbody> -->
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<script>

</script>
</html>