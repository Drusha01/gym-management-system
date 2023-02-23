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
        // 
        // query the user information with id
        // 
        if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){
            require_once '../../classes/users.class.php';
            require_once '../../tools/functions.php';
            $userObj = new users();
            if(isset($_GET['user_id'])){
                
                $userObj->setuser_id($_GET['user_id']);
                if(!$user_data = $userObj->get_user_details()){
                    return 'error';
                }
            }else if(isset($_GET['trainer_id'])){
                $userObj->setuser_id($_GET['trainer_id']);
                if(!$user_data = $userObj->get_user_details()){
                    return 'error';
                }
            }else{
                header('location:account.php');
            }
        }else{
            header('location:account.php');
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

<?php require_once '../includes/header.php'; ?>

<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>
<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
    <div class="w-100">
        <div class="row">
            <h5 class="col-7 col-lg-4 fw-bold  ms-3"><?php if(!isset($_GET['trainer'])){echo 'Account Profile (Edit)'; }else{ echo 'Trainer Profile (Edit)';}?></h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="account.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a> 
        </div>
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <a id="ahref" href="../../img/profile/<?php echo_safe($user_data['user_profile_picture'])?>"><img id="profile-src" src="../../img/profile-resize/<?php echo_safe($user_data['user_profile_picture'])?>" alt="Admin" class="rounded-circle p-1 bg-danger" width="110"></a>
                                    <div class="mt-3">
                                        <h4><?php echo_safe($user_data['user_name'])?></h4>
                                        <form action="user-edit-ajax-picture.php" method="POST" enctype="multipart/form-data">
                                            <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 5 MB</div>
                                            <!-- Profile picture upload button-->
                                            <input type="file" class="form-control-file" id="profilepic" name="profilepic" accept="image/*" style="visibility: hidden;" >
                                            <button class="btn btn-primary" id="profilebutton" type="button" onclick="$('#profilepic').click();">Upload new image</button>
                                            <hr>
                                            <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 5 MB</div>
                                            <!-- Profile picture upload button-->
                                            <input type="file" class="form-control-file" id="valid_id" name="valid_id" accept="image/*" style="visibility: hidden;" >
                                            <button class="btn btn-primary" id="valid_id_button" type="button" onclick="$('#valid_id').click();">Upload ID or Birth Certificate</button>
                                            <br>
                                            <br> 
                                            <input type="button" name="submit"class="btn btn-success px-4" onclick="save_pictures()" value="Save Changes" >
                                        </form>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="POST" >
                                    <div class="row mb-3">
                                        <div class="col-sm-2 align-self-center pb-1">
                                            <h6 class="mb-0">Username</h6>
                                        </div>
                                        <div class="col-sm-10 text-secondary">
                                            <h6 class="mb-0" ><?php echo_safe($user_data['user_name'])?></h6>
                                            <input type="text" style="visibility:hidden;" name="username" id="username" value="<?php echo_safe($user_data['user_id'])?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">First Name</h6>
                                        </div>
                                        <div class="col-sm-10 text-secondary">
                                            <input type="text" class="form-control" name="fname" id="fname" value="<?php echo_safe($user_data['user_firstname'])?>" placeholder="<?php echo_safe($user_data['user_firstname'])?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Middle Name</h6>
                                        </div>
                                        <div class="col-sm-10 text-secondary pb-1">
                                            <input type="text" class="form-control" name="mname" id="mname" value="<?php echo_safe($user_data['user_middlename'])?>" placeholder="<?php echo_safe($user_data['user_middlename'])?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2 align-self-center pb-1">
                                            <h6 class="mb-0">Last Name</h6>
                                        </div>
                                        <div class="col-sm-10 text-secondary">
                                            <input type="text" class="form-control" name="lname" id="lname" value="<?php echo_safe($user_data['user_lastname'])?>" placeholder="<?php echo_safe($user_data['user_lastname'])?>">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Gender</h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary pb-1">
                                        <select class="form-select" id="gender" name="gender" onchange="genders()">
                                            <option value="None" >Select Gender </option>
                                            <?php 
                                            require_once '../../classes/genders.class.php';
                                            $genderObj = new genders();
                                            $data = $genderObj->get_gender_list();
                                            foreach ($data as $key => $value) {
                                                echo '<option value="';
                                                echo_safe($value['user_gender_details']);
                                                if ($value['user_gender_details'] == $user_data['user_gender_details']){
                                                    echo '" selected >';
                                                }else{
                                                    echo '" >';
                                                }
                                                
                                                echo_safe($value['user_gender_details']);
                                                
                                    
                                                echo '</option>';
                                            }
                                            ?>
                                        </select>
                                        </div>
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Not in the list?</h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary pb-1">
                                        <input type="text" class="form-control" name="gender_other" id="gender_other" placeholder="Enter your gender" onchange="other_genders()">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary pb-1">
                                        <?php echo_safe($user_data['user_email']); if(isset($user_data['user_email_verified'])){echo '<a class="btn btn-success float-right" id="view-valid-id">Verified ✓</a>';}else{echo('<a href="user-change-email-address.php" class="btn btn-success float-right" id="view-valid-id">Verify your email </a>');} ?>
                                        </div>
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Phone Number</h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary pb-1">
                                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo_safe($user_data['user_phone_number'])?>" placeholder="<?php echo_safe($user_data['user_phone_number'])?>" maxlength="11">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Address</h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary pb-1">
                                            <input type="text" class="form-control" name="address" id="address" value="<?php echo_safe($user_data['user_address'])?>" placeholder="<?php echo_safe($user_data['user_address'])?>">
                                        </div>
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Birth Date</h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary pb-1">
                                            <input type="text" class="form-control" onfocus="(this.type='date')" name="birthdate" id="birthdate" value="<?php echo_safe($user_data['user_birthdate']);?>" placeholder="<?php echo_safe(date_format(date_create($user_data['user_birthdate']), "F d,Y"));?>"
                                            onblur="(this.type='text')">
                                        </div>
                                    </div>                                
                                    <div class="row">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-3 text-secondary">
                                            <input type="button" class="btn btn-success px-4" value="Save Changes"  onclick="save_profile_info()">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- <div class="row gutters-sm">
                            <div class="col mt-2">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="" method="">
                                            <div class="row mb-3">
                                                <div class="col-sm-2 align-self-center pb-1"> 
                                                    <h6 class="mb-0">Current Password</h6>
                                                </div>
                                                <div class="col-sm-4 text-secondary pb-1">
                                                    <input type="password" class="form-control" value="" id="current_password" name="current_password" onkeyup="function_password_validation('current_password','current_password_error')">
                                                </div>
                                                <div class="col-sm-4 text-secondary pb-1" id='current_password_error'>
                                                    
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-2 align-self-center pb-1"> 
                                                    <h6 class="mb-0">New Password</h6>
                                                </div>
                                                <div class="col-sm-4 text-secondary pb-1">
                                                    <input type="password" class="form-control" value="" placeholder="" id="new_password" name="new_password" onkeyup="function_password_validation('new_password','new_password_error')">
                                                </div>
                                                <div class="col-sm-4 text-secondary pb-1" id='new_password_error'>
                                                    
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-2 align-self-center pb-1"> 
                                                    <h6 class="mb-0">Confirm New Password</h6>
                                                </div>
                                                <div class="col-sm-4 text-secondary pb-1">
                                                    <input type="password" class="form-control" value="" id="confirm_password" name="confirm_password" onkeyup="function_password_validation('confirm_password','confirm_password_error')">
                                                </div>
                                                <div class="col-sm-4 text-secondary pb-1" id='confirm_password_error'>
                                                    
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2"></div>
                                                <div class="col-sm-3 text-secondary">
                                                    <input type="button" class="btn btn-success px-4" value="Change Password" onclick="savepassword()">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


</body>
</html>

<script>
function profilefuntion(e){
    console.log('profile changed');
    // check if we have file 
    console.log($('#profilebutton').html('Selected'));
    console.log(e.target.files[0].name)
}

$(document).ready(function() {
    $('#profilepic').change(function(e) {
        var name = e.target.files[0].name;
        $('#profilebutton').html(name.substring(0, 30));
        console.log('changed')

    });
});

$(document).ready(function() {
    $('#valid_id').change(function(e) {
        var name = e.target.files[0].name;
        $('#valid_id_button').html(name.substring(0, 30));
        console.log('changed')

    });
});




function genders(){
    $('#gender_other').val(''); 
    console.log('gender selected  changed');
}
function other_genders(){
    $('#gender').val('Other'); 
    $('#gender option[value=Other]').attr('selected','selected'); 
    console.log('gender others changed');
}

<?php require_once("../../js/user-edit-change-password.js");?>


function save_profile_info(){

    // console.log('profile');
    // ajax here
    // get all info
    xhttp_save_profile.open("POST", "../admin-edit-profile/admin-edit-ajax-save-profile.php", true);
    xhttp_save_profile.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp_save_profile.send("user_id="+$('#username').val()+"&fname="+$('#fname').val()+"&mname="+$('#mname').val()+"&lname="
    +$('#lname').val()+"&gender="+$('#gender').val()+"&gender_other="+$('#gender_other').val()+"&email="+$('#email').val()
    +"&phone="+$('#phone').val()+"&address="+$('#address').val()+"&birthdate="+$('#birthdate').val());
    
}
var xhttp_save_profile = new XMLHttpRequest();

xhttp_save_profile.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Typical action to be performed when the document is ready:
        console.log(xhttp_save_profile.responseText);
        let response = xhttp_save_profile.responseText.trim();
        if(response =="saved"){
            console.log(xhttp_save_profile.responseText);
            // update the values and placeholders
            $('#fname').attr('placeholder',$('#fname').val());
            $('#mname').attr('placeholder',$('#mname').val());
            $('#lname').attr('placeholder',$('#lname').val());
            $('#email').attr('placeholder',$('#email').val());
            $('#phone').attr('placeholder',$('#fname').val());
            $('#address').attr('placeholder',$('#address').val());
            $('#birthdate').attr('placeholder',$('#birthdate').val());

            if($('#gender_other').val().length >0){
                optionText = $('#gender_other').val();
                optionValue = $('#gender_other').val();
                $('#gender').append(`<option value="${optionValue}">
                                       ${optionText}
                                  </option>`);
                $('#gender option[value='+$('#gender_other').val()+']').attr('selected','selected'); 
                $('#gender_other').val(''); 
            }
            alert(response);

            // alert saved
            
            
        }else{
            alert(response);
        }
     
      
    }
};

