<?php
// start session
session_start();

// includes


if(isset($_SESSION['admin_id'])){
  header('location:../admin/admin_control_log_in.php');
}
// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if($_SESSION['user_status_details'] =='active'){
    // check what type of user are we
    if($_SESSION['user_type_details'] =='admin'){
      // go to admin
    }else if($_SESSION['user_type_details'] == 'normal'){
      // do nothing
      if(isset($_GET['trainer_id']) && intval($_GET['trainer_id'])>0){
        require_once '../classes/trainers.class.php';
        $trainerObj = new trainers();
        require_once '../classes/subscriber_trainers.class.php';
        $subscriber_trainersObj = new subscriber_trainers();
        if(!$subscriber_trainers_data = $subscriber_trainersObj->number_of_person_who_availed($_GET['trainer_id'])){
            echo 'not nice';
            return;
        }
        
        if($trainees_data = $trainerObj->fetch_trainer_with_id($_GET['trainer_id'])){

        echo'
        
                <div class="modal-body container-fluid" id="trainer_info_modal">
                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                <img src="../img/profile-resize/'.htmlentities($trainees_data['user_profile_picture']).'" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>'.htmlentities($trainees_data['user_name']).'</h4>
                                    <p class="text-dark fw-bold mb-1">Status: <span class="text-secondary fw-normal">Active</span></p>
                                    <p class="text-muted font-size-sm">'.htmlentities($trainees_data['user_address']).'</p>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="card mt-3">
                                <div class="pt-3 px-3 text-center">
                                    <h5 class="fw-bold">Total Person who Availed</h5>
                                </div>
                                <div class="row text-center pt-2 pb-3">
                                    <i class="bx bxs-group" style="font-size: 75px;"></i>
                                    <h4 class="fw-bold">'.$subscriber_trainers_data['number_of_person_who_availed'].'</h4>
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
                                        '.htmlentities($trainees_data['user_fullname']).'
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="col-lg-3">
                                            <h6 class="mb-0">'.htmlentities($trainees_data['user_gender_details']).'</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            Male
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="row gutters-sm">
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col align-center">
                                                <h5> Description </h5>
                                                <hr>
                                                <p>'.htmlentities($trainees_data['trainer_status_description']).'</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
                ';
        }
      }
    } 
  }else if($_SESSION['user_status_details'] =='inactive'){
    // handle inactive user details
  }else if($_SESSION['user_status_details'] =='deleted'){
    // handle deleted user details
  }
} else {
  // go to login page
  header('location:../login/log-in.php');
}

?>

