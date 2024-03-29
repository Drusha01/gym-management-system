<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';

if(isset($_SESSION['admin_id'])){
    header('location:../admin/admin_control_log_in2.php');
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keno Gym</title>
    <link rel="icon" type="images/x-icon" href="../images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/avail.css">
    <link rel="stylesheet" href="../css/boxicons.min.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="https://kit.fontawesome.com/30ff5f2a0c.js" crossorigin="anonymous"></script>

    
</head>
<body >

<?php require_once '../includes/header.php';?>
<br>
<br>
<br>
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
                                                if($data_result = $trainerObj->fetch_tainers()){
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
                                    <div class="row">
                                        <div class="col-10 col-lg-6 ">
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

                                        <div class="col-12 col-lg-1 btn-group align-self-end py-3 py-lg-0" >
                                            <button type="button" class="btn btn-success" onclick="add_newTrainer()"><i class='bx bx-plus-circle'></i></button>
                                            <button type="button" class="btn btn-danger"><i class='bx bx-minus-circle'></i></button>
                                        </div>
                                    </div>
                                </div>
                                

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
                                        <div class="col-12 col-lg-1 btn-group h-25 align-self-end pt-3" id="button-div-0">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-outline-danger ml-auto js-btn-next" type="button" title="Next" onclick="validate_allSubscriptions()">Next</button>
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
                                                <th class="text-center" scope="col">Total Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <th scope="row">1</th>
                                                <td>1-Month Subscription</td>
                                                <td class="text-center" >1</td>
                                                <td class="text-center" >₱800</td>
                                                <td class="text-center" >30</td>
                                                <td class="text-center" >90</td>
                                                <td class="text-center" >₱2400</td>
                                                </tr>
                                                <tr>
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
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr class="hr" />
                                <h5 class="card-title d-flex justify-content-end">Total: <span class="fw-light">₱2400</span></h5>
                            </div>
                            </div>
                        </div>
                        </div>
                        
                        <div class="row pt-3">
                            <div class="col d-flex justify-content-start">
                                <button class="btn btn-outline-dark js-btn-prev" type="button" title="Prev">Prev</button>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-outline-danger ml-auto js-btn-next" type="button" title="Next">Next</button>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!--single form panel-->
                    <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                    <h3 class="multisteps-form__title">Confirmation</h3>
                    <hr class="hr" />
                    <div class="multisteps-form__content">
                        <div class="container">
                        To fully verify purchase, you must go directly to the gym to complete the checkout. Otherwise, the status of this subscription will be pending.
                        </div>
                        <div class="row pt-3">
                            <div class="col d-flex justify-content-start">
                                <button class="btn btn-outline-dark js-btn-prev" type="button" title="Prev">Prev</button>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-outline-danger ml-auto" type="button" title="Send">Avail</button>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </form>
                </div>
            </div>
        </div>
    </div>

</section>


<?php require_once '../includes/footer.php';?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
     crossorigin="anonymous"></script>
<script>
    //DOM elements
const DOMstrings = {
  stepsBtnClass: 'multisteps-form__progress-btn',
  stepsBtns: document.querySelectorAll(`.multisteps-form__progress-btn`),
  stepsBar: document.querySelector('.multisteps-form__progress'),
  stepsForm: document.querySelector('.multisteps-form__form'),
  stepsFormTextareas: document.querySelectorAll('.multisteps-form__textarea'),
  stepFormPanelClass: 'multisteps-form__panel',
  stepFormPanels: document.querySelectorAll('.multisteps-form__panel'),
  stepPrevBtnClass: 'js-btn-prev',
  stepNextBtnClass: 'js-btn-next' };

//remove class from a set of items
const removeClasses = (elemSet, className) => {
  elemSet.forEach(elem => {
    elem.classList.remove(className);
  });
};
//return exect parent node of the element
const findParent = (elem, parentClass) => {
  let currentNode = elem;
  while (!currentNode.classList.contains(parentClass)) {
    currentNode = currentNode.parentNode;
  }
  return currentNode;
};
//get active button step number
const getActiveStep = elem => {
  return Array.from(DOMstrings.stepsBtns).indexOf(elem);
};
//set all steps before clicked (and clicked too) to active
const setActiveStep = activeStepNum => {
  //remove active state from all the state
  removeClasses(DOMstrings.stepsBtns, 'js-active');
  //set picked items to active
  DOMstrings.stepsBtns.forEach((elem, index) => {
    if (index <= activeStepNum) {
      elem.classList.add('js-active');
    }
  });
};
//get active panel
const getActivePanel = () => {
  let activePanel;
  DOMstrings.stepFormPanels.forEach(elem => {
    if (elem.classList.contains('js-active')) {
      activePanel = elem;
    }
  });
  return activePanel;
};
//open active panel (and close unactive panels)
const setActivePanel = activePanelNum => {
  //remove active class from all the panels
  removeClasses(DOMstrings.stepFormPanels, 'js-active');
  //show active panel
  DOMstrings.stepFormPanels.forEach((elem, index) => {
    if (index === activePanelNum) {
      elem.classList.add('js-active');
      setFormHeight(elem);
    }
  });
};
//set form height equal to current panel height
const formHeight = activePanel => {
  const activePanelHeight = activePanel.offsetHeight;
  DOMstrings.stepsForm.style.height = `${activePanelHeight}px`;
};
const setFormHeight = () => {
  const activePanel = getActivePanel();
  formHeight(activePanel);
};
//STEPS BAR CLICK FUNCTION
DOMstrings.stepsBar.addEventListener('click', e => {
  //check if click target is a step button
  const eventTarget = e.target;
  if (!eventTarget.classList.contains(`${DOMstrings.stepsBtnClass}`)) {
    return;
  }
  //get active button step number
  const activeStep = getActiveStep(eventTarget);
  //set all steps before clicked (and clicked too) to active
  setActiveStep(activeStep);
  //open active panel
  setActivePanel(activeStep);
});
//PREV/NEXT BTNS CLICK
DOMstrings.stepsForm.addEventListener('click', e => {
  const eventTarget = e.target;
  //check if we clicked on `PREV` or NEXT` buttons
  if (!(eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`) || eventTarget.classList.contains(`${DOMstrings.stepNextBtnClass}`)))
  {
    return;
  }
  //find active panel
  const activePanel = findParent(eventTarget, `${DOMstrings.stepFormPanelClass}`);
  let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);
  //set active step and active panel onclick
  if (eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`)) {
    activePanelNum--;
  } else {
    activePanelNum++;
  }
  setActiveStep(activePanelNum);
  setActivePanel(activePanelNum);
});
//SETTING PROPER FORM HEIGHT ONLOAD
window.addEventListener('load', setFormHeight, false);
//SETTING PROPER FORM HEIGHT ONRESIZE
window.addEventListener('resize', setFormHeight, false);
$("#exampleModal").prependTo("body");
</script>




<script>

var gym_use_id =null;
var gym_use_duration;
var gym_use_multiplier =1;

var locker_use_id;
var locker_quantity;
var locker_duration;
var locker_multiplier=1;

var trainer_use_id;
var trainer_duration;
var trainer_multiplier=1;
var trainers_id =[];
var trainers_list;
var trainers_list2;
var trainers_quantity=0;


var programs_use_id=[];
var program_list;
var program_duration;
var program_multiplier=1;
var program_quantity=1;
var programs_default=null;

function updateGymUseModal(){
    console.log('update gym use modal');
    if($('#gym-use-'+$('#gym_use').val()).attr('name') != null){
        var content = JSON.parse($('#gym-use-'+$('#gym_use').val()).attr('name'));
        console.log(content);
        //console.log(content);

        // UPDATE MODAL 

        // UDPATE THE DURATION 
        gym_use_id = content;
        gym_use_duration = content.offer_duration;
        $('#gym_use_total_duration').val(gym_use_duration*gym_use_multiplier);
    }else{
        // ask the user if he/she is sure to change it ?? modal maybe
        gym_use_id =null;
        gym_use_duration =0;
        gym_use_multiplier =1;
        $('#gym_use_total_duration').val(gym_use_duration*gym_use_multiplier);
        

        // update locker modal

        // update locker values
        locker_use_id=null;
        locker_duration =0;
        locker_quantity =0;
        locker_multiplier=1;
        $('#locker_use').val('None');
        $('#locker-quantity').val(0);
        $('#locker-total-duration').val(locker_duration*locker_multiplier);

        // update trainer modal

        // update trainer values
        trainer_use_id =null;
        trainer_duration =0;
        trainer_multiplier=1;
        var trainers_id = [];
        var trainers_quantity=0;
        $('#trainer_use').val('None');
        $('.trainers').html('');
        $('#trainer-total-duration').val(trainer_duration*trainer_multiplier);

        // update program modal

        // update program values
        $('#program_use').val('None');
        $('#program-total-duration').val(program_duration*program_multiplier);
    }
    
    
    
    
}

function gym_use_total_durationChange(){
    console.log('gym_use_total_durationChange');
    if(gym_use_id != null){
        if($('#gym_use_total_duration').val()>gym_use_duration*gym_use_multiplier){
            gym_use_multiplier++;
        }else  {
            gym_use_multiplier--;
            
        }
        if(gym_use_multiplier == 0){
            gym_use_multiplier=1;
        }
        $('#gym_use_total_duration').val(gym_use_duration*gym_use_multiplier);
    }else{
        alert('please select Gym-Subscription');
        $('#gym_use_total_duration').val(gym_use_duration*gym_use_multiplier);
    }
}

// ---------------------------------------------------- LOCKER ----------------------------------------------------

function updateLockerUseModal(){
    // first check if the gym use id is populater
    if(gym_use_id != null){
        if($('#locker-use-'+$('#locker_use').val()).attr('name')!=null){
            console.log('update locker use modal');
            var content = JSON.parse($('#locker-use-'+$('#locker_use').val()).attr('name'));
            console.log(content);

            // UPDATE MODAL 

            // UPDATE DURATION AND QUANTITY
            locker_use_id=content;
            locker_duration =content.offer_duration;
            $('#locker-quantity').val(1);
            $('#locker-total-duration').val(locker_duration*locker_multiplier);
        }else{
            locker_use_id=null;
            locker_duration =0;
            $('#locker-quantity').val(0);
            $('#locker-total-duration').val(locker_duration*locker_multiplier);
        }
        
    }else{
        alert('please select Gym-Subscription');
        $('#locker_use').val('None');
    }
}

function locker_use_total_durationChange(){
    console.log('locker_use_total_durationChange');
    if($('#locker-use-'+$('#locker_use').val()).attr('name')!=null){
        if($('#locker-total-duration').val()>locker_duration*locker_multiplier){
            locker_multiplier++;
            // check if the locker is greater than the gym use
            if(locker_duration*locker_multiplier >gym_use_duration*gym_use_multiplier){
                locker_multiplier--;
                alert('locker use can\'t be greater than gym use');
            }
        }else  {
            locker_multiplier--;
            
        }
        if(locker_multiplier == 0){
            locker_multiplier=1;
        }
        $('#locker-total-duration').val(locker_duration*locker_multiplier);
    }else{
        alert('please select Locker-Subscription');
        $('#locker_use').val('None');
        $('#locker-total-duration').val(locker_duration*locker_multiplier);
    }
}

function locker_use_quantityChange(){
    if($('#locker-use-'+$('#locker_use').val()).attr('name')!=null){
        if(locker_use_id !=0 && $('#locker-quantity').val()<=0){
            $('#locker-quantity').val(1);
        }
    }else{
        alert('please select Locker-Subscription');
        $('#locker_use').val('None');
        $('#locker-quantity').val(0);
    }
}

// ---------------------------------------------------- TRAINER ----------------------------------------------------
function updateTrainerUseModal(){
    if(gym_use_id != null){
        if($('#trainer-use-'+$('#trainer_use').val()).attr('name')!=null){
            console.log('update trainer use modal');
            var content = JSON.parse($('#trainer-use-'+$('#trainer_use').val()).attr('name'));
            console.log(content);

            // UPDATE MODAL 

            // UPDATE DURATION 
            trainer_use_id=content;
            trainer_duration =content.offer_duration;
            $('#trainer-total-duration').val(trainer_duration*trainer_multiplier);
            trainers_list = JSON.parse($('#trainer_use').attr('name'));
            trainers_list2=trainers_list;
            add_newTrainer();
        }else{
            // set all to default
            trainer_use_id=null;
            trainer_duration =0;
            trainers_id = [];
            trainers_quantity=0;
            $('#trainer-total-duration').val(trainer_duration*trainer_multiplier);
            $('.trainers').html('');
        }
    }else{
        alert('please select Gym-Subscription');
        $('#trainer_use').val('None');
    }
}

function trainer_use_total_durationChange(){
    //console.log('trainer_use_total_durationChange');
    if($('#trainer-use-'+$('#trainer_use').val()).attr('name')!=null){
        if($('#trainer-total-duration').val()>trainer_duration*trainer_multiplier){
            trainer_multiplier++;
            // check if the locker is greater than the gym use
            if(trainer_duration*trainer_multiplier >gym_use_duration*gym_use_multiplier){
                trainer_multiplier--;
                alert('trainer duration can\'t be greater than gym use');
            }
        }else  {
            trainer_multiplier--;
            
        }
        if(trainer_multiplier == 0){
            trainer_multiplier=1;
        }
        $('#trainer-total-duration').val(trainer_duration*trainer_multiplier);
    }else{
        alert('please select Trainer-Subscription');
        $('#trainer_use').val('None');
        $('#trainer-total-duration').val(trainer_duration*trainer_multiplier);
    }
}

function trainer_selected_changed(selected_id){
    console.log('trainer_selected cahgned');
    // update the trainer-selected modal

    // update trainer list 
    console.log('selected_index:'+selected_id);   
    console.log('selected:'+$('#select-trainer-'+selected_id).val());
    var selectedVal = $('#select-trainer-'+selected_id).val();
    // if($('#select-trainer-'+selected_id).val() == 'None'){
    //     trainers_id.splice(selected_id, 1);
    //     $('#button-trainer-'+selected_id).html('');
    // }
    
    trainers_list2.forEach(function(element,index) {
        if(element.trainer_id == selectedVal){
            // first we check if the selected value is in the trainers_id array
            for (let index = 0; index < trainers_id.length; index++) {
                if(trainers_id[index].trainer_id == element.trainer_id){

                    if(trainers_id[selected_id] == null){
                        $('#select-trainer-'+selected_id).val('None');
                    }else{
                        $('#select-trainer-'+selected_id).val('None');
                        trainers_id.splice(selected_id, 1);
                    }
                    //console.log(trainers_id[index]);
                    alert('already selected');
                    // dont add
                    return;
                }
            }
            if(trainers_id[selected_id] == null){
                trainers_id.push(element);
                if(trainers_id.length <trainers_list2.length  &&selected_id+1 == trainers_quantity){
                    $('#button-trainer-'+selected_id).html('<button type="button" class="btn btn-success" onclick="add_newTrainer('+selected_id+')"><i class="bx bx-plus-circle"></i></button><button type="button" class="btn btn-danger" onclick="deleteTrainer('+selected_id+')"><i class="bx bx-minus-circle"></i></button>');

                }else{
                    $('#button-trainer-'+selected_id).html('<button type="button" class="btn btn-danger" onclick="deleteTrainer('+selected_id+')"><i class="bx bx-minus-circle"></i></button>');
                }
            }else{
                trainers_id[selected_id] = element;
                if(trainers_id.length ==trainers_quantity ){
                    $('#button-trainer-'+selected_id).html('<button type="button" class="btn btn-success" onclick="add_newTrainer('+selected_id+')"><i class="bx bx-plus-circle"></i></button><button type="button" class="btn btn-danger" onclick="deleteTrainer('+selected_id+')"><i class="bx bx-minus-circle"></i></button>');

                }else{
                    $('#button-trainer-'+selected_id).html('<button type="button" class="btn btn-danger" onclick="deleteTrainer('+selected_id+')"><i class="bx bx-minus-circle"></i></button>');
                }
            }
        }
    });
    console.log(trainers_id);
}

function deleteTrainer(selected_id){
    
    //trainers_id.remove(selected_id);
    var selectedVal = $('#select-trainer-'+selected_id).val();
    trainers_id.forEach(function(element,index)  {
        if(element.trainer_id == selectedVal){
            trainers_id.splice(index, 1);
        }
    });
    $('#select-trainer-'+selected_id).val('None');
    $('#button-trainer-'+selected_id).html('');
    console.log(trainers_id)
    

}   


function add_newTrainer(selected_id){
    
    console.log('add new trainer');
    console.log(trainers_list);
    $('#button-trainer-'+selected_id).html('<button type="button" class="btn btn-danger" onclick="deleteTrainer('+selected_id+')"><i class="bx bx-minus-circle"></i></button>');

    // only add if the trainers_id is less than the trainer_list
    if(trainers_list2.length>0){
        $('.trainers').append('<div class="row" id=trainer-'+(trainers_quantity)+'><div class="col-10 col-lg-6 "><label class="fw-bold pb-2 ps-1">Search Trainer</label><select class="form-select" id="select-trainer-'+(trainers_quantity)+'" aria-label="Default select example" onchange="trainer_selected_changed('+(trainers_quantity)+')"><option value="None" selected>Open this select menu</option></select></div><div class="col-1 align-self-end mb-1 mb-lg-2"><button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#ModalTrainer"><strong>?</strong></button></div><div class="col-12 col-lg-1 btn-group align-self-end py-3 py-lg-0" id="button-trainer-'+(trainers_quantity)+'"></div></div> ');
        trainers_list2.forEach(element => {
            $('#select-trainer-'+(trainers_quantity)).append('<option value="'+element.trainer_id+'" >'+element.user_fullname+'</option>');
        });
    }
    trainers_quantity++;
}
// ---------------------------------------------------- PROGRAM ----------------------------------------------------
function updateProgramUseModal(selected_id){
    
    if(gym_use_id != null){
        if($('#program-use-'+$('#program_use-'+selected_id).val()).attr('name')!=null){
            if(programs_default == null){
                programs_default = $('.programs').html();
            }
            console.log('update program use modal');
            if(program_list == null){
                program_list = JSON.parse($('#program_use-'+selected_id).attr('name'));
            }
            
            console.log(program_list);
            var selectedVal =$('#program_use-'+selected_id).val();
            
            // check if we already append it in the list
            program_list.forEach(element => {
                if(element.offer_id == selectedVal){
                    console.log(element);
                    for (let index = 0; index < programs_use_id.length; index++) {
                        if(element.offer_id == programs_use_id[index].offer_id){
                            // do something here
                            if(programs_use_id[selected_id] == null){
                                $('#program_use-'+selected_id).val('None');
                            }else{
                                $('#program_use-'+selected_id).val('None');
                                // set all things to default
                            }
                            alert('already selected');
                            return;
                        }
                        
                    }
                    if(programs_use_id[selected_id] == null){
                        console.log('appended');
                        programs_use_id.push(element);
                        if(programs_use_id.length <program_list.length  &&selected_id+1 == program_quantity){
                            $('#button-div-'+selected_id).html('<button type="button" class="btn btn-success" onclick="addNewProgram('+selected_id+')"><i class="bx bx-plus-circle"></i></button><button type="button" class="btn btn-danger" onclick="deleteProgram('+selected_id+')"><i class="bx bx-minus-circle"></i></button>');
                        }else{
                            $('#button-div-'+selected_id).html('<button type="button" class="btn btn-danger" onclick="deleteProgram('+selected_id+')"><i class="bx bx-minus-circle"></i></button>');
                        }
                    }else{
                        programs_use_id[selected_id] = element;
                        if(programs_use_id.length == program_quantity ){
                            $('#button-div-'+selected_id).html('<button type="button" class="btn btn-success" onclick="addNewProgram('+selected_id+')"><i class="bx bx-plus-circle"></i></button><button type="button" class="btn btn-danger" onclick="deleteProgram('+selected_id+')"><i class="bx bx-minus-circle"></i></button>');
                        }else{
                            $('#button-div-'+selected_id).html('<button type="button" class="btn btn-danger" onclick="deleteProgram('+selected_id+')"><i class="bx bx-minus-circle"></i></button>');
                        }
                    }

                    // update the duration
                    program_duration = programs_use_id[selected_id].offer_duration;

                    $('#program-total-duration-'+selected_id).val(program_duration*program_multiplier);
                    // add the button
                    if(programs_use_id.length < program_list.length){
                       // $('#button-div-'+selected_id).html('<button type="button" class="btn btn-success" onclick="addNewProgram()"><i class="bx bx-plus-circle"></i></button><button type="button" class="btn btn-danger" onclick="deleteProgram('+selected_id+')"><i class="bx bx-minus-circle"></i></button>');
                    }
                }
            });
            console.log('e;');
            console.log(programs_use_id);

            

            
        }else{
            // set all to default
            program_use_id=null;
            trainer_duration =0;
            trainers_id = [];
            trainers_quantity=0;
            $('#trainer-total-duration').val(trainer_duration*trainer_multiplier);
            $('.trainers').html('');

        }
    }else{
        alert('please select Gym-Subscription');
        $('#program_use').val('None');
    }
}

function addNewProgram(selected_id){
    $('#button-div-'+selected_id).html('<button type="button" class="btn btn-danger" onclick="deleteProgram('+selected_id+')"><i class="bx bx-minus-circle"></i></button>');
    if(program_quantity<program_list.length){
        $('.programs').append('<div class="row py-2" id="program-use-'+program_quantity+'"><div class="col-10 col-md-6"><label class="fw-bold pb-2 ps-1">Program Subscription</label><select class="form-select" aria-label="Default select example" id="program_use-'+program_quantity+'" name="" onchange="updateProgramUseModal('+program_quantity+')"><option value="None" selected="">Select Program Subscription</option></select></div><div class="col-1 align-self-end mb-2"><button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><strong>?</strong></button></div><div class="col-4 col-md-2 "><label class="fw-bold pb-2 ps-1">Days</label><input type="number" class="form-control" name="program-total-duration-'+program_quantity+'" id="program-total-duration-'+program_quantity+'" onchange="program_use_total_durationChange('+program_quantity+')"></div><div class="col-12 col-lg-1 btn-group h-25 align-self-end pt-3" id="button-div-'+program_quantity+'"></div></div>');
        // add the select
        program_list.forEach(element => {
            $('#program_use-'+program_quantity).append('<option value="'+element.offer_id+'" >'+element.offer_name+' (₱'+element.offer_price+') DAYS('+element.offer_duration+')</option>');
        });
    }
    program_quantity++;
    console.log(program_list);
}

function deleteProgram(selected_id){
    var selectedVal =$('#program_use-'+selected_id).val();
    programs_use_id.forEach(function(element,index)  {
        if(element.offer_id == selectedVal){
            programs_use_id.splice(index, 1);
        }
    });

}

function program_use_total_durationChange($selected_id){
    if($('#program-use-'+$('#program_use').val()).attr('name')!=null){
        if($('#program-total-duration-'+selected_id).val()>program_duration*program_multiplier){
            program_multiplier++;
            // check if the locker is greater than the gym use
            if(program_duration*program_multiplier >gym_use_duration*gym_use_multiplier){
                program_multiplier--;
                alert('trainer duration can\'t be greater than gym use');
            }
        }else  {
            program_multiplier--;
            
        }
        if(program_multiplier == 0){
            program_multiplier=1;
        }
        $('#program-total-duration-'+selected_id).val(program_duration*program_multiplier);
    }else{
        alert('please select Program-Subscription');
        $('#program_use').val('None');
        $('#program-total-duration-'+selected_id).val(program_duration*program_multiplier);
    }
}
// ---------------------------------------------------- VALIDATE ALL SUBSCRIPTION ----------------------------------------------------
function validate_allSubscriptions(){
    console.log('validating all subscription')
    console.log(gym_use_id);
    console.log(locker_use_id);
    console.log(trainer_use_id);
    console.log(programs_use_id);
}

</script>


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