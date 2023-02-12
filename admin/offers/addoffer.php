
<?php
// start session
session_start();

// includes

print_r($_POST);

// check if we are normal user
if(isset($_SESSION['user_id'])){
    header('location:../user/user-page.php');
}


if(isset($_SESSION['admin_id'])){
    // check admin user details
    if($_SESSION['admin_user_status_details'] == 'active'){
        // do nothing
        require_once '../../tools/functions.php';
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

<?php require_once '../includes/header.php';?>
<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>
    <main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
        <div class="w-100">
            <div class="row">
                <h5 class="col-8 col-lg-4 fw-bold mb-3">Add Offer</h5>
                <a class="col text-decoration-none text-black m-0" aria-current="page" href="offer.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
            </div>
            <div class="container">
                <form action="" method="POST">
                    <div class="row pb-2">
                        <div class="col-sm-5">
                            <label class="pb-1" for="name_offer">Name of Offer</label>
                            <input type="text" class="form-control" value="" id="offer_name" name="offer_name"placeholder="Enter Offer">
                        </div>
                    </div>
                    <div class="row pb-1">
                        <div class="col-lg-5">
                            <label class="pb-1" for="Age_Qual">Age Qualification</label>
                            <div class="row">
                                <div class="col-3 col-lg-3">
                                    <input type="text" class="form-control" value="" id="age_qualification_details" name="age_qualification_details" placeholder="">
                                </div>
                                
                                <div class="col-1 mt-2">
                                    <h6>or</h6>
                                </div>
                                <div class="col-2 mt-auto mb-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="checked" name="age_qualification_details_checked" id="age_qualification_details_checked" id="age_qualification_details_checked">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            None
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-2">
                        <div class="col-3 col-lg-2">
                            <label class="pb-1" for="name_offer">Days</label>
                            <input type="number" class="form-control" value="" id="offer_duration" placeholder="30" name="offer_duration">
                        </div>
                    </div>
                    <div class="row pb-2">
                        <div class="col-4 col-lg-2">
                            <label class="pb-1" for="name_offer">Price</label>
                            <input type="number" class="form-control" value="" id="offer_price" placeholder="₱00.00" name="offer_price">
                        </div>
                    </div>
                    <div class="row pb-2 pt-2">
                        <label>Type of Subscription</label>
                        <div class="container px-4">
                            <?php 
                                require_once '../../classes/type_of_subscriptions.class.php';

                                $sub_typeObj = new type_of_subscriptions();

                                if($sub_type_data = $sub_typeObj->fetch()){
                                    foreach ($sub_type_data as $key => $value) {
                                        echo '
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type_of_subscription" value ="';echo_safe($value['type_of_subscription_details']); echo '" id="';echo_safe($value['type_of_subscription_details']); echo '" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                ';echo_safe($value['type_of_subscription_details']); echo '
                                </label>
                            </div>';
                                        
                                    }
                                }
                            ?>
                            <!-- <div class="form-check">
                                <input class="form-check-input" type="radio" name="type_of_subscription" value ="Gym Subscription" id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Gym Subscription
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type_of_subscription" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Trainer Subscription
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type_of_subscription" id="flexRadioDefault3">
                                <label class="form-check-label" for="flexRadioDefault3">
                                    Locker Subscription
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type_of_subscription" id="flexRadioDefault4">
                                <label class="form-check-label" for="flexRadioDefault4">
                                    Program
                                </label>
                            </div> -->
                        </div>
                    </div>
                    <div class="row pb-1">
                        <div class="col-12 col-lg-5">
                            <label class="pb-1" for="Age_Qual">Slots</label>
                            <div class="row">
                                <div class="col-4">
                                    <input type="number" class="form-control" value="" name="offer_slots" id="offer_slots" placeholder="30">
                                </div>
                                <div class="col-1 mt-2">
                                    <h6>or</h6>
                                </div>
                                <div class="col-2 mt-auto mb-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"  name="offer_slots_checked" value="checked" id="offer_slots_checked">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            None
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex flex-row-reverse">
                        <div class="col-12 col-lg-8 d-grid d-lg-flex pt-3 pt-lg-1">
                            <button type="submit" class="btn btn-success  border-0 rounded" name="add_offer" value="submit" id="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        
    </main>


</body>
</html>