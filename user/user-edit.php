<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';


// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if($_SESSION['user_status_details'] =='active'){
    // check what type of user are we
    if($_SESSION['user_type_details'] =='admin'){
      // go to admin
      header('location:../admin/admin-profile.php');
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
    <link rel="icon" type="images/x-icon" href="../images/favicon.png">
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
                                    <img src="../img/profile-resize/<?php echo_safe($_SESSION['user_profile_picture'])?>" alt="Admin" class="rounded-circle p-1 bg-danger" width="110">
                                    <div class="mt-3">
                                        <h4><?php echo_safe($_SESSION['user_name'])?></h4>
                                        <form action="user-edit-picture.php" method="POST" enctype="multipart/form-data">
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
                                            <input type="submit" name="submit"class="btn btn-success px-4" value="Save Changes" >
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
                                            <input type="text" class="form-control" value="<?php echo_safe($_SESSION['user_name'])?>" placeholder="<?php echo_safe($_SESSION['user_name'])?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">First Name</h6>
                                        </div>
                                        <div class="col-sm-10 text-secondary">
                                            <input type="text" class="form-control" value="<?php echo_safe($_SESSION['user_firstname'])?>" placeholder="<?php echo_safe($_SESSION['user_firstname'])?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Middle Name</h6>
                                        </div>
                                        <div class="col-sm-10 text-secondary pb-1">
                                            <input type="text" class="form-control" value="<?php echo_safe($_SESSION['user_middlename'])?>" placeholder="<?php echo_safe($_SESSION['user_middlename'])?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2 align-self-center pb-1">
                                            <h6 class="mb-0">Last Name</h6>
                                        </div>
                                        <div class="col-sm-10 text-secondary">
                                            <input type="text" class="form-control" value="<?php echo_safe($_SESSION['user_lastname'])?>" placeholder="<?php echo_safe($_SESSION['user_lastname'])?>">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Gender</h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary pb-1">
                                        <select class="form-select" id="gender" name="gender">
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
                                        <input type="text" class="form-control" name="gender_other" id="gender_other" placeholder="Enter your gender"   >
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary pb-1">
                                            <input type="email" class="form-control" value="<?php echo_safe($_SESSION['user_email'])?>" placeholder="<?php echo_safe($_SESSION['user_email'])?>">
                                        </div>
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Phone Number</h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary pb-1">
                                            <input type="text" class="form-control" value="<?php echo_safe($_SESSION['user_phone_number'])?>" placeholder="<?php echo_safe($_SESSION['user_phone_number'])?>" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Address</h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary pb-1">
                                            <input type="text" class="form-control" value="<?php echo_safe($_SESSION['user_address'])?>" placeholder="<?php echo_safe($_SESSION['user_address'])?>">
                                        </div>
                                        <div class="col-sm-2 align-self-center pb-1"> 
                                            <h6 class="mb-0">Birth Date</h6>
                                        </div>
                                        <div class="col-sm-4 text-secondary pb-1">
                                            <input type="text" class="form-control" onfocus="(this.type='date')" value="<?php echo_safe(date_format(date_create($_SESSION['user_birthdate']), "F d,Y"));?>" placeholder="<?php echo_safe(date_format(date_create($_SESSION['user_birthdate']), "F d,Y"));?>"
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






<?php require_once("../js/user-edit-change-password.js");?>


function save_profile_info(){
    
}


</script>