<?php
session_start();
//print_r($_SESSION);
// check if loged in else go to log in
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
<section id="avail">
    <div class="container h-100">
        <div class="multisteps-form">
        <!--progress bar-->
            <div class="row mt-5">
                <div class="col-12 col-lg-8 ms-auto me-auto mb-4">
                <div class="multisteps-form__progress">
                    <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">Selection</button>
                    <button class="multisteps-form__progress-btn" type="button" title="Address">Checkout</button>
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
                                    <div class="col-10 col-md-4 py-1">
                                    <label class="fw-bold pb-2 ps-1">Gym-Use Subscription</label>
                                    <select class="form-select" aria-label="Default select example" name="gym_subscription">
                                    <option selected>Select Gym subscription</option>
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
                                                        echo '<option value="';echo_safe($value['offer_id']);echo '">';echo_safe($value['offer_name']);echo ' (₱';echo_safe($value['offer_price']);echo')</option>';
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                    </div>
                                    <div class="col-1 align-self-end mb-2">
                                        <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><strong>?</strong></button>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Gym-Use Info</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive table-container">
                                                <table class="table table-striped table-borderless table-fixed table-hover" style="width: 100%">
                                                <thead class="bg-dark text-light">
                                                    <tr>
                                                    <th class="text-center">NAME OF OFFER</th>
                                                    <th class="text-center">AGE QUALIFICATION</th>
                                                    <th class="text-center">DAYS</th>
                                                    <th class="text-center">SLOTS</th>
                                                    <th class="text-center">PRICE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    <td class="text-center">1-Month Gym-Use</td>
                                                    <td class="text-center">None</td>
                                                    <td class="text-center">30</td>
                                                    <td class="text-center">None</td>
                                                    <td class="text-center">₱800</td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- End of Modal -->

                                    <div class="col-10 col-md-4 py-1">
                                    <label class="fw-bold pb-2 ps-1">Locker Subscription</label>
                                    <select class="form-select" aria-label="Default select example" name="locker_subscription">
                                        <option selected>Select Locker subscription</option>
                                        <?php 
                                        $offersObj = new offers();

                                        // fetch
                                        if($data_result = $offersObj->select_offers_per_sub_type('Locker Subscription')){
                                            foreach ($data_result as $key => $value) {
                                                if($value['status_details'] =='active'){
                                                    echo '<option value="';echo_safe($value['offer_id']);echo '">';echo_safe($value['offer_name']);echo ' (₱';echo_safe($value['offer_price']);echo')</option>';
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
                                        <input type="number" class="form-control" name="quantity">
                                    </div>
                                    
                                </div>
                                <hr class="hr" />
                                <div class="row py-2">
                                    <div class="col-10 col-md-4">
                                        <label class="fw-bold pb-2 ps-1">Trainer Subscription</label>
                                        <select class="form-select" aria-label="Default select example" name="trainer_subscription">
                                            <option selected>Open this select menu</option>
                                            <?php 
                                            $offersObj = new offers();

                                            // fetch
                                            if($data_result = $offersObj->select_offers_per_sub_type('Trainer Subscription')){
                                                foreach ($data_result as $key => $value) {
                                                    if($value['status_details'] =='active'){
                                                        echo '<option value="';echo_safe($value['offer_id']);echo '">';echo_safe($value['offer_name']);echo ' (₱';echo_safe($value['offer_price']);echo')</option>';
                                                    }
                                                }
                                            }
                                            
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-1 align-self-end mb-2">
                                        <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><strong>?</strong></button>
                                    </div>
                                    <div class="col-md-4 py-3 py-lg-0">
                                        <label class="fw-bold pb-2">Search</label>
                                        <input class="form-control" type="text" placeholder="Enter Trainer Name">
                                    </div>
                                    <div class="col-6 col-md-1 align-self-end py-2 py-lg-0 text-center">
                                        <button type="button" class="btn btn-success btn-lg"><i class='bx bx-plus-circle'></i></button>
                                    </div>
                                    <div class="col-6 col-md-1 align-self-end py-2 py-lg-0 text-center">
                                    <button type="button" class="btn btn-danger btn-lg"><i class='bx bx-minus-circle' ></i></button>
                                    </div>
                                </div>
                                <hr class="hr" />
                                <div class="row py-2">
                                    <div class="col-10 col-md-6">
                                        <label class="fw-bold pb-2 ps-1">Program Subscription</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <?php 
                                            $offersObj = new offers();

                                            // fetch
                                            if($data_result = $offersObj->select_offers_per_sub_type('Program Subscription')){
                                                foreach ($data_result as $key => $value) {
                                                    if($value['status_details'] =='active'){
                                                        echo '<option value="';echo_safe($value['offer_id']);echo '">';echo_safe($value['offer_name']);echo ' (₱';echo_safe($value['offer_price']);echo')</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-1 align-self-end mb-2">
                                        <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><strong>?</strong></button>
                                    </div>
                                    <div class="col-6 col-md-1 align-self-end py-2 py-lg-0 text-center">
                                        <button type="button" class="btn btn-success btn-lg"><i class='bx bx-plus-circle'></i></button>
                                    </div>
                                    <div class="col-6 col-md-1 align-self-end py-2 py-lg-0 text-center">
                                    <button type="button" class="btn btn-danger btn-lg"><i class='bx bx-minus-circle' ></i></button>
                                    </div>
                                </div>
                            </div>
                        <div class="button-row d-flex mt-4">
                            <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                        </div>
                        </div>
                    </div>
                    <!--single form panel-->
                    <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                    <h3 class="multisteps-form__title">Checkout</h3>
                    <hr class="hr" />
                    <div class="multisteps-form__content">
                        <div class="row">
                            <div class="col-12 col-lg-4 ms-5">
                                <div class="row py-1">
                                    <p><span class="fw-bold">Name: </span>Juan Dela Cruz</p>
                                </div>
                                <div class="row py-1">
                                    <p><span class="fw-bold">Phone Number: </span>0912345678</p>
                                </div>
                                <div class="row py-1">
                                    <p><span class="fw-bold">Email: </span>Cruz@gmail.com</p>
                                </div>
                                <div class="row py-1">
                                    <p><span class="fw-bold">Gender: </span>Male</p>
                                </div>
                                <div class="row py-1">
                                    <p><span class="fw-bold">Age: </span>22</p>
                                </div>
                            </div>
                            

                            <div class="col-12 col-md-7 ">
                            <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">Summary</h5>
                                <hr class="hr" />
                                <div class="container-fluid scroll overflow-auto">
                                    <div class="row">
                                        <p class="fw-bold m-0">Gym-Use Subscription</p>
                                        <div class="col-8 col-lg-9">
                                            <p class="card-text">1-Month Gym-Use(21 and Above)</p>
                                        </div>
                                        <div class="col-4 col-lg-3">
                                            <p><span class="fw-bold">₱800</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <p class="fw-bold m-0">Trainer Subscription</p>
                                        <div class="col-8 col-lg-9">
                                            <p class="card-text">1-Month Trainer</p>
                                        </div>
                                        <div class="col-4 col-lg-3">
                                            <p><span class="fw-bold">₱1500</span></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <p class="fw-bold m-0">Locker Subscription</p>
                                        <div class="col-8 col-lg-9">
                                            <p class="card-text">1-Month Locker</p>
                                        </div>
                                        <div class="col-4 col-lg-3">
                                            <p><span class="fw-bold">₱100</span></p>
                                        </div>
                                    </div>

                                </div>
                                <hr class="hr" />
                                <h5 class="card-title d-flex justify-content-end">Total: <span class="fw-light">₱2400</span></h5>
                            </div>
                            </div>
                        </div>
                        </div>
                        
                        <div class="button-row d-flex mt-4">
                            <div class="px-2">
                                <button class="btn btn-outline-primary js-btn-prev" type="button" title="Prev">Prev</button>
                            </div>
                            <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
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
                        <div class="row">
                        <div class="button-row d-flex mt-4 col-12">
                            <div class="px-2">
                                <button class="btn btn-outline-primary js-btn-prev" type="button" title="Prev">Prev</button>
                            </div>
                            <button class="btn btn-success ml-auto" type="button" title="Send">Avail</button>
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

</body>

</html>