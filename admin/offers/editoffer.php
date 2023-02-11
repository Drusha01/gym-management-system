
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

        // get offer id
        if(isset($_GET['id'])){
            // include the db
            require_once '../../classes/offers.class.php';
            require_once '../../tools/functions.php';

            $offersObj = new offers();
            // get offer data
            if($offer_data = $offersObj->fetch_offer($_GET['id'])){
                // 
                //print_r($offer_data);
                
            }else{
                // error / not found
                header('location:offer.php');
            }

        }
        

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
                <h5 class="col-8 col-lg-4 fw-bold mb-3">Edit Offer</h5>
                <a class="col text-decoration-none text-black m-0" aria-current="page" href="offer.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
            </div>
            <div class="container">
                <form action="">
                    <div class="row pb-2">
                        <div class="col-sm-5">
                            <label class="pb-1" for="name_offer">Name of Offer</label>
                            <input type="text" class="form-control" id="name_offer" value="<?php echo_safe($offer_data['offer_name'])?>" placeholder="<?php echo_safe($offer_data['offer_name'])?>">
                        </div>
                    </div>
                    <div class="row pb-1">
                        <div class="col-lg-5">
                            <label class="pb-1" for="Age_Qual">Age Qualification</label>
                            <div class="row">
                                <div class="col-3 col-lg-3">
                                    <input type="text" class="form-control" value="" id="name_offer" placeholder="21">
                                </div>
                                <div class="col-1">
                                    <h4 class="fs-3">-</h4>
                                </div>
                                <div class="col-3 col-lg-3">
                                    <input type="text" class="form-control" value="" id="name_offer" placeholder="above">
                                </div>
                                <div class="col-1 mt-2">
                                    <h6>or</h6>
                                </div>
                                <div class="col-2 mt-auto mb-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
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
                            <input type="number" class="form-control" value="<?php echo_safe($offer_data['offer_duration'])?>" placeholder="<?php echo_safe($offer_data['offer_duration'])?>" id="name_offer" placeholder="30">
                        </div>
                    </div>
                    <div class="row pb-2">
                        <div class="col-4 col-lg-2">
                            <label class="pb-1" for="name_offer">Price</label>
                            <input type="number" class="form-control" value="<?php echo_safe($offer_data['offer_price'])?>" placeholder="<?php echo_safe($offer_data['offer_price'])?>" id="name_offer" placeholder="₱800.00">
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
                                        if($value['type_of_subscription_id'] == $offer_data['type_of_subscription_id']){
                                        echo '
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">';
                                    echo_safe($value['type_of_subscription_details']);
                                echo
                                '</label>
                            </div>';
                                        }else{
                                            echo '
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" >
                                <label class="form-check-label" for="flexRadioDefault1">';
                                    echo_safe($value['type_of_subscription_details']);
                                echo
                                '</label>
                            </div>';
                                        }
                                    }
                                }
                            ?>
                        
                            <!-- <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Gym Subscription
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" 
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Trainer Subscription
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                <label class="form-check-label" for="flexRadioDefault3">
                                    Locker Subscription
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
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
                                    <input type="number" class="form-control" value="<?php if($offer_data['offer_slots'] != 'None'){echo echo_safe($offer_data['offer_slots']);}?>" id="name_offer" placeholder="<?php if($offer_data['offer_slots'] != 'None'){echo echo_safe($offer_data['offer_slots']);}?>">
                                </div>
                                <div class="col-1 mt-2">
                                    <h6>or</h6>
                                </div>
                                <div class="col-2 mt-auto mb-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="None" name="offer_slots" id="flexCheckDefault" <?php if($offer_data['offer_slots'] == 'None'){echo 'checked';}?>>
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
                            <button type="submit" class="btn btn-success  border-0 rounded" name="save_offer" id="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        
    </main>


</body>
</html>