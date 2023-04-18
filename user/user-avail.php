<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';
require_once '../classes/subscriptions.class.php';

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
      // HANDLE HERE IF WE ALREADY AVAIL
      $subscriptionsObj = new subscriptions();
      
      if($subscription_data =$subscriptionsObj->fetchUserActiveAndPendingSubscription($_SESSION['user_id'])){
        header('location:user-profile.php?active=Subscription-tab');
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
<?php require_once '../includes/header-user.php';?>
<body >

<?php require_once '../includes/header.php';?>
<br>
<br>
<br>
<!-- Page Header Start -->
<div class="container-fluid page-header py-6 my-6 mt-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="fw-bolder text-white display-4 mb-4">Avail</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-decoration-none text-white" href="user-page.php">Home</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item  active" aria-current="page" style="color:#A73535;">Offers</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
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
                    <input type="number" name="user_id" id="user_id" value="<?php echo htmlentities($_SESSION['user_id'])?>" style="visibility:hidden;">
                    <!--single form panel-->
                    <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                        <h3 class="multisteps-form__title">Subscription Selection</h3>
                        <hr class="hr" />
                        <div class="multisteps-form__content">
                            <div class="form-group py-1">
                                <div class="row">
                                    <div class="col-10 col-lg-6 py-1">
                                    <label class="fw-bold pb-2 ps-1">Gym-Use Subscription</label>
                                    <select class="form-select" aria-label="Default select example" name="gym_subscription" id="gym_use" onchange="updateGymUseModal()">
                                    <option value="0" name=""selected >Select Gym subscription</option>
                                        <?php
                                            // requre
                                            require_once '../classes/offers.class.php';
                                            require_once '../tools/functions.php';
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
                                        <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><strong>?</strong></button>
                                    </div>

                                    <div class="col-4 col-md-2 py-1">
                                        <label class="fw-bold pb-2 ps-1">Days</label>
                                        <input type="number" class="form-control" name="gym_use_total_duration" min="0" id="gym_use_total_duration" onchange="gym_use_total_durationChange()">
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9998;">
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
                                        <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><strong>?</strong></button>
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
                                                require_once '../classes/trainers.class.php';
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
                                        <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><strong>?</strong></button>
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
                                <ul id="trainer_list_ul" style="list-style-type: none;">
                                </ul>

                                <hr class="hr" />

                                <div class="programs">    
                                    <div class="row py-2" id="program-use-0">
                                        <div class="col-10 col-md-6">
                                            <label class="fw-bold pb-2 ps-1">Program Subscription</label>
                                            <select class="form-select" aria-label="Default select example" id="program_use-0" name='<?php 
                                                    $offersObj = new offers();

                                                    // // fetch
                                                    if($data_result = $offersObj->select_offers_per_sub_type('Program Subscription')){
                                                        echo json_encode($data_result);
                                                    }
                                                    
                                                    ?>' onchange="updateProgramUseModal(0)">
                                                <option value="None" selected >Select Program Subscription</option>
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
                                            <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><strong>?</strong></button>
                                        </div>
                                        <div class="col-4 col-md-2 ">
                                            <label class="fw-bold pb-2 ps-1">Days</label>
                                            <input type="number" class="form-control" name="program-total-duration-0" id="program-total-duration-0" onchange="program_use_total_durationChange(0)">
                                        </div>
                                        <div class="col-12 col-lg-1 btn-group h-25 align-self-end py-1" id="button-div-0">
                                            
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
                            <div class="container fs-4">
                            To fully verify purchase, you must go directly to the gym to complete the checkout. Otherwise, the status of this subscription will be pending.
                            </div>
                            <div class="row pt-3">
                                <div class="col d-flex justify-content-start">
                                    <button class="btn btn-outline-dark js-btn-prev" type="button" title="Prev">Back</button>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <button class="btn btn-outline-danger ml-auto" type="button" title="Send" onclick="avail()">Avail</button>
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


<?php require_once '../includes/footer.php';?>
<script src="../js/availform.js"></script>




<script src="../js/availvalidation-user.js"></script>


<!-- 

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gym-Use Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <img src="../images/312476041_1180676142522081_7979367819549623201_n 1.png" class="img-fluid">
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
    End of Modal -->

<!-- Modal -->
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
                    <div class="row">
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                San Jose, Zamboanga City
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Phone Number</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                0921-234-5678
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Age</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                22 Years Old
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-9 text-secondary">
                                James_No_Legday@gmail.com
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Birth Date</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                November 14, 2000
                            </div>
                        </div>
                        <div class="col">
                            <div class="col">
                                <h6 class="mb-0">Account Created</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                December 20, 2019
                            </div>
                        </div>
                    </div>
                    <hr>
                    
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


</body>

</html>