var xhttp_save_profile_pictures = new XMLHttpRequest();
function save_pictures(){
    var formData = new FormData();
    formData.append("profilepic", document.getElementById("profilepic").files[0]);
    formData.append("valid_id", document.getElementById("valid_id").files[0]);
    formData.append("user_id", document.getElementById("username").value );
    

    
    xhttp_save_profile_pictures.open("POST", "../admin-edit-profile/admin-edit-ajax-picture.php");
    xhttp_save_profile_pictures.send(formData);
}
xhttp_save_profile_pictures.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        console.log(xhttp_save_profile_pictures.responseText);
        var res = JSON.parse(xhttp_save_profile_pictures.responseText);
        var str = '';
        if(res['profile_picture'] == 'saved' || res['valid_id'] == 'saved'){
            if(res['profile_picture'] == 'saved'){
                str = str.concat('profile picture saved \n');
                // remove the picture in input
                // update the picture in profile
                document.getElementById("profilepic").value = null;
                $('#profilebutton').html('Upload new image');
                $('#ahref').attr("src", "../../img/profile/"+res['profile_picture_src']);
                $('#profile-src').attr("src", "../../img/profile-resize/"+res['profile_picture_src']);
                $('#profile-thumbnail-src').attr("src", "../../img/profile-thumbnail/"+res['profile_picture_src']);
                console.log('saved');
            }
            if(res['valid_id'] == 'saved'){
                str =str.concat('valid id saved\n');
                // remove the picture in input
                document.getElementById("valid_id").value = null;
                $('#valid_id_button').html('Upload ID or Birth Certificate');
            }
            alert(str);
        }else{
            // 
            alert('No pictures saved');
        }
        
    }
}
</script>