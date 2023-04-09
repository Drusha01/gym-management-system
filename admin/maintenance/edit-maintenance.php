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
        if(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Modify'){
            if(isset($_GET['equipment_id']) && intval($_GET['equipment_id'])>0){
                require_once '../../classes/equipments.class.php';
                $equipmentsObj = new equipments();
                if(!$equipment_data = $equipmentsObj->fetch_with_id($_GET['equipment_id'])){
                    header('location:maintenance.php');
                }
            }
            if(isset($_POST['edit_maintenance']) && isset($_POST['equipment_id']) && isset($_POST['equipment_name']) && isset($_POST['equipment_type_details'])){
                $equipment_name = trim($_POST['equipment_name']);
                $equipment_type_details = trim($_POST['equipment_type_details']);
                require_once '../../classes/equipments.class.php';
                require_once '../../tools/functions.php';
                require_once '../../classes/equipment_types.class.php';
                $equipment_typesObj = new equipment_types();
                $equipmentsObj = new equipments();
                $equipment_typesObj->insert($equipment_type_details);
                if($equipmentsObj->update($_POST['equipment_id'],$equipment_name,$equipment_type_details)){
                    header('location:maintenance.php');
                }
            }
        }else if(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Read-Only'){
            header('location:maintenance.php');
        }else{
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
            <h5 class="col-8 col-lg-4 fw-bold mb-3">Edit Equipment</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="maintenance.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
        </div>
        <div class="container">
            <form action="" method="POST">
                <input type="number" name="equipment_id" value="<?php echo $_GET['equipment_id'] ?>" style="visibility:hidden;">
                <div class="row pb-2">  
                    <div class="col-sm-5">
                        <label class="pb-1" for="name_offer">Name of Equipment</label>
                        <input type="text" class="form-control" value="<?php echo $equipment_data['equipment_name']?>"  id="equipment_name" name="equipment_name"placeholder="Enter Equipment Name" required>
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-sm-5">
                        <label class="pb-1" for="equipment_condition_details">Type of Equipment</label>
                        <?php 
                        require_once '../../classes/equipment_types.class.php';
                        $equipment_typesObj = new equipment_types();

                        if($equipments_type_details = $equipment_typesObj->fetch_all()){
                            $counter=1;
                            foreach ($equipments_type_details as $key => $value) {
                                if($value['equipment_type_details'] == $equipment_data['equipment_type_details']){
                                    echo '
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="equipment_type_details" id="equipment_type_details" checked  value="'.$value['equipment_type_details'].'">
                                <label class="form-check-label" for="equipment_type_details">
                                '.$value['equipment_type_details'].'
                                </label>
                            </div>';
                                }else{
                                    echo '
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="equipment_type_details" id="equipment_condition_detail_'.$counter.'"  value="'.$value['equipment_type_details'].'">
                                <label class="form-check-label" for="equipment_condition_detail_'.$counter.'">
                                '.$value['equipment_type_details'].'
                                </label>
                            </div>';
                                }
                                
                            $counter++;
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="row d-flex flex-row-reverse">
                    <div class="col-12 col-lg-8 d-grid d-lg-flex pt-3 pt-lg-1">
                        <button type="submit" class="btn btn-success  border-0 rounded" name="edit_maintenance" value="edit_maintenance" id="submit" >Edit Equipment</button>
                    </div>
                </div>
            </form>
        </div>
  </div>
</main>
</body>


</html>