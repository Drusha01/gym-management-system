<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';

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
    <link rel="stylesheet" href="../css/boxicons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>

</head>
<body>

    <?php require_once '../includes/header.php';?>


    <div class="my_acc_edit">
        <div class="container">
            <div class="pb-1">
                <a class="text-decoration-none text-black" aria-current="page" href="user-profile.php"><span class='bx bxs-left-arrow align-middle fs-4'></span>Go Back</a>
            </div>
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <a id="ahref" href="../img/profile/<?php echo_safe($_SESSION['user_profile_picture'])?>"><img id="profile-src" src="../img/profile-resize/<?php echo_safe($_SESSION['user_profile_picture'])?>" alt="Admin" class="rounded-circle p-1 bg-danger" width="110"></a>
                                    <div class="mt-3">
                                        <h4><?php echo_safe($_SESSION['user_name'])?></h4>
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
                                            <h6 class="mb-0" ><?php echo_safe($_SESSION['user_name'])?></h6>
                                            <input type="text" style="visibility:hidden;" name="username" id="username" value="<?php echo_safe($_SESSION['user_id'])?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">First Name</h6>
                                        </div>
                                        <div class="col-sm-10 text-secondary">
                                            <input type="text" class="form-control" name="fname" id="fname" value="<?php echo_safe($_SESSION['user_firstname'])?>" placeholder="<?php echo_safe($_SESSION['user_firstname'])?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Middle Name</h6>
                                        </div>
                                        <div class="col-sm-10 text-secondary pb-1">
                                            <input type="text" class="form-control" name="mname" id="mname" value="<?php echo_safe($_SESSION['user_middlename'])?>" placeholder="<?php echo_safe($_SESSION['user_middlename'])?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2 align-self-center pb-1">
                                            <h6 class="mb-0">Last Name</h6>
                                        </div>
                                        <div class="col-sm-10 text-secondary">
                                            <input type="text" class="form-control" name="lname" id="lname" value="<?php echo_safe($_SESSION['user_lastname'])?>" placeholder="<?php echo_safe($_SESSION['user_lastname'])?>">
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
                                            require_once '../classes/genders.class.php';
                                            $genderObj = new genders();
                                            $data = $genderObj->get_gender_list();
                                            foreach ($data as $key => $value) {
                                                echo '<option value="';
                                                echo_safe($value['user_gender_details']);
                                                if ($value['user_gender_details'] == $_SESSION['user_gender_details']){
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
                                            <h6 class="mb-0"><?php echo_safe($_SESSION['user_email'])?></h6><a href="email/email-ver-form.php">change</a>
                                            
                                        </div>
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Phone Number</h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary pb-1">
                                            <input type="number" class="form-control" name="phone" id="phone" value="<?php echo_safe($_SESSION['user_phone_number'])?>" placeholder="<?php echo_safe($_SESSION['user_phone_number'])?>" maxlength="11">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Address</h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary pb-1">
                                            <input type="text" class="form-control" name="address" id="address" value="<?php echo_safe($_SESSION['user_address'])?>" placeholder="<?php echo_safe($_SESSION['user_address'])?>">
                                        </div>
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Birth Date</h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary pb-1">
                                            <input type="text" class="form-control" onfocus="(this.type='date')" name="birthdate" id="birthdate" value="<?php echo_safe($_SESSION['user_birthdate']);?>" placeholder="<?php echo_safe(date_format(date_create($_SESSION['user_birthdate']), "F d,Y"));?>"
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
                        <div class="row gutters-sm">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    

    <br>
    <?php require_once '../includes/footer.php';?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
     crossorigin="anonymous"></script>
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

<?php require_once("../js/user-edit-change-password.js");?>


function save_profile_info(){

    // console.log('profile');
    // ajax here
    // get all info
    xhttp_save_profile.open("POST", "user-edit-ajax-save-profile.php", true);
    xhttp_save_profile.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp_save_profile.send("user_id="+$('#username').val()+"&fname="+$('#fname').val()+"&mname="+$('#mname').val()+"&lname="
    +$('#lname').val()+"&gender="+$('#gender').val()+"&gender_other="+$('#gender_other').val()
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
    

    
    xhttp_save_profile_pictures.open("POST", "user-edit-ajax-picture.php");
    xhttp_save_profile_pictures.send(formData);
}
xhttp_save_profile_pictures.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var res = JSON.parse(xhttp_save_profile_pictures.responseText);
        var str = '';
        if(res['profile_picture'] == 'saved' || res['valid_id'] == 'saved'){
            if(res['profile_picture'] == 'saved'){
                str = str.concat('profile picture saved \n');
                // remove the picture in input
                // update the picture in profile
                document.getElementById("profilepic").value = null;
                $('#profilebutton').html('Upload new image');
                $('#ahref').attr("src", "../img/profile/"+res['profile_picture_src']);
                $('#profile-src').attr("src", "../img/profile-resize/"+res['profile_picture_src']);
                $('#profile-thumbnail-src').attr("src", "../img/profile-thumbnail/"+res['profile_picture_src']);
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