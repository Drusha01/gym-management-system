<?php
// start session
session_start();

// includes
require_once '../../tools/functions.php';
require_once '../../classes/users.class.php';
require_once '../../classes/genders.class.php';
require_once '../../classes/admins.class.php';
            

// check if we are normal user
if(isset($_SESSION['user_id'])){
    header('location:../user/user-page.php');
}



if(isset($_SESSION['admin_id'])){
    // check admin user details
    if($_SESSION['admin_user_status_details'] == 'active'){
        // do nothing
        if($_SESSION['admin_user_type_details'] != 'admin'){
            header('location:../dashboard/dashboard.php');
        }
        if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){
            if(isset($_POST['add_admin'])){
                $userObj = new Users();
                // if new gender is found insert first the new gender then 
                $error = false;
                if(isset($_POST['gender']) &&  ($_POST['gender'] != 'Other' || $_POST['gender'] != 'None')){
                    $userObj->setuser_gender_details($_POST['gender']);
                }
                if(isset($_POST['gender_other']) && strlen($_POST['gender_other'])>0 ){
                    $userObj->setuser_gender_details($_POST['gender_other']);
                    $genderObj = new genders();
                    $genderObj->insert_new_gender($_POST['gender_other']);
                    //echo 'other_gender';
                }

                if(validate_signup($_POST) ){
                // set attributes
                $userObj->setuser_status_details('active');
                $userObj->setuser_type_details('normal');
                
                $userObj->setuser_phone_contry_code_details('+63');

                $userObj->setuser_phone_number($_POST['phone']);
                $userObj->setuser_email($_POST['email']);
                $userObj->setuser_name($_POST['username']);
                $userObj->setuser_password_hashed(password_hash($_POST['password'], PASSWORD_ARGON2I));
                $userObj->setuser_firstname($_POST['fname']);
                $userObj->setuser_middlename($_POST['mname']);
                $userObj->setuser_lastname($_POST['lname']);
                $userObj->setuser_birthdate($_POST['birthdate']);
                
                

                // check for duplicates
                if(!$userObj->user_duplicateAll()){
                    // available
                    // proceed

                    $valid_id = true;
                    $profile_pic = true;
                    // set default valid id and profile picture
                    $userObj->setuser_valid_id_photo('default.png');
                    $userObj->setuser_profile_picture('default.png');
                    // check the valid id file upload
                    if (isset($_FILES['valid_id'])) {
                        $valid_id = false;
                        $type = array('png', 'bmp', 'jpg');
                        $size = (1024 * 1024) * 5; // 2 mb
                        if (validate_file($_FILES, 'valid_id', $type, $size)) {
                            $valid_id_dir = dirname(__DIR__, 2) . '/img/valid-id/';
                            // check if the folder exist  
                            if(!is_dir($valid_id_dir)){
                            // create directory
                                mkdir($valid_id_dir);
                            }
                            $extension = getFileExtensionfromFilename($_FILES['valid_id']['name']);
                            $filename = md5($_FILES['valid_id']['name']).'.'.$extension;
                            $counter = 0;
                            // only move if the filename is unique
                            while(is_dir($filename)){
                                $counter++;
                                $filename = md5($_FILES['valid_id']['name']).$counter.'.'.$extension;
                            }
                            // move file
                            if (move_uploaded_file($_FILES['valid_id']['tmp_name'],$valid_id_dir.$filename )) {
                                $valid_id = true;
                                
                                // change valid id photo in db
                                $userObj->setuser_valid_id_photo($filename);
                            // echo 'moved';

                            // resize file?
                        }
                    }

                    // check the profile picture file upload
                    if (isset($_FILES['profilepic'])) {
                        $profile_pic = false;
                        $type = array('png', 'bmp', 'jpg');
                        $size = (1024 * 1024) * 5; // 2 mb
                        if (validate_file($_FILES, 'profilepic', $type, $size)) {
                            $profilepic_dir = dirname(__DIR__, 2) . '/img/profile/';
                            // check if the folder exist  
                            if(!is_dir($profilepic_dir)){
                            // create directory
                            mkdir($profilepic_dir);
                            }
                            $extension = getFileExtensionfromFilename($_FILES['profilepic']['name']);
                            $filename = md5($_FILES['profilepic']['name']);
                            $counter = 0;
                            // only move if the filename is unique
                            while(file_exists($profilepic_dir.$filename.'.jpg')){
                            $counter++;
                            $filename = md5($_FILES['profilepic']['name'].$counter);
                            }
                            switch($extension){
                            case 'png':
                                $img = imagecreatefrompng($_FILES['profilepic']['tmp_name']);
                                // convert jpeg
                                imagejpeg($img,$profilepic_dir.$filename.'.jpg',100);
                                break;
                            case 'bmp':
                                $img = imagecreatefrompng($_FILES['profilepic']['tmp_name']);
                                // convert jpeg
                                imagejpeg($img,$profilepic_dir.$filename.'.jpg',100);
                                break;
                            case 'jpg':
                                move_uploaded_file($_FILES['profilepic']['tmp_name'], $profilepic_dir.$filename.'.jpg');
                                break;
                            }

                            $userObj->setuser_profile_picture($filename.'.jpg');

                                $profile_resize_dir = dirname(__DIR__, 2) . '/img/profile-resize/';
                                $profile_thumbnail_dir = dirname(__DIR__, 2) . '/img/profile-thumbnail/';
                            // check if the profile-resize folder exist
                            if(!is_dir($profile_resize_dir)){
                            // create directory
                                mkdir($profile_resize_dir);
                            }
                            // check if the resize folder thumbnail
                            if(!is_dir($profile_thumbnail_dir)){
                            // create directory
                                mkdir($profile_thumbnail_dir);
                            }
                            // resize file

                            // profile display
                            $result = resizeImage($profilepic_dir,$profile_resize_dir,$filename.'.jpg',$filename,80,500,500);
                            if($result){
                                echo 'error resize 500x500';
                            }
                            // thumbnail
                                $result = resizeImage($profilepic_dir,$profile_thumbnail_dir,$filename.'.jpg',$filename,80,150,150);
                            if($result){
                                echo 'error resize 150x150';
                            }
                        }
                    }
                }

                // note that the file must be uploaded before inserting the user
                // insert
                if ($userObj->signup() ) {
                // echo 'signup -done';
                    // require_once '../../classes/trainers.class.php';
                    $adminObj = new admins();
                    if(isset($_POST['Offer']) && isset($_POST['Avail']) && isset($_POST['Account']) && isset($_POST['Payment']) && isset($_POST['Maintenance'])&& isset($_POST['Report'])){
                        if($adminObj->add($userObj->user_id_with_username()['user_id'],$_POST['Offer'],$_POST['Avail'],$_POST['Account'],$_POST['Payment'],$_POST['Maintenance'],$_POST['Report'])){
                            header('location:settings.php');
                        }else{
                            echo 'error';
                        }
                    }
                    // $trainerObj = new trainers();
                    // $userObj->setuser_name($_POST['username']);
                    // if($trainerObj->add_trainer_with_id($userObj->user_id_with_username()['user_id'])){
                    //     header('location:account.php');
                    // }
                    // get_user_details
                    //$user_details = $userObj->get_user_details();
                    // set session
                    // $_SESSION['user_id'] = $user_details['user_id'];
                    // $_SESSION['user_status_details'] = $user_details['user_status_details'];
                    // $_SESSION['user_type_details'] = $user_details['user_type_details'] ;
                    // $_SESSION['user_gender_details'] = $user_details['user_gender_details'];
                    // $_SESSION['user_phone_contry_code_details'] = $user_details['user_phone_contry_code_details'];

                    // $_SESSION['user_phone_number'] = $user_details['user_phone_number'];
                    // $_SESSION['user_email'] =$user_details['user_email'];
                    // $_SESSION['user_name'] = $user_details['user_name'];
                    // $_SESSION['user_password_hashed'] = 'null';
                    // $_SESSION['user_firstname'] = $user_details['user_firstname'];

                    // $_SESSION['user_middlename'] = $user_details['user_middlename'];
                    // $_SESSION['user_lastname'] = $user_details['user_lastname'];
                    // $_SESSION['user_address'] = $user_details['user_address'];
                    // $_SESSION['user_birthdate'] = $user_details['user_birthdate'];
                    // $_SESSION['user_valid_id_photo'] = $user_details['user_valid_id_photo'];

                    // $_SESSION['user_profile_picture'] = $user_details['user_profile_picture'];
                    // $_SESSION['user_date_created'] = $user_details['user_date_created'];
                    // $_SESSION['user_date_updated'] = $user_details['user_date_updated'];
                    // go to user page
                        
                    }else{
                        echo 'error-sign up';
                    }
                    }else{
                        echo 'used';
                    }
                }
            }
        }elseif(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Read-Only'){
            //d
            header('location:../dashboard/dashboard.php');
        }else{
            //do not load the page
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
        <h5 class="col-7 col-lg-4 fw-bold mb-3 ms-2">Add User</h5>
        <a class="col text-decoration-none text-black m-0" aria-current="page" href="settings.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
    </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs application">
                <li class="nav-item active ">
                    <a class="nav-link" href="#tab-exist" data-bs-toggle="tab">Existing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab-new" data-bs-toggle="tab">New</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show fade" id="tab-exist">
                    <?php require_once 'add-new-exist.php'; ?>
                </div>
                <div class="tab-pane show fade" id="tab-new">
                    <?php require_once 'add-new-user.php'; ?>
                </div>
            </div>
        </div>


<div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Existing User to Trainer</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label for="message" class="form-label" id ="modal_message">Are you sure you want to XXXXXX existing user to Trainer? </label>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="button" data-bs-toggle="modal" id="user_id_modal" value="" data-bs-dismiss="modal" onclick="add_modal_trainer()">Yes</button>
                    <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="secondModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Succesfully Added!</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Existing User is added to Trainer</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="errormodal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adding trainer failed!</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Existing User is failed to add to trainer</p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

<script>
$(".nav-item").on("click", function(){
            $(".nav-item").removeClass("active");
            $(this).addClass("active");

        });
</script>
<script>
    $.ajax({
        type: "GET",
        url: 'exist_tbl.php',
        success: function(result)
        {
            $('div.table-exist-1').html(result);
            dataTable = $("#table-exist").DataTable({
                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                responsive: true,
            });
            $('input#keyword').on('input', function(e){
                var status = $(this).val();
                dataTable.columns([3]).search(status).draw();
            })
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });
</script>
</html>