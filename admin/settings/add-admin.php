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
    <div class="row">
        <h5 class="col-7 col-lg-4 fw-bold mb-3 ms-2">Add User</h5>
        <a class="col text-decoration-none text-black m-0" aria-current="page" href="settings.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
    </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs application">
                <li class="nav-item active ">
                    <a class="nav-link" href="#tab-exist" data-bs-toggle="tab">Existing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab-new" data-bs-toggle="tab">New</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show fade" id="tab-exist">
                    <?php require_once 'add-new-exist.php'; ?>
                </div>
                <div class="tab-pane show fade" id="tab-new">
                    <?php require_once 'add-new-user.php'; ?>
                </div>
            </div>
        </div>


<div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Existing User to Trainer</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label for="message" class="form-label" id ="modal_message">Are you sure you want to XXXXXX existing user to Trainer? </label>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="button" data-bs-toggle="modal" id="user_id_modal" value="" data-bs-dismiss="modal" onclick="add_modal_trainer()">Yes</button>
                    <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="secondModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Succesfully Added!</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Existing User is added to Trainer</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="errormodal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adding trainer failed!</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Existing User is failed to add to trainer</p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</script>
<script>
$(".nav-item").on("click", function(){
            $(".nav-item").removeClass("active");
            $(this).addClass("active");

        });
</script>
</html>