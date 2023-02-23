
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
        require_once '../../tools/functions.php';
        if(isset($_SESSION['admin_offer_restriction_details']) && $_SESSION['admin_offer_restriction_details'] == 'Modify'){
            if(isset($_POST['add_offer']) && $_POST['add_offer'] =='add_offer'){
                require_once '../../classes/offers.class.php';

                // validate add offer
                if(validate_offer($_POST)){
                    $offersObj = new offers();
                    $offer_name = $_POST['offer_name'];
                    $offer_status_details = 'active';
                    $offer_offer_type_of_subscription_details = $_POST['type_of_subscription'];
                    $offer_duration =$_POST['offer_duration'];
                    $offer_price =$_POST['offer_price'];
                    $offer_description = $_POST['offer_description'];
                    // validate age qualification
                    $error =false;
                    if(isset($_POST['age_qualification_details']) && strlen($_POST['age_qualification_details'])>0){
                        // insert
                        require_once '../../classes/age_qualification.class.php';
                        $age_qualObj = new age_qualifications();
                        $age_qualObj->insert($_POST['age_qualification_details']);
                        // if this is set then
                        $offer_age_qualification_details =$_POST['age_qualification_details'];
                    }else if(isset($_POST['age_qualification_details_checked']) && $_POST['age_qualification_details_checked'] == 'None'){
                        $offer_age_qualification_details =$_POST['age_qualification_details_checked'];
                    }else{
                        $error =true;
                    }
                    
                    // validate slots
                    if(isset($_POST['offer_slots']) && strlen($_POST['offer_slots'])>0 && intval($_POST['offer_slots']) > 0){
                        // if this is set then
                        $offer_slots =$_POST['offer_slots'];
                    }else if(isset($_POST['offer_slots_checked']) && $_POST['offer_slots_checked'] == 'None'){
                        $offer_slots =$_POST['offer_slots_checked'];
                    }else{
                        $error =true;
                    }

                    // validate the image
                    if (isset($_FILES['offer_file'])) {
                
                        $type = array('png', 'bmp', 'jpg');
                        $size = (1024 * 1024) * 5; // 5 mb
                        if (validate_file($_FILES, 'offer_file', $type, $size)) {
                            $offer_file_dir = dirname(__DIR__, 2) . '/img/offer-contents/';
                            // check if the folder exist  
                            if(!is_dir($offer_file_dir)){
                                // create directory
                                mkdir($offer_file_dir);
                            }
                            $extension = getFileExtensionfromFilename($_FILES['offer_file']['name']);
                            $filename = md5($_FILES['offer_file']['name']).'.'.$extension;
                            $counter = 0;
                            // only move if the filename is unique
                            while(file_exists($offer_file_dir.$filename)){
                                $counter++;
                                $filename = md5($_FILES['offer_file']['name'].$counter).'.'.$extension;
                            }
                            // move file
                            if (move_uploaded_file($_FILES['offer_file']['tmp_name'],$offer_file_dir.$filename )) {
                                $error = false;
                                
                                // change offer_file photo in db
                                
                                // echo 'moved';
                        
                                // resize file?
                            }else{
                                $error = true;
                            }
                        }
                    }

                    if(!$error){
                        if($offersObj->add($offer_name,$offer_status_details,$offer_offer_type_of_subscription_details,$offer_age_qualification_details,$offer_duration,$offer_slots,$offer_price,$offer_description,$filename)){
                            header('location:offer.php');
                        }
                    }
                }
            }
        }else{
            header('location:offer.php');
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
                <h5 class="col-8 col-lg-4 fw-bold mb-3">Add Offer</h5>
                <a class="col text-decoration-none text-black m-0" aria-current="page" href="offer.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
            </div>
            <div class="container">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row pb-2">
                        <div class="col-sm-5">
                            <label class="pb-1" for="name_offer">Name of Offer</label>
                            <input type="text" class="form-control" value="" id="offer_name" name="offer_name"placeholder="Enter Offer" required>
                        </div>
                    </div>
                    <div class="form-group py-3">
                        <label for="exampleFormControlFile1">Picture of Offer</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="offer_file"  accept="image/*"> 
                    </div>
                    <div class="row pb-1">
                        <div class="col-lg-5">
                            <label class="pb-1" for="Age_Qual">Age Qualification</label>
                            <div class="row">
                                <div class="col-3 col-lg-3">
                                    <input type="text" class="form-control" value="" id="age_qualification_details" name="age_qualification_details" placeholder="" onchange="agequalification()">
                                </div>

                                <div class="col-1 mt-2">
                                    <h6>or</h6>
                                </div>
                                <div class="col-2 mt-auto mb-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="None" name="age_qualification_details_checked" id="age_qualification_details_checked" id="age_qualification_details_checked" onchange="agequalification_check()">
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
                            <input type="number" class="form-control" value="" id="offer_duration" placeholder="30" name="offer_duration" required onchange="numchange('offer_duration')">
                        </div>
                    </div>
                    <div class="row pb-2">
                        <div class="col-4 col-lg-2">
                            <label class="pb-1" for="name_offer">Price</label>
                            <input type="number" class="form-control" value="" id="offer_price" placeholder="₱00.00" name="offer_price" required onchange="numchange('offer_price')">
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
                                <input class="form-check-input" type="radio" name="type_of_subscription" value ="';echo_safe($value['type_of_subscription_details']); echo '" id="';echo_safe($value['type_of_subscription_details']); echo '" required>
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
                                    <input type="number" class="form-control" value="" name="offer_slots" id="offer_slots" placeholder="" onchange="offer_slotsfunction()">
                                </div>
                                <div class="col-1 mt-2">
                                    <h6>or</h6>
                                </div>
                                <div class="col-2 mt-auto mb-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"  name="offer_slots_checked" value="None" id="offer_slots_checked" onchange="offer_slotsfunction_checked()">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            None
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pb-2">
                        <div class="col-sm-5">
                        <label for="exampleFormControlTextarea1">Description of Offer</label>
                        <textarea class="form-control" id="offer_description" name="offer_description" rows="3" value=""></textarea>
                        </div>
                    </div>
                    <div class="row d-flex flex-row-reverse">
                        <div class="col-12 col-lg-8 d-grid d-lg-flex pt-3 pt-lg-1">
                            <button type="button" class="btn btn-success  border-0 rounded" name="add_offer" value="add_offer" id="submit" onclick="submit_validation()">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        
    </main>


</body>
</html>

<script>

    function agequalification(){
        $('#age_qualification_details_checked').prop('checked', false); 
        console.log('text input changed');
    }
    function agequalification_check(){
        $('#age_qualification_details').val('') ;
        console.log('check box changed');
    }

    function offer_slotsfunction(){
        $('#offer_slots_checked').prop('checked', false); 
        console.log('text input changed');
    }
    function offer_slotsfunction_checked(){
        $('#offer_slots').val('') ;
        console.log('check box changed');
    }

    function numchange(name){
        if($("#"+name).val()<0){
            $("#"+name).val(0)
        }
    }

    function submit_validation(){
        console.log('submit');

        $(this).submit()  
    }
</script>