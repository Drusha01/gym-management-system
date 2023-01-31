<?php

// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';

// -- start of test statements

echo dirname(__DIR__, 1);
echo '<br>';
echo dirname(__DIR__, 1).'/img/profile';
echo '<br>';

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
      echo 'moved';
      // resize file?
    }
  }
}
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
    $filename = md5($_FILES['profilepic']['name']).'.'.$extension;
    $counter = 0;
    // only move if the filename is unique
    while(is_dir($filename)){
      $counter++;
      $filename = md5($_FILES['profilepic']['name']).$counter.'.'.$extension;
    }
    // move file
    if (move_uploaded_file($_FILES['profilepic']['tmp_name'],$profilepic_dir.$filename )) {
      echo 'moved';
      // resize file?

      // resize profile

      // resize for thumb nail
    }
  }
}else{
  // use default picture
}
echo '<br>';
print_r($_POST);

// -- end of test statements


// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if($_SESSION['user_status_details'] =='active'){
    // check what type of user are we
    if($_SESSION['user_type_details'] =='admin'){
      // go to admin
    }else if($_SESSION['user_type_details'] == 'normal'){
      // go to userpage
      header('location: ../userpage.php');
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
    $userObj->setuser_phone_country_code_id('+63');
    $userObj->setuser_gender_details($_POST['gender']);

    $userObj->setuser_name($_POST['username']);
    $userObj->setuser_firstname($_POST['fname']);
    $userObj->setuser_lastname($_POST['lname']);
    $userObj->setuser_email($_POST['email']);
    $userObj->setuser_phone_number($_POST['phone']);
    $userObj->setuser_birthdate($_POST['birthdate']);
    $userObj->setuser_password_hashed(password_hash($_POST['password'], PASSWORD_ARGON2I));

    // check for duplicates
    if(!$userObj->user_duplicateAll()){
      // available
      // proceed

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
            echo 'moved';
            // resize file?
          }
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
          $filename = md5($_FILES['profilepic']['name']).'.'.$extension;
          $counter = 0;
          // only move if the filename is unique
          while(is_dir($filename)){
            $counter++;
            $filename = md5($_FILES['profilepic']['name']).$counter.'.'.$extension;
          }
          // move file
          if (move_uploaded_file($_FILES['profilepic']['tmp_name'],$profilepic_dir.$filename )) {
            echo 'moved';
            // resize file?

            // resize profile

            // resize for thumb nail
          }
        }
      }
      // note that the file must be uploaded before inserting the user
        echo 'available';
    }else{
        echo 'used';
    }
    print_r($_POST);
  }
}

// check if the account status is valid

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keno Gym | Sign-Up</title>
    <link rel="icon" type="images/x-icon" href="../images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/log-in.css">
    <link rel="stylesheet" href="../css/boxicons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
  <section class="container">
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
          <form class="form-signup p-2" method="post" enctype="multipart/form-data">
            <h2 class="text-center">Create Account</h2>
            <div class="form-group py-1">
              <label for="exampleFormControlFile1">Profile Picture</label>
              <input type="file" class="form-control-file" id="profilepic" name="profilepic" >
            </div>
            <div class="form-group py-1">
              <input type="text" class="form-control" name="username" placeholder="Username" onkeyup="functiononkeydown()">
            </div>
            <div class="form-group py-1">
                <div class="row">
                    <div class="col-md-6 py-1">
                        <input type="text" class="form-control" name="fname" placeholder="First Name" onkeyup="functiononkeydown()">
                    </div>
                    <div class="col-md-6 py-1">
                        <input type="text" class="form-control" name="lname" placeholder="Last Name"  onkeyup="functiononkeydown()" >
                    </div>
                </div>
            </div>
            <div class="form-group py-1">
                <input type="email" class="form-control" name="email" placeholder="Email" onkeyup="functiononkeydown()">
            </div>
            <div class="form-group py-1">
              <input type="number" class="form-control" name="phone" placeholder="Phone Number" onkeyup="functiononkeydown()">
            </div>
            <label>Gender</label>
            <div class="form-group py-1">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="Male" value="Male"  >
                    <label class="form-check-label" for="Male">Male</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="Female" value="Female" >
                    <label class="form-check-label" for="Female">Female</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="Other" value="Other" >
                    <label class="form-check-label" for="Other">Other</label>
                  </div>
            </div>
            <div class="form-group py-1">
              <label>Birth Date</label>
              <input type="date" class="form-control" name="birthdate" id="birthdate" >
            </div>
            <div class="form-group py-1">
              <label for="exampleFormControlFile1">Valid ID</label>
              <input type="file" class="form-control-file" id="valid_id" name="valid_id" accept="image/*" name="file">
            </div>
            <div class="form-group py-1">
            <input type="password" class="form-control" name="password" placeholder="Password" onkeyup="functiononkeydown()">
            </div>
            <div class="form-group py-1">
                <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" onkeyup="functiononkeydown()">
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-success btn-lg border-0 rounded"> <a class="text-decoration-none text-white" >Sign-Up</button>
            </div>
            <p class="text-center">Already Have an Account? <a class="text-decoration-none" href="../login/log-in.php">Log-in</a></p>
          </form>
          

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
function signup() {
  // get the
  var username = $('#email').val();
  var password = $('#password').val();
  var bday = $('#bday').val();
  console.log(username)
  console.log(bday)
  // javascript validation here 
  // ajax here

}

function functiononkeydown(){
  console.log('nice');
  // validate username
  // validate firstname
  // validate lastname 
  // validate email 
  // validate phone 
  // validated gender 
  // validate birthdate 
  // validate password 
  // validate confirm passowrd

  // validate profilepicture (can sign up but prompt that you didnt include the file)
  // also validate the size, width and height
  // validate valid id
  // also validate the size, width and height (can sign up but prompt that you didnt include the file)

  // if all is validated proceed to change the active status of sign up button
}

</script>