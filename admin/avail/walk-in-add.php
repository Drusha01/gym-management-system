<?php 
session_start();
if(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Modify'){

}elseif(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Read-Only'){
    //
    header('location:../dashboard/dashboard.php');
}else{
    //do not load the page
    header('location:../dashboard/dashboard.php');
}
?>

<div class="container-fluid card mt-3">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="form-group rounded">
                    <div class="row">
                        <div class="col-12">
                            <label for="users" class="pb-2">Search</label>
                            <select class="select2" name='users' id="users" onchange="users_selected_change()" style="width:100%;">
                                <option value="None" selected>Select Customer Name</option> 
                                <?php 
                                require_once('../../classes/users.class.php');

                                $userObj = new users();

                                if($users_data = $userObj->fetch_all_users(0,100000)){
                                    foreach ($users_data as $key => $value) {
                                        # code...
                                        echo '<option value="'.$value['user_id'].'" >'.htmlentities($value['user_name']).' ('.htmlentities($value['user_fullname']).') </option>';
                                    }

                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-1 d-flex align-items-end mb-1 pt-3">
                <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#ModalProf"><i class='bx bx-question-mark'></i></button>
            </div>
            <div class="col-6 col-lg-5 d-flex align-items-end mb-1">
                <div class="form-group rounded">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="Gym-Use" name="Gym-Use"  onchange="gym_use_changed()">
                        <label class="form-check-label" for="Gym-Use">
                            Gym-Use
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="form-group rounded">
                <label for="search" class="pb-2 ms-1">Trainer</label>
                    <select class="form-select" aria-label="Default select example" name='trainers' id="trainers" onchange="trainer_selected_change()">
                        <option value="None" selected>Select Trainer </option>
                        <?php 
                        require_once('../../classes/trainers.class.php');

                        $trainerObj = new trainers();
                        
                        if($trainers_data = $trainerObj->fetch_available_trainers()){
                            foreach ($trainers_data as $key => $value) {
                                # code...
                                echo '<option value="'.htmlentities($value['trainer_id']).'" >'.htmlentities($value['user_fullname']).' </option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-6 col-lg-1 d-flex align-items-end mb-1 pt-3">
                <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#ModalTrainer"><i class='bx bx-question-mark'></i></button>
            </div>
            <div class="col-6 col-lg-5 d-flex align-items-end mb-1">
                <div class="form-group rounded">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="Trainer" name="Trainer" onchange="trainer_check_change()">
                        <label class="form-check-label" for="Trainer">
                            Trainer
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-3 pt-lg-0">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-success me-md-2" type="button" id="walk_in" onclick="walk_in_avail()">Avail</button>
            </div>
        </div>

        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                <strong class="me-auto">Avail Walk-In</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Succesfully Availed Walk-In <i class='bx bxs-check-square fs-3 align-bottom' style="color:green;" ></i>
                </div>
            </div>
        </div>
    </div>

</div>