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
    if(validate_signup($_POST)){
      $userObj = new Users();
      // set attributes
      $userObj->setuser_status_details('active');
      $userObj->setuser_type_details('normal');
      $userObj->setuser_gender_details($_POST['gender']);
      $userObj->setuser_phone_contry_code_details('+63');

      $userObj->setuser_phone_number($_POST['phone']);
      $userObj->setuser_email($_POST['email']);
      $userObj->setuser_name($_POST['username']);
      $userObj->setuser_password_hashed(password_hash($_POST['password'], PASSWORD_ARGON2I));
      $userObj->setuser_firstname($_POST['fname']);
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
              echo 'error';
            }
            // thumbnail
            $result = resizeImage($profilepic_dir,$profile_thumbnail_dir,$filename.'.jpg',$filename,80,150,150);
            if($result){
              echo 'error';
            }
          }
        }
      }
      // note that the file must be uploaded before inserting the user
      // insert
      if ($userObj->signup() ) {
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
        echo 'error';
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
    <link rel="icon" type="images/x-icon" href="/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/log-in.css">
    <link rel="stylesheet" href="../css/boxicons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>
<body>
  <section class="container p-4">
    <div class="row content d-flex justify-content-center align-items-center">
      <div class="col-md-5">
        <div class="box shadow bg-white rounded">
          <div class="container-fluid bg-danger p-2 rounded-top d-inline-flex justify-content-center">
            <img src="../images/logo.png" alt="" width="55">
            <div class="d-flex flex-column p-2 pt-0 pb-0 ">
              <h3 class="mb-1 fs-5 text-white "><strong>KE-NO</strong></h3>
              <h6 class="mb-1 fs-10 text-white">Fitness Center</h6>
            </div>
          </div>
          <a class="text-decoration-none text-black m-0" aria-current="page" href="../index.php"><span class='bx bxs-left-arrow align-middle fs-4'></span>Go Back</a>
          <div class="container">
            <form class="form-signup p-1" method="post" enctype="multipart/form-data">
            <h2 class="text-center">Create Account</h2>
            <div class="form-group py-1">
              <label for="exampleFormControlFile1">Profile Picture</label>
              <input type="file" class="form-control-file" id="profilepic" name="profilepic" >
            </div>
            <div class="form-group py-1">
              <input type="text" class="form-control" name="username" id="username" placeholder="Username" oninput="functiononkeyup()" required>
            </div>
            <div class="form-group py-1">
                <div class="row">
                    <div class="col-md-6 py-1">
                        <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" oninput="functiononkeyup()" required>
                    </div>
                    <div class="col-md-6 py-1">
                        <input type="text" class="form-control" name="mname" id="mname" placeholder="Middle Name"  oninput="functiononkeyup()"  required>
                    </div>
                </div>
            </div>
            <div class="form-group py-1">
                <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" oninput="functiononkeyup()">
            </div>
            <div class="form-group py-1">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" oninput="functiononkeyup()" required>
            </div>
            <div class="form-group py-1">
              <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone Number" oninput="functiononkeyup()" maxlength="10" required>
            </div>
            <div class="form-group py-1">
              <div class="row">
                  <div class="col-md-6 py-1">
                  <label for="exampleFormControlSelect1">Gender</label>
                    <select class="form-select" id="exampleFormControlSelect1">
                      <option>Male</option>
                      <option>Female</option>
                      <option>Helicopter</option>
                    </select>
                  </div>
                  <div class="col-md-6 py-1">
                  <label for="exampleFormControlSelect1">Other</label>
                        <input type="text" class="form-control" name="mname" id="mname" placeholder="Other"  oninput="functiononkeyup()"  required>
                  </div>
              </div>
            </div>
            <div class="form-group py-1">
              <label>Birth Date</label>
              <input type="date" class="form-control" id="birthdate" name="birthdate" onchange="functionOnchangeBirthdate(this)" id="birthdate" required>
            </div>
            <div class="form-group py-2">
              <label for="exampleFormControlFile1">Valid ID or Birth Certificate</label>
              <input type="file" class="form-control-file" id="valid_id" name="valid_id" accept="image/*"  >
            </div>
            <div class="form-group py-1">
            <input type="password" class="form-control" name="password" placeholder="Password" oninput="functiononkeyup()" id="password" required>
            </div>
            <div class="form-group py-1">
                <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" oninput="functiononkeyup()" id="cpassword"required>
            </div>
            <br>
            <div class="d-grid">
            <button type="submit" class="btn btn-success btn-lg border-0 rounded" onclick="functiononsignup()" id="submit"> Sign-Up</button>
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
</script>