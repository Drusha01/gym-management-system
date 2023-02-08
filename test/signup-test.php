<?php 
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';
$userObj = new Users();

// set attributes
$userObj->setuser_name('Drusha01');
$userObj->setuser_firstname('Hanrickson');
$userObj->setuser_lastname('Dumapit');
$userObj->setuser_email('hanz.dumapit54@gmail.com');
$userObj->setuser_phone_number('9265827343');
$userObj->setuser_gender_details('Male');
$userObj->setuser_birthdate('2000/08/31');
$userObj->setuser_password_hashed(password_hash('Uwat09hanz@2', PASSWORD_ARGON2I));


if(!$userObj->user_duplicateAll()){
    echo '0';
}else{
    echo '1';
}
// check for duplicates
echo $userObj->getuser_name();
echo '<br>';
echo $userObj->getuser_firstname();
echo '<br>';
echo $userObj->getuser_lastname();
echo '<br>';
echo $userObj->getuser_email();
echo '<br>';
echo $userObj->getuser_phone_number();
echo '<br>';
echo $userObj->getuser_gender_details();
echo '<br>';
echo $userObj->getuser_birthdate();
echo '<br>';
echo $userObj->getuser_password_hashed();
echo '<br>';



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

echo '<br>';
print_r($_POST);

// -- end of test statements
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
          <a class="text-decoration-none text-black m-0" aria-current="page" href="../index.php"><span class='bx bxs-left-arrow align-middle fs-4'></span>Go Back</a>
          <form class="form-signup p-2" method="post" enctype="multipart/form-data">
            <h2 class="text-center">Create Account</h2>
            <div class="form-group py-1">
              <label for="exampleFormControlFile1">Profile Picture</label>
              <input type="file" class="form-control-file" id="profilepic" name="profilepic" >
            </div>
            <div class="form-group py-1">
              <input type="text" class="form-control" name="username" id="username" placeholder="Username" oninput="functiononkeyup()" >
            </div>
            <div class="form-group py-1">
                <div class="row">
                    <div class="col-md-6 py-1">
                        <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" oninput="functiononkeyup()" >
                    </div>
                    <div class="col-md-6 py-1">
                        <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name"  oninput="functiononkeyup()"  >
                    </div>
                </div>
            </div>
            <div class="form-group py-1">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" oninput="functiononkeyup()" >
            </div>
            <div class="form-group py-1">
              <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone Number" oninput="functiononkeyup()" maxlength="10" >
            </div>
            <label>Gender</label>
            <div class="form-group py-1">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" oninput="functionOnchangeGender('Male')" id="Male" value="Male"  >
                    <label class="form-check-label" for="Male">Male</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"  name="gender" oninput="functionOnchangeGender('Female')" id="Female" value="Female" >
                    <label class="form-check-label" for="Female">Female</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"  name="gender" oninput="functionOnchangeGender('Other')" id="Other" value="Other" >
                    <label class="form-check-label" for="Other">Other</label>
                  </div>
            </div>
            <div class="form-group py-1">
              <label>Birth Date</label>
              <input type="date" class="form-control" id="birthdate" name="birthdate" onchange="functionOnchangeBirthdate(this)" id="birthdate" >
            </div>
            <div class="form-group py-1">
              <label for="exampleFormControlFile1">Valid ID</label>
              <input type="file" class="form-control-file" id="valid_id" name="valid_id" accept="image/*"  >
            </div>
            <div class="form-group py-1">
            <input type="password" class="form-control" name="password" placeholder="Password" oninput="functiononkeyup()" id="password" >
            </div>
            <div class="form-group py-1">
                <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" oninput="functiononkeyup()" id="cpassword">
            </div>
            <div class="d-grid">
            <button type="submit" class="btn btn-success btn-lg border-0 rounded" onclick="functiononsignup()" id="submit"> Sign-Up</button>
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