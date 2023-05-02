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
        <h5 class="col-7 col-lg-4 fw-bold mb-3 ms-2">Avail Subscription</h5>
        <a class="col-4  text-decoration-none text-black m-0" aria-current="page" href="avail.php?active=subs"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
    </div>
    <section id="avail" class="pb-5">

        <div class="container h-100">
            <div class="multisteps-form">
            <!--progress bar-->
                <div class="row mt-5">
                    <div class="col-12 col-lg-8 ms-auto me-auto mb-4">
                    <div class="multisteps-form__progress">
                        <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">Selection</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Address">Summary</button>
                        <button class="multisteps-form__progress-btn" type="button" title="Order Info">Confirmation</button>
                    </div>
                    </div>
                </div>
            <!--form panels-->
                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                    <form class="multisteps-form__form">
                        <input type="number" class="d-none"name="user_id" id="user_id" value="#" style="visibility:hidden;">
                        <!--single form panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                            <h3 class="multisteps-form__title">Subscription Selection</h3>
                            <hr class="hr" />
                            <div class="multisteps-form__content">
                                <div class="form-group py-1">
                                    <div class="row py-2">
                                        <div class="col-12">
                                            <label for="users" class="pb-2">Search</label>
                                            <select class="select2" name='users' id="customer" style="width:100%;">
                                                <option value="None" selected>Select Customer Name</option> 
                                                <?php 
                                                require_once('../../classes/users.class.php');

                                                $userObj = new users();

                                                if($users_data = $userObj->fetch_all_users(0,100000)){
                                                    foreach ($users_data as $key => $value) {
                                                        # code...
                                                        echo '<option value="'.htmlentities($value['user_id']).'" >('.htmlentities($value['user_name']).') '.htmlentities($value['user_fullname']).' </option>';
                                                    }

                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-10 col-lg-6 py-1">
                                        <label class="fw-bold pb-2 ps-1">Gym-Use Subscription</label>
                                        <select class="form-select" aria-label="Default select example" name="gym_subscription" id="gym_use" onchange="updateGymUseModal()">
                                        <option value="0" name=""selected >Select Gym subscription</option>
                                            <?php
                                                // requre
                                                require_once '../../classes/offers.class.php';
                                                require_once '../../tools/functions.php';
                                                // instance
                                                $offersObj = new offers();

                                                // fetch
                                                if($data_result = $offersObj->select_offers_per_sub_type('Gym Subscription')){
                                                    foreach ($data_result as $key => $value) {
                                                        if($value['status_details'] =='active'){
                                                            echo '<option value="';echo_safe($value['offer_id']);echo '" id="gym-use-'.htmlentities($value['offer_id']).'" name=\''.json_encode($value).'\'  duration="'.htmlentities($value['offer_duration']).'">';echo_safe($value['offer_name']);echo ' (₱';echo_safe($value['offer_price']);echo') DAYS('.htmlentities($value['offer_duration']).')</option>';
                                                        }
                                                    }
                                                }
                                            ?>
                                        </select>
                                        
                                        </div>
                                        <div class="col-1 align-self-end mb-2">
                                            <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#gym-use_subs"><strong>?</strong></button>
                                        </div>

                                        <div class="col-4 col-md-2 py-1">
                                            <label class="fw-bold pb-2 ps-1">Days</label>
                                            <input type="number" class="form-control" name="gym_use_total_duration" min="0" id="gym_use_total_duration" onchange="gym_use_total_durationChange()">
                                        </div>
                                    </div>

                                    <hr class="hr" />

                                    <div class="row py-2">
                                        <div class="col-10 col-lg-6 py-1">
                                            <label class="fw-bold pb-2 ps-1">Locker Subscription</label>
                                            <select class="form-select" aria-label="Default select example" name="locker_subscription" id="locker_use" onchange="updateLockerUseModal()">
                                                <option value ="None" selected>Select Locker subscription</option>
                                                <?php 
                                                $offersObj = new offers();

                                                // fetch
                                                if($data_result = $offersObj->select_offers_per_sub_type('Locker Subscription')){
                                                    foreach ($data_result as $key => $value) {
                                                        if($value['status_details'] =='active'){
                                                            echo '<option value="';echo_safe($value['offer_id']);echo '" id="locker-use-'.htmlentities($value['offer_id']).'" name=\''.json_encode($value).'\'  duration="'.htmlentities($value['offer_duration']).'">';echo_safe($value['offer_name']);echo ' (₱';echo_safe($value['offer_price']);echo') DAYS('.htmlentities($value['offer_duration']).')</option>';
                                                        }
                                                    }
                                                }
                                                
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-1 align-self-end mb-2">
                                            <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#lockersubs"><strong>?</strong></button>
                                        </div>
                                        <div class="col-4 col-md-2 py-1">

                                            <label class="fw-bold pb-2 ps-1">Quantity</label>
                                            <input type="number" class="form-control" id="locker-quantity" min="0" onchange="locker_use_quantityChange()">
                                        </div>
                                        <div class="col-4 col-md-2 py-1">
                                            <label class="fw-bold pb-2 ps-1">Days</label>
                                            <input type="number" class="form-control" id="locker-total-duration" min="0" onchange="locker_use_total_durationChange()">
                                        </div>
                                    </div>

                                    <hr class="hr" />
                                    <div class="row py-2">
                                        <div class="col-10 col-lg-6">
                                            <label class="fw-bold pb-2 ps-1">Trainer Subscription</label>
                                            <select class="form-select" aria-label="Default select example" name='<?php 
                                                    require_once '../../classes/trainers.class.php';
                                                    $trainerObj = new trainers();

                                                    // // fetch
                                                    if($data_result = $trainerObj->fetch_available_trainers()){
                                                        echo json_encode($data_result);
                                                    }
                                                    
                                                    ?>'id="trainer_use" onchange="updateTrainerUseModal()">
                                                <option value="None" selected>Select Trainer Subscription</option>
                                                <?php 
                                                $offersObj = new offers();

                                                // fetch
                                                if($data_result = $offersObj->select_offers_per_sub_type('Trainer Subscription')){
                                                    foreach ($data_result as $key => $value) {
                                                        if($value['status_details'] =='active'){
                                                            echo '<option value="';echo_safe($value['offer_id']);echo '" id="trainer-use-'.htmlentities($value['offer_id']).'" name=\''.json_encode($value).'\'  duration="'.htmlentities($value['offer_duration']).'">';echo_safe($value['offer_name']);echo ' (₱';echo_safe($value['offer_price']);echo') DAYS('.htmlentities($value['offer_duration']).')</option>';
                                                        }
                                                    }
                                                }
                                                
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-1 align-self-end mb-2">
                                            <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#trainersubs"><strong>?</strong></button>
                                        </div>
                                        <div class="col-4 col-md-2 ">
                                            <label class="fw-bold pb-2 ps-1">Days</label>
                                            <input type="number" class="form-control" id="trainer-total-duration" min="0" onchange="trainer_use_total_durationChange()">
                                        </div>
                                    </div>
                                
                                    <div class="trainers">
                                        
                                        <!-- <div class="row">
                                            <div class="col-10 col-lg-6 pb-2">
                                                <label class="fw-bold pb-2 ps-1">Search Trainer</label>
                                                <select class="form-select" aria-label="Default select example" onchange="trainer_selected_changed()">
                                                <option value="None" selected>Open this select menu</option>
                                                    <?php 
                                                    // require_once '../classes/trainers.class.php';
                                                    // $trainerObj = new trainers();

                                                    // // fetch
                                                    // if($data_result = $trainerObj->fetch_tainers()){
                                                    //     foreach ($data_result as $key => $value) {
                                                    //         if( $value['trainer_availability_details'] =='Available' && $value['user_status_details'] == 'active'){
                                                    //             echo '<option value="'.htmlentities($value['trainer_id']).'" name=\''.json_encode($value).'\'>';echo_safe($value['user_fullname']); echo'</option>';
                                                    //         }
                                                    //     }
                                                    // }
                                                    
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-1 align-self-end mb-1 mb-lg-2">
                                                <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#ModalTrainer"><strong>?</strong></button>
                                            </div>

                                            <div class="col-12 col-lg-1 btn-group align-self-end pb-2 py-2" >
                                                <button type="button" class="btn btn-sm btn-success" onclick="add_newTrainer()"><i class='bx bx-plus-circle'></i></button>
                                                <button type="button" class="btn btn-sm btn-danger"><i class='bx bx-minus-circle'></i></button>
                                            </div>
                                        </div> -->
                                    </div>
                                    <ul id="trainer_list_ul" style="list-style-type: none;}">
                                    </ul>

                                    <hr class="hr" />

                                    <div class="programs">    
                                        <div class="row py-2" id="program-use-0">
                                            <div class="col-10 col-md-6">
                                                <label class="fw-bold pb-2 ps-1">Event Subscription</label>
                                                <select class="form-select" aria-label="Default select example" id="program_use-0" name='<?php 
                                                        $offersObj = new offers();

                                                        // // fetch
                                                        if($data_result = $offersObj->select_offers_per_sub_type('Program Subscription')){
                                                            echo json_encode($data_result);
                                                        }
                                                        
                                                        ?>' onchange="updateProgramUseModal(0)">
                                                    <option value="None" selected >Select Event Subscription</option>
                                                    <?php 
                                                    $offersObj = new offers();

                                                    // fetch
                                                    if($data_result = $offersObj->select_offers_per_sub_type('Program Subscription')){
                                                        foreach ($data_result as $key => $value) {
                                                            if($value['status_details'] =='active'){
                                                                echo '<option value="';echo_safe($value['offer_id']);echo '" id="program-use-'.htmlentities($value['offer_id']).'" name=\''.json_encode($value).'\'  duration="'.htmlentities($value['offer_duration']).'">';echo_safe($value['offer_name']);echo ' (₱';echo_safe($value['offer_price']);echo') DAYS('.htmlentities($value['offer_duration']).')</option>';
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-1 align-self-end mb-2">
                                                <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#eventsubs"><strong>?</strong></button>
                                            </div>
                                            <div class="col-4 col-md-2 ">
                                                <label class="fw-bold pb-2 ps-1">Days</label>
                                                <input type="number" class="form-control" name="program-total-duration-0" id="program-total-duration-0" onchange="program_use_total_durationChange(0)">
                                            </div>
                                            <div class="col-12 col-lg-1 btn-group h-25 align-self-end py-1 py-lg-1" id="button-div-0">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <ul id="program_list_ul" style="list-style-type: none;}">
                                    </ul>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <button class="btn btn-outline-danger ml-auto js-btn-next" type="button" title="Next" onclick="validate_allSubscriptions()" disabled id="first_next">Next</button>
                                </div>
                            </div>
                        </div>
                        <!--single form panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                        <h3 class="multisteps-form__title">Summary of Subscription</h3>
                        <hr class="hr" />
                        <div class="multisteps-form__content">
                            <div class="row">

                                <div class="col-12 col-md-12 ">
                                <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Summary</h5>
                                    <hr class="hr" />
                                    <div class="container-fluid scroll overflow-auto">
                                        <div class="row table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Offer Name</th>
                                                    <th class="text-center" scope="col">Qty</th>
                                                    <th class="text-center" scope="col">Price</th>
                                                    <th class="text-center" scope="col">Days</th>
                                                    <th class="text-center" scope="col">Total Days</th>
                                                    <th class="text-center" scope="col">CALCULATION</th>
                                                    <th class="text-center" scope="col">Sub-Total Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_summary">
                                                    <!-- <tr>
                                                    <th scope="row">2</th>
                                                    <td>1-Month Locker</td>
                                                    <td class="text-center" >2</td>
                                                    <td class="text-center" >₱100</td>
                                                    <td class="text-center" >30</td>
                                                    <td class="text-center" >60</td>
                                                    <td class="text-center" >₱200</td>
                                                    </tr>
                                                    <tr>
                                                    <th scope="row">3</th>
                                                    <td>1-Month Trainer</td>
                                                    <td class="text-center" >2</td>
                                                    <td class="text-center" >₱1500</td>
                                                    <td class="text-center" >30</td>
                                                    <td class="text-center" >90</td>
                                                    <td class="text-center" >₱3000</td>
                                                    </tr>
                                                    <tr>
                                                    <th scope="row">4</th>
                                                    <td>Zumba</td>
                                                    <td class="text-center" >1</td>
                                                    <td class="text-center" >₱500</td>
                                                    <td class="text-center" >30</td>
                                                    <td class="text-center" >30</td>
                                                    <td class="text-center" >₱500</td>
                                                    </tr>
                                                    <tr>
                                                    <th scope="row">5</th>
                                                    <td>Circuit Training</td>
                                                    <td class="text-center" >1</td>
                                                    <td class="text-center" >₱500</td>
                                                    <td class="text-center" >30</td>
                                                    <td class="text-center" >30</td>
                                                    <td class="text-center" >₱500</td>
                                                    </tr> -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr class="hr" />
                                    <h5 class="card-title d-flex justify-content-end">Total: <span class="fw-light" id="total_price">₱</span></h5>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col d-flex justify-content-start">
                                    <button class="btn btn-outline-dark js-btn-prev" type="button" title="Prev">Back</button>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <button class="btn btn-outline-danger ml-auto js-btn-next" type="button" title="Next">Next</button>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!--single form panel-->
                        <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn" >
                            <h3 class="multisteps-form__title">Confirmation</h3>
                            <hr class="hr" />
                            <div class="multisteps-form__content pb-5">
                                <div class="container fs-4" id="customer_content">
                                 Confirm Subscription for Customer, (Customer Name).
                                </div>
                                <div class="row pt-3">
                                    <div class="col d-flex justify-content-start">
                                        <button class="btn btn-outline-dark js-btn-prev" type="button" title="Prev">Back</button>
                                    </div>
                                    <div class="col d-flex justify-content-end">
                                        <button class="btn btn-outline-danger ml-auto" type="button" title="Send" onclick="avail()">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </form>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>

    </section>

  </div>
</main>
<!-- Modal gym-use -->
<div class="modal fade" id="gym-use_subs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9998;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Gym-Use Info</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <img src="../images/home-1.jpg" class="img-fluid">
                </div>
                <div class="col-12 col-lg-6 pt-3 pt-lg-0">
                    <h5 class="fw-bold text-wrap">1 Month Gym-Use (21 and Above)</h5>
                    <p>Get fit and feel great with our one-month gym membership offer!
                            Enjoy full access to our state-of-the-art gym facilities,
                            expert staff, and group fitness classes to help you reach your
                            fitness goals. Sign up now and take the first step towards a healthier you!</p>
                </div>
            </div>
            <hr>
            <div class="container-fluid d-flex justify-content-center">
                <div class="row text-center">
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Age Qualification <span class="fw-normal">21 and Above</span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Slots <span class="fw-normal">Unlimited</span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Days <span class="fw-normal">60</span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Price <span class="fw-normal">₱800.00</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
<!-- End of Modal -->

<!-- Modal locker subscription -->
<div class="modal fade" id="lockersubs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9998;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Locker Info</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <img src="../images/home-1.jpg" class="img-fluid">
                </div>
                <div class="col-12 col-lg-6 pt-3 pt-lg-0">
                    <h5 class="fw-bold text-wrap">1 Month Gym-Use (21 and Above)</h5>
                    <p>Get fit and feel great with our one-month gym membership offer!
                            Enjoy full access to our state-of-the-art gym facilities,
                            expert staff, and group fitness classes to help you reach your
                            fitness goals. Sign up now and take the first step towards a healthier you!</p>
                </div>
            </div>
            <hr>
            <div class="container-fluid d-flex justify-content-center">
                <div class="row text-center">
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Age Qualification <span class="fw-normal">21 and Above</span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Slots <span class="fw-normal">Unlimited</span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Days <span class="fw-normal">60</span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Price <span class="fw-normal">₱800.00</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
<!-- End of Modal -->
<!-- Modal Trainer subscription -->
<div class="modal fade" id="trainersubs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9998;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Trainer Info</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <img src="../images/home-1.jpg" class="img-fluid">
                </div>
                <div class="col-12 col-lg-6 pt-3 pt-lg-0">
                    <h5 class="fw-bold text-wrap">1 Month Gym-Use (21 and Above)</h5>
                    <p>Get fit and feel great with our one-month gym membership offer!
                            Enjoy full access to our state-of-the-art gym facilities,
                            expert staff, and group fitness classes to help you reach your
                            fitness goals. Sign up now and take the first step towards a healthier you!</p>
                </div>
            </div>
            <hr>
            <div class="container-fluid d-flex justify-content-center">
                <div class="row text-center">
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Age Qualification <span class="fw-normal">21 and Above</span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Slots <span class="fw-normal">Unlimited</span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Days <span class="fw-normal">60</span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Price <span class="fw-normal">₱800.00</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
<!-- End of Modal -->

<!-- Modal event subscription -->
<div class="modal fade" id="eventsubs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9998;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Event Info</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <img src="../images/home-1.jpg" class="img-fluid">
                </div>
                <div class="col-12 col-lg-6 pt-3 pt-lg-0">
                    <h5 class="fw-bold text-wrap">1 Month Gym-Use (21 and Above)</h5>
                    <p>Get fit and feel great with our one-month gym membership offer!
                            Enjoy full access to our state-of-the-art gym facilities,
                            expert staff, and group fitness classes to help you reach your
                            fitness goals. Sign up now and take the first step towards a healthier you!</p>
                </div>
            </div>
            <hr>
            <div class="container-fluid d-flex justify-content-center">
                <div class="row text-center">
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Age Qualification <span class="fw-normal">21 and Above</span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Slots <span class="fw-normal">Unlimited</span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Days <span class="fw-normal">60</span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Price <span class="fw-normal">₱800.00</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
<!-- End of Modal -->

<!-- Modal trainer profile -->
<div class="modal fade" id="ModalTrainer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
<div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Trainer Info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body container-fluid">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                    <img src="../images/acc_img.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                        <h4>James_No_Legday</h4>
                        <p class="text-dark fw-bold mb-1">Status: <span class="text-secondary fw-normal">Active</span></p>
                        <p class="text-muted font-size-sm">San Jose, Zamboanga City</p>
                    </div>
                    </div>
                </div>
                </div>
                <div class="card mt-3">
                    <div class="pt-3 px-3 text-center">
                        <h5 class="fw-bold">Total Person who Availed</h5>
                    </div>
                    <div class="row text-center pt-2 pb-3">
                        <i class='bx bxs-group' style="font-size: 75px;"></i>
                        <h4 class="fw-bold">5</h4>
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
                                Trinidad, James Lorenz
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Gender</h6>
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
                                    <p>Hello I am good at calisthenics</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
    </div>
</div>
</div>
<!-- End of Modal -->






<script src="../../js/availform.js"></script>
<script src="../../js/availvalidation.js"></script>
<script>
    $('.select2').select2();
    $('#customer').change(function(){
        console.log($('#customer').val());
        user_id = $('#customer').val();
        $('#customer_content').html('Confirm Subscription for '+$('#customer').val()+'. '+$( "#customer option:selected" ).text())
    })
</script>
</body>

</html>