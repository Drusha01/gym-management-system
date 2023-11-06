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

    <div class="card border-0 shadow rounded-3">
        <div class="box-title d-flex justify-content-end mt-3">
            <button type="button" class="btn bg-transparent" id="mark_all_as_read">Mark as All Read</button>
        </div>
        <hr>
        <table id="example"class="table">
            <thead>
                <th class="p-0 m-0"></th>
                <th class="p-0 m-0"></th>
                <th class="p-0 m-0"></th>
            </thead>
            <tbody id="notification-content">
                <tr class="">
                    <td class="col-auto align-middle"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                    <td class="col-10 ps-3 ps-lg-4">
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
                    <td class="col-2">
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
                    <td class="col-auto align-middle"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                    <td class="col-10 ps-3 ps-lg-4">
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
                    <td class="col-2">
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
    <div id="custom-pagination" class="d-flex justify-content-center justify-content-lg-end">
    </div>
</main>
<script>
$('#example').DataTable({
    "dom": '<"top"f>rt<"bottom"lp><"clear">',
    "bLengthChange": false,
    "ordering": false,

    initComplete: (settings, json)=>{
        $('.dataTables_paginate').appendTo('#custom-pagination');
    },
});
</script>
</body>

</html>