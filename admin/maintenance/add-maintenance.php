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
        
        if(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Modify'){
            require_once '../../classes/equipments.class.php';
            require_once '../../tools/functions.php';
            $equipmentsObj = new equipments();
        
            if(isset($_POST['edit_maintenance']) ){
                // validate
                if(validate_equipment($_POST)){
                    // update
                    if($equipmentsObj->add($_POST['equipment_name'],$_POST['equipment_quantity'],$_POST['equipment_condition_details'])){
                        header('location:maintenance.php');
                    }
                }else{
                    // handle error
                }
            }
        }else if(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Read-Only'){
            header('location:maintenance.php');
        }else{
            //do not load the page
            header('location:../dashboard/dashboard.php');
        }
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
        <h5 class="col-7 col-lg-4 fw-bold mb-3">Edit Equipment</h5>
        <a class="col text-decoration-none text-black m-0" aria-current="page" href="maintenance.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
    </div>
    <div class="container">
        <form action="" method="POST">
            <div class="row pb-2">
                <div class="col-sm-5">
                    <label class="pb-1" for="name_offer">Name of Equipment</label>
                    <input type="text" class="form-control" value=""  id="equipment_name" name="equipment_name"placeholder="Enter Equipment Name" required>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-sm-5">
                    <label class="pb-1" for="equipment_condition_details">Condition</label>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="equipment_condition_detail" id="equipment_condition_details" checked  value="Good">
                    <label class="form-check-label" for="equipment_condition_details">
                        Good
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="equipment_condition_detail" id="equipment_condition_detail"  value="In-Maintenance">
                    <label class="form-check-label" for="equipment_condition_detail">
                        In-Maintenance
                    </label>
                    </div>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-3 col-lg-1">
                    <label class="pb-1" for="name_offer">Quantity</label>
                    <input type="number" class="form-control" value="" id="offer_duration" placeholder="quantity" name="equipment_quantity" min="1" required>
                </div>
            </div>
            <div class="row d-flex flex-row-reverse">
                <div class="col-12 col-lg-8 d-grid d-lg-flex pt-3 pt-lg-1">
                    <button type="submit" class="btn btn-success  border-0 rounded" name="add_maintenance" value="add_maintenance" id="submit">Add Equipment</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</main>


</body>
</html>