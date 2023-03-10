<?php


// start session
session_start();

// check if we are admin
if(isset($_SESSION['admin_user_id'])){
  header('location:../admin/admin_control_log_in.php');
}

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';
require_once '../classes/genders.class.php';

  // check if we are logged in
  if(isset($_SESSION['user_id'])){
    // check if the user is active
    if($_SESSION['user_status_details'] =='active'){
      // check what type of user are we
      if($_SESSION['user_type_details'] =='admin'){
        // go to admin
        // header('location:../admin/dashboard/dashboard.php');
      }else if($_SESSION['user_type_details'] == 'normal'){
        // go to userpage
        header('location:../user/user-page.php');
      } 
    }else if($_SESSION['user_status_details'] =='inactive'){
      // handle inactive user details
    }else if($_SESSION['user_status_details'] =='deleted'){
      // handle deleted user details
    }
  }else{
    // must be sign up 
    // check the post global variable

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
      echo 'other_gender';
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
            $valid_id_dir = dirname(__DIR__, 1) . '/img/valid-id/';
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
            $profilepic_dir = dirname(__DIR__, 1) . '/img/profile/';
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

            $profile_resize_dir = dirname(__DIR__, 1) . '/img/profile-resize/';
            $profile_thumbnail_dir = dirname(__DIR__, 1) . '/img/profile-thumbnail/';
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
        echo 'signup -done';
        $userObj->setuser_id($userObj->user_id_with_username()['user_id']);
        // get_user_details
        $user_details = $userObj->get_user_details();
        // set session
        $_SESSION['user_id'] = $user_details['user_id'];
        $_SESSION['user_status_details'] = $user_details['user_status_details'];
        $_SESSION['user_type_details'] = $user_details['user_type_details'] ;
        $_SESSION['user_gender_details'] = $user_details['user_gender_details'];
        $_SESSION['user_phone_contry_code_details'] = $user_details['user_phone_contry_code_details'];

        $_SESSION['user_phone_number'] = $user_details['user_phone_number'];
        $_SESSION['user_email'] =$user_details['user_email'];
        $_SESSION['user_name'] = $user_details['user_name'];
        $_SESSION['user_password_hashed'] = 'null';
        $_SESSION['user_firstname'] = $user_details['user_firstname'];

        $_SESSION['user_middlename'] = $user_details['user_middlename'];
        $_SESSION['user_lastname'] = $user_details['user_lastname'];
        $_SESSION['user_address'] = $user_details['user_address'];
        $_SESSION['user_birthdate'] = $user_details['user_birthdate'];
        $_SESSION['user_valid_id_photo'] = $user_details['user_valid_id_photo'];

        $_SESSION['user_profile_picture'] = $user_details['user_profile_picture'];
        $_SESSION['user_date_created'] = $user_details['user_date_created'];
        $_SESSION['user_date_updated'] = $user_details['user_date_updated'];
        // go to user page
        header('location:../user/user-profile.php');
      }else{
        echo 'error-sign up';
      }
    }else{
        echo 'used';
    }
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keno Gym | Sign-Up</title>
    <link rel="icon" type="images/x-icon" href="../images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/log-in.css">
    <link rel="stylesheet" href="../css/boxicons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <html itemscope itemtype="http://schema.org/Article">
