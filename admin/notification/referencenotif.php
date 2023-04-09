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
  <div class="w-100 px-lg-3">
    <div class="row">
        <h5 class="col-6 fw-bold mb-3 mt-3">Reference</h5>
        <a class="col-auto text-decoration-none text-black mb-3 mt-3" aria-current="page" href="notification.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
    </div>

    <h5 class="col-12 fw-normal mb-3 mt-3">Notifications (Customer -> Admin)</h5>
    <div class="card border-0 shadow-lg rounded-3">
        <table class="table">
            <tbody>
                <!-- Customer Avail -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/avail.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Avail</div>
                                <div class="fw-light">Customer XXXXX has availed gym-use, trainer, locker, and program. (Kung pwde as one if di kaya separate na lng).</div>
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
                <!-- Customer avail -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/avail.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Avail</div>
                                <div class="fw-light">Customer XXXXX has availed Gym-Use. (Ganito Kapag Separate).</div>
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
                <!-- Customer Cancel -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/cancelled.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Cancel</div>
                                <div class="fw-light">Customer XXXX has cancelled availing their subscription.</div>
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
                <!-- Customer Renew -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/renew.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Renew</div>
                                <div class="fw-light">Customer XXXX has renew their previous subscriptions.</div>
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
                <!-- Customer Renew New -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/renew_new.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Renew</div>
                                <div class="fw-light">Customer XXXX has renew with new subscriptions.</div>
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
    <br>

    <h5 class="col-12 fw-normal mb-3 mt-3">Notifications (Admin -> Customer)</h5>
    <div class="card border-0 shadow-lg rounded-3">
        <table class="table">
            <tbody>
                <!-- Admin Partial -> Notify Customer -->
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
                <!-- Admin payment is now paid -> Notify Customer -->
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
                <!-- Admin payment is now paid -> Notify Customer -->
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
                <!-- Admin offer is now active -> Notify Customer -->
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
                <!-- Admin Trainer -> Notify Customer -->
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
                <!-- Admin (not available) -> Notify Customer -->
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
            </tbody>
        </table>
    </div>
    <br>

    <h5 class="col-12 fw-normal mb-3 mt-3">Notifications (Admin or Customer-> Trainer)</h5>
    <div class="card border-0 shadow-lg rounded-3">
        <table class="table">
            <tbody>
                <!-- Admin added trainer -> notify trainer -->
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
                                <div class="fw-light">Congratulations! You are now a trainer. Go to the to train tab to know who you are going to train.</div>
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
                <!-- Admin deleted trainer -> notify trainer -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/change.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Trainer</div>
                                <div class="fw-light">Your account is now a customer type.</div>
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
                <!-- Customer availed trainer -> notify trainer -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/choose.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Trainer</div>
                                <div class="fw-light">Congratulations! Customer (name), chose you to be their trainer.</div>
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
    <br>

    <h5 class="col-12 fw-normal mb-3 mt-3">Notifications (System -> Customer)</h5>
    <div class="card border-0 shadow-lg rounded-3">
        <table class="table">
            <tbody>
                <!-- System Nearing Expiration -> Notify Customer -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/expiration.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Expiration</div>
                                <div class="fw-light">Your subscription of (offer) only has 5 days left.</div>
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
                <!-- System Unpaid -> Notify Customer -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/unpaid.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Unpaid</div>
                                <div class="fw-light">You have an unpaid amount of ₱4200.00.</div>
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
                <!-- System overdue -> Notify Customer -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/overdue.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Overdue</div>
                                <div class="fw-light">You have an overdue amount of ₱4200.00. (ito total na deresto with the unpaid amount and overdue amount).</div>
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
                        <div class="text-end text-muted pt-1">1 Day Ago</div>
                    </td>
                </tr>
                <!-- System Acc Verification -> Notify Customer -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/verified.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Account</div>
                                <div class="fw-light">Your Account is now verified.</div>
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
                        <div class="text-end text-muted pt-1">03-23-2023</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>

    <h5 class="col-12 fw-normal mb-3 mt-3">Notifications (Staff -> Admin)</h5>
    <h6 class="col-12 fw-light mb-3 mt-3">Notifications (Staff -> Admin):Announcement</h6>
    <div class="card border-0 shadow-lg rounded-3">
        <table class="table">
            <tbody>
                <!-- Staff add announce -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), added a new Announcement.</div>
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
                <!-- Staff modified announcement -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), modified an Announcement.</div>
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
                <!-- Staff delete announcement -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), deleted an Announcement.</div>
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
            </tbody>
        </table>
    </div>

    <h6 class="col-12 fw-light mb-3 mt-3">Notifications (Staff -> Admin):Attendance</h6>
    <div class="card border-0 shadow-lg rounded-3">
        <table class="table">
            <tbody>
                <!-- Staff force time-out -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), Forced Time-Out Customer (Name).</div>
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
                <!-- Staff delete attendance -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), deleted the attendance of Customer (Name).</div>
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
            </tbody>
        </table>
    </div>

    <h6 class="col-12 fw-light mb-3 mt-3">Notifications (Staff -> Admin):Locker</h6>
    <div class="card border-0 shadow-lg rounded-3">
        <table class="table">
            <tbody>
                <!-- Staff modify -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), modified the locker of (Customer Name).</div>
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
            </tbody>
        </table>
    </div>
    <h6 class="col-12 fw-light mb-3 mt-3">Notifications (Staff -> Admin):Offers</h6>
    <div class="card border-0 shadow-lg rounded-3">
        <table class="table">
            <tbody>
                <!-- Staff offers add -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), added a new offer.</div>
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
                <!-- Staff offers modify -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), modified the offer (offer name). (Kung Specific Ganito)</div>
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
                <!-- Staff offers modify -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), modified an offer. (Kung ayaw mo specific)</div>
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
                <!-- Staff offers delete -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), deleted the offer (offer name).</div>
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
                <!-- Staff offers delete -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), deleted an offer. (Ganito kapag ayaw mo specific)</div>
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
            </tbody>
        </table>
    </div>

    <h6 class="col-12 fw-light mb-3 mt-3">Notifications (Staff -> Admin):Avail</h6>
    <div class="card border-0 shadow-lg rounded-3">
        <table class="table">
            <tbody>
                <!-- Staff add avail subscription -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), Availed Subscription for, (customer name).</div>
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
                <!-- Staff activated subs -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), Activated Subscription for, (customer name).</div>
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
                <!-- Staff add avail walk-in -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), added a customer, (customer name) in Walk-In.</div>
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
                <!-- Staff deleted avail walk-in -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), deleted a customer, (customer name) in Walk-In.</div>
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
            </tbody>
        </table>
    </div>

    <h6 class="col-12 fw-light mb-3 mt-3">Notifications (Staff -> Admin):Accounts</h6>
    <div class="card border-0 shadow-lg rounded-3">
        <table class="table">
            <tbody>
                <!-- Staff add account -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), added a new customer account.</div>
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
                <!-- Staff add account -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), added a new customer account.(Customer Name).</div>
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
                <!-- Staff modified customer account -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), modified the customer account of (name).</div>
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
                <!-- Staff delete customer acc -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), deleted the customer account of (name).</div>
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
            </tbody>
        </table>
    </div>

    <h6 class="col-12 fw-light mb-3 mt-3">Notifications (Staff -> Admin):Trainer</h6>
    <div class="card border-0 shadow-lg rounded-3">
        <table class="table">
            <tbody>
                <!-- Staff add account trainer-> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), added a new trainer account. (trainer acc name).</div>
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
                <!-- Staff modified account trainer -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), modified the customer account of (name).</div>
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
                <!-- Staff delete account trainer-> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), deleted the trainer account of (name).</div>
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
            </tbody>
        </table>
    </div>

    <h6 class="col-12 fw-light mb-3 mt-3">Notifications (Staff -> Admin):Payment</h6>
    <div class="card border-0 shadow-lg rounded-3">
        <table class="table">
            <tbody>
                <!-- Staff payment paid-> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), change the payment of (name of customer) into Paid.</div>
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
                <!-- Staff payment modify-> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), modified payment of (name of customer).</div>
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
            </tbody>
        </table>
    </div>

    <h6 class="col-12 fw-light mb-3 mt-3">Notifications (Staff -> Admin):Maintenance</h6>
    <div class="card border-0 shadow-lg rounded-3">
        <table class="table">
                <!-- Staff Maintenance add -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), added a new Equipment.</div>
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
                <!-- Staff Maintenance modify -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), modified the equipment (equipment name).</div>
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
                <!-- Staff Maintenance delete -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), deleted the equipment (equipment name).</div>
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
                <!-- Staff Maintenance deleted remarks -> Notify Admin -->
                <tr class="">
                    <td class="col-11 ps-3 ps-lg-4">
                    <div class="d-flex align-items-center mt-1">
                        <img
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), deleted a Remark on Equipment (Name).</div>
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
                            src="../../images/icons_notif/logs.png"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                            <div class="fw-bold ms-4">
                                <div class="text-truncate">Logs</div>
                                <div class="fw-light">Staff (name), added a Remark on Equipment (Name).</div>
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
            </tbody>
        </table>
    </div>
    <br>
    <h5 class="col-12 fw-normal mb-3 mt-3">Example of Di pa na mark as read</h5>
    <div class="card border-0 shadow-lg rounded-3">
        <table class="table">
            <!-- No Notifcations -->
            <!-- <tbody>
                <tr>
                    <td colspan="2"class="text-center fw-bold">Notifications will Appear Here</td>
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
                        <div class="text-end text-muted pt-1">3d</div>
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
                        <div class="text-end text-muted pt-1">3d</div>
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
                        <div class="text-end text-muted pt-1">3d</div>
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
                        <div class="text-end text-muted pt-1">3d</div>
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
                        <div class="text-end text-muted pt-1">3d</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
  </div>


</body>





</html>