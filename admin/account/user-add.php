<?php


// start session
session_start();

// check if we are admin
// check if we are normal user
if(isset($_SESSION['user_id'])){
    header('location:../user/user-page.php');
}

// includes
require_once '../../tools/functions.php';
require_once '../../classes/users.class.php';
require_once '../../classes/genders.class.php';


  // check if we are logged in
if(isset($_SESSION['admin_id'])){
// check if the user is active
    if($_SESSION['admin_user_status_details'] =='active'){
        // check what type of user are we
        // must be sign up 
    // check the post global variable
        if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){
            if(isset($_POST['add_account'])){
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
                    $userObj->setuser_id($userObj->user_id_with_username()['user_id']);
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

                    if($_SESSION['admin_user_type_details'] != 'admin'){
                        require_once('../../classes/admins.class.php');
                        
                        require_once('../../classes/notifications.class.php');
                        $adminObj = new admins();
                        $notificationObj = new notifications();
                        if($admin_id_data = $adminObj->fetch_admin_id_of_admins()){
                            foreach ($admin_id_data as $key => $value) {
                                
                                $notification_info ='Staff '.$_SESSION['admin_user_lastname'].', '.$_SESSION['admin_user_firstname'].' '.$_SESSION['admin_user_middlename'].' added a new customer account.';
                                
                                if(!$notificationObj->insert($_SESSION['admin_user_id'],$value['user_id'],'Logs','logs.png', $notification_info)){
                                    exit('notification insert error');
                                }
                            }
                        }
                        
                    }
                        header('location:account.php');
                    }else{
                        echo 'error-sign up';
                    }
                    }else{
                        echo 'used';
                    }
                }
            }
        }elseif(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Read-Only'){
            //
            header('location:account.php');
        }else{
            //do not load the page
            header('location:../dashboard/dashboard.php');
        }

    }else if($_SESSION['user_status_details'] =='inactive'){
        // handle inactive user details
    }else if($_SESSION['user_status_details'] =='deleted'){
        // handle deleted user details
    }
}else{
    header('location:../admin_control_log_in.php');
}
?>


<?php require_once '../includes/header.php';?>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>
<body>
<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
    <div class="w-100">
        <div class="row">
            <h5 class="col-8 col-lg-4 fw-bold mb-3 ms-2">Add Account</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="account.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
        </div>
    </div>
    <div class="container-fluid">
        <form action="" method="POST" id="add_account_form">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="row form-group pb-2">
                        <div class="col-12">
                            <label for="exampleFormControlFile1">Profile Picture</label>
                            <input type="file" class="form-control" id="profilepic" name="profilepic" accept="image/*" >
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Username</label>
                            <input type="text" class="form-control" value="" id="username" name="username"placeholder="Enter Username" required onchange="validate_user_name()">
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col-12 col-lg-6">
                            <label class="pb-1 ms-1" for="name_offer">First Name</label>
                            <input type="text" class="form-control" value="" id="fname" name="fname"placeholder="Enter First Name" required>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="pb-1 ms-1" for="name_offer">Middle Name</label>
                            <input type="text" class="form-control" value="" id="mname" name="mname"placeholder="Enter Middle Name" >
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Last Name</label>
                            <input type="text" class="form-control" value="" id="lname" name="lname"placeholder="Enter Last Name" required>
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Phone Number</label>
                            <input type="text" class="form-control" value="" id="phone" maxlength="11" name="phone" placeholder="Enter Phone Number" required onchange="validate_phone()">
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Email</label>
                            <input type="email" class="form-control" value="" id="email" name="email"placeholder="Enter Email" required onchange="validate_email()">
                        </div>
                    </div>
                    
                    <div class="row form-group pb-2">
                        <div class="col-12 col-lg-6">
                            <label for="Gender">Gender</label>
                            <select class="form-select" id="gender" name="gender" onchange="genders()">
                                <option value="None" >Select Gender </option>
                                <?php 
                                
                                $genderObj = new genders();
                                $data = $genderObj->get_gender_list();
                                foreach ($data as $key => $value) {
                                    echo '<option value="';
                                    echo_safe($value['user_gender_details']);
                                    echo '"';
                                    echo 'id="';echo_safe($value['user_gender_details']);
                                    echo '">';
                                    echo_safe($value['user_gender_details']);
                                    echo '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class=" ms-1" for="name_offer">Not in the list?</label>
                            <input type="text" class="form-control" value="" id="gender_other" name="gender_other"placeholder="Enter gender" onchange="other_genders()">
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Birth Date</label>
                            <input type="date" class="form-control" value="<?php echo date('Y-m-d', time()-(60*60*24*365*18)); ?>" id="birthdate" name="birthdate"placeholder="Enter Birth Date" max="<?php echo date('Y-m-d', time()-60*60*24*5); ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label for="exampleFormControlFile1">ID or Birth Certificate</label>
                            <input type="file" class="form-control" id="valid_id" accept="image/*" >
                        </div>
                    </div>
                    <!-- <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Address</label>
                            <input type="text" class="form-control" value="" id="address" name="address"placeholder="Enter Address" tabindex="100" >
                        </div>
                    </div> -->

                    <div class="row form-group pb-2">
                        <div class="col-12">
                            <label class="pb-1 ms-1" for="name_offer">Password</label>
                            <input type="password" class="form-control" value="" id="password" name="password"placeholder="Enter Password" required onkeyup="function_password_validation('password','password_err')">
                        </div>
                        <div class="col-12 text-secondary pb-1" id='password_err'>
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col-12">
                            <label class="pb-1 ms-1" for="name_offer">Confirm Password</label>
                            <input type="password" class="form-control" value="" id="confirm_password" name="cpassword"placeholder="Confirm Password" required onkeyup="function_password_validation('confirm_password','confirm_password_error')">
                        </div>
                        <div class="col-12 text-secondary pb-1" id='confirm_password_error'>
                        </div>
                    </div>
                    
                </div>
            </div>
                <div class="row d-flex">
                    <div class="col-12 col-lg-1 d-grid d-lg-flex pt-3 pt-lg-1">
                        <button type="button" class="btn btn-success border-0 rounded" name="add_account" value="add_account" id="submit" onclick="">Submit</button>
                    </div>
                </div>
        </form>
    </div>
</main>
</body>


<script>
function genders(){
    $('#gender_other').val(''); 

    console.log('gender selected  changed');
    if(($('#gender').val() == 'None' )|| $('#gender').val() == 'Other'  ) {
        gender_valid= false;
        if($('#gender').val() == 'Other' && $('#gender_other').val().length>0){
            gender_valid= true;
        }
    }else{
        gender_valid= true;

    }
}
function other_genders(){
  $('#gender').val('Other'); 
  $('#gender option[value=Other]').attr('selected','selected'); 
  gender_valid = true;
  console.log('gender others changed');
}
var username_valid = false;
var gender_valid = false;
var email_valid = false;
var phone_valid = false;
var password_valid = false;

function validate_user_name(){
    var username = $('#username').val();
    if(username.length >=6){
        // ajax
        var values = $('#username').serialize();
        $.ajax({
            type: "POST",
            data: values,
            url: '../../ajax/user/usernamecheck.php',
            success: function(result)
            {
                if(result ==1){
                    $("#username").css("color","green");
                    username_valid =true;
                }else{
                    $("#username").css("color","red");
                    username_valid = false;
                }
               
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }
        });
    }else{
        $("#username").css("color","red");
        username_valid = false;
    }
}

function validate_email(){
    var email = $('#email').val();
    if(ValidateEmail(email)){
        var values = $('#email').serialize();
        $.ajax({
            type: "POST",
            data: values,
            url: '../../ajax/user/emailcheck.php',
            success: function(result)
            {
                if(result ==1){
                    $("#email").css("color","green");
                    email_valid =true;
                }else{
                    $("#email").css("color","red");
                    email_valid = false;
                }
               
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }
        });
    }else{
        $("#email").css("color","red");
    }
}

function ValidateEmail(mail) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)){
        // ajax email??
        return (true)
    }
        return (false)
    }

function validate_phone(){
    var phone = $('#phone').val();
    if(phone.length  == 11){
        $("#phone").css("color","green");
        phone_valid = true;
    }else{
        $("#phone").css("color","red");
        phone_valid = false;
    }
}

$("#submit").click(function (event) {
    // validate
    if(gender_valid && username_valid && email_valid && password_valid && phone_valid &&  $('#lname').val().length >0 && $('#fname').val().length >0 ){
        $(this).attr("type", "submit");
        $(this).click();
    }else{
        if(!username_valid){
            alert('invalid username');
            return;
        }
        if( $('#fname').val().length <=0){
            alert('first name is not populated');
            return;
        }
        if( $('#lname').val().length <=0){
            alert('lastname name is not populated');
            return;
        }
        if(!phone_valid){
            alert('invalid phone');
            return;
        }
        if(!email_valid){
            alert('invalid email');
            return;
        }
        if(!gender_valid){
            alert('invalid gender');
            return;
        }
        if(!password_valid){
            alert('invalid password');
            return;
        }
        
    }
    
    
});


function ValidatePassword(password){
    if(!ValidatePasswordLength(password)){
        // change the 
        return false;
    }
    if(!ValidatePasswordUppercase(password)){
        return false;
    }
    if(!ValidatePasswordLowercase(password)){
        return false;
    }
    if(!ValidatePasswordIsnum(password)){
        return false;
    }
    return true;
}

function ValidatePasswordLength(password){
    if(password.length <12){
        return false;
    }
    return true;
}
function ValidatePasswordUppercase(password){
    for (let i = 0; i < password.length; i++) {
        if(password.charCodeAt(i) > 64 && password.charCodeAt(i) < 91){
            return true;
        }
    }
    return false;
}
function ValidatePasswordLowercase(password){
    for (let i = 0; i < password.length; i++) {
        if(password.charCodeAt(i) > 96  && password.charCodeAt(i) < 123){
            return true;
        }
    }
    return false;
}
function ValidatePasswordIsnum(password){
    for (let i = 0; i < password.length; i++) {
        if(isNumber(password[i])){
            return true;
        }
    }
    return false;
}
function isNumber(char) {
    return /^\d$/.test(char);
}
function validatedPassowrdConfirmPassword(password,confirmpassword){
    return password  === confirmpassword;
}

function function_password_validation(password_id,error_id){
    let password = $('#'+password_id).val();
    password_valid = false;
    if(!ValidatePasswordLength(password)){
        // change the 
        //console.log('<12');
        $('#'+error_id).html('Password must be >= 12');
        return false;
    }
    if(!ValidatePasswordUppercase(password)){
        $('#'+error_id).html('Password must have uppercase letter');
        //console.log('u');
        return false;
    }
    if(!ValidatePasswordLowercase(password)){
        $('#'+error_id).html('Password must have lowercase letter');
        //console.log('u');
        return false;
    }
    if(!ValidatePasswordIsnum(password)){
        $('#'+error_id).html('Password must have number');
        return false;
    }
    $('#'+error_id).html('');
    let current_password = $('#password').val();
    let confirm_password = $('#confirm_password').val();

    if(!validatedPassowrdConfirmPassword(current_password,confirm_password)){
        $('#confirm_password_error').html('Password Password do not match');
        return false;
        
    }
    password_valid = true;
    
    $('#confirm_password_error').html('');

    

}
</script>