</head>
<body>
  <section class="container pt-4 pb-4">
    <div class="row content d-flex justify-content-center align-items-center">
      <div class="col-12 col-md-8 col-lg-7 col-xl-5">
        <div class="box shadow bg-white rounded">
          <div class="container-fluid bg-danger p-2 rounded-top d-inline-flex justify-content-center">
            <img src="../images/logo.png" alt="" width="55">
            <div class="d-flex flex-column p-2 pt-0 pb-0 ">
              <h3 class="mb-1 fs-5 text-white "><strong>KE-NO</strong></h3>
              <h6 class="mb-1 fs-10 text-white">Fitness Center</h6>
            </div>
          </div>
          <a class="text-decoration-none text-black m-0" aria-current="page" href="../index.php"><span class='bx bxs-left-arrow align-middle fs-4'></span>Go Back</a>
          <div class="container-fluid w-100">
            <form class="form-signup px-3" method="post" enctype="multipart/form-data">
            <h2 class="text-center">Create Account</h2>
            <div class="form-group py-1">
              <label for="exampleFormControlFile1">Profile Picture</label>
              <input type="file" class="form-control-file" id="profilepic" name="profilepic" accept="image/*" >
            </div>
            <div class="form-floating py-1">
              <input type="text" class="form-control" name="username" id="username" placeholder="Username" oninput="functiononkeyup()" required>
              <label for="floatingInput">Username</label>
            </div>
            <div class="form-group py-1">
                <div class="row">
                    <div class="form-floating col-md-6 py-1">
                        <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" oninput="functiononkeyup()" required>
                        <label for="floatingInput" class="ps-4">First Name</label>
                    </div>
                    <div class="form-floating col-md-6 py-1">
                        <input type="text" class="form-control" name="mname" id="mname" placeholder="Middle Name"  oninput="functiononkeyup()"  >
                        <label for="floatingInput" class="ps-4">Middle Name</label>
                    </div>
                </div>
            </div>
            <div class="form-floating py-1">
                <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" oninput="functiononkeyup()">
                <label for="floatingInput">Last Name</label>
            </div>
            <div class="form-floating py-1">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" oninput="functiononkeyup()" required>
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating py-1">
              <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" oninput="functiononkeyup()" minlength="11" maxlength="11" required>
              <label for="floatingInput">Phone Number</label>
            </div>
            <div class="form-group py-1">
              <div class="row">
                  <div class="form-floating col-md-6 py-1">
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
                    <label for="floatingSelect" class="ps-4">Gender</label>
                  </div>
                  <div class="form-floating col-md-6 py-1">
                        <input type="text" class="form-control" name="gender_other" id="gender_other" placeholder="Enter your gender"  oninput="functiononkeyup()" onchange="other_genders()"  >
                        <label for="floatingInput" class="ps-4">Not in the list?</label>
                  </div>
              </div>
            </div>
            <div class="form-group py-1">
              <label>Birth Date</label>
              <input type="date" class="form-control" id="birthdate" name="birthdate" onchange="functionOnchangeBirthdate(this)" id="birthdate" value="<?php echo date('Y-m-d', time()-(60*60*24*365*18)); ?>" required>
            </div>
            <div class="form-group py-2">
              <label for="exampleFormControlFile1" class="pb-1">
                <a class="d-none d-lg-block text-decoration-none text-dark"data-bs-toggle="tooltip" data-bs-placement="right" title="Valid ID must have a birthdate.">Valid ID or Birth Certificate</a> 
                <div class="row d-lg-none">
                  <div class="col-10"><p class="d-lg-none">Valid ID or Birth Certificate</p> </div>
                  <div class="col-2"><a tabindex="0" class="btn btn-dark btn-sm d-lg-none btn-circle fw-bolder" role="button" data-bs-toggle="popover" data-bs-trigger="focus" title="Info about Valid ID" data-bs-content="Valid ID must have a Birth Date on it.">?</a></div>
                </div>
              </label>
              <input type="file" class="form-control-file" id="valid_id" name="valid_id" accept="image/*"  >
            </div>
            <div class="form-floating py-1">
              <input type="password" class="form-control" name="password" placeholder="Password" oninput="functiononkeyup()" id="password" required>
              <label for="floatingInput">Password</label>
            </div>
            <div class="form-floating py-1">
                <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" oninput="functiononkeyup()" id="cpassword"required>
                <label for="floatingInput">Confirm Password</label>
            </div>
            <br>
            <div class="d-grid">
            <button type="submit" class="btn btn-success btn-lg border-0 rounded"  id="submit"> Sign-Up</button>
            </div>
            <p class="text-center">Already Have an Account? <a class="text-decoration-none" href="../login/log-in.php">Log-in</a></p>
        </form>

          </div>
          <div class="d-flex">
              <hr class="my-auto flex-grow-1">
              <div class="px-4">OR</div>
              <hr class="my-auto flex-grow-1">
          </div>
            <div class="sign-up-accounts">
              <div class="social-accounts d-flex justify-content-center">
                <a href="#" title="Facebook"><i class='bx bxl-facebook'></i></a>
                <a href="#" title="Facebook"><i class='bx bxl-google'></i></a>
              </div>
            </div>
          

        </div>
      </div>
    </div>
  </section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
crossorigin="anonymous"></script>
</body>
</html>
<script>
<?php require_once("../js/signup.js");?>


function genders(){
  $('#gender_other').val(''); 
  console.log('gender selected  changed');
}
function other_genders(){
  $('#gender').val('Other'); 
  $('#gender option[value=Other]').attr('selected','selected'); 
  console.log('gender others chandged');
}
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
</script>