<?php
// start session
session_start();

// check if we are admin
if(isset($_SESSION['admin_user_id'])){
  header('location:../admin/admin_control_log-in2.php');
}


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
} else {
  // must be login
  // check the post global variable
  if (isset($_POST['user']) && isset($_POST['password']) && strlen($_POST['user'])>6 && strlen($_POST['password']) >=12 ) {
    // not that only login in email if the user is verified and at phone
    $userObj = new Users();
    $userObj->setuser_name($_POST['user']);
    $userObj->setuser_email($_POST['user']);
    $userObj->setuser_phone_number($_POST['user']);
    $user_data = $userObj->login();
    if($user_data){
      // verify password
      if (password_verify($_POST['password'], $user_data['user_password_hashed'])) {
        $userObj->setuser_id($user_data['user_id']);
        // once verified query the user details
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
        // go to dashboard (admin / userpage)
        print_r($user_data);
      }else{
        $error = 'Invalid';
      }
    }
    $error = 'Invalid';
  }else{
    $error = 'not yet submitted';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keno Gym | Log-In</title>
  <link rel="icon" type="images/x-icon" href="../images/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
  rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
  crossorigin="anonymous">
  <link rel="stylesheet" href="../css/log-in.css">
  <link rel="stylesheet" href="../css/boxicons.min.css">
  <html itemscope itemtype="http://schema.org/Article">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js">
</script>
<script src="https://apis.google.com/js/client:platform.js?onload=start" async defer>
</script>

<!-- Continuing the <head> section -->
<script>
    function start() {
      gapi.load('auth2', function() {
        auth2 = gapi.auth2.init({
          client_id: '53523092857-46kpu1ffikh67k7kckngcbm6k7naf8ic.apps.googleusercontent.com',
          // Scopes to request in addition to 'profile' and 'email'
          //scope: 'additional_scope'
        });
      });
    }
  </script>
</head>
<body>
  <section class="container">
    <div class="row content d-flex justify-content-center align-items-center">
      <div class="col-md-5">
        <div class="box shadow bg-white rounded">
          <div class="container-fluid bg-danger p-2 rounded-top d-inline-flex justify-content-center">
            <img src="../images/logo.png" alt="" width="60">
            <div class="d-flex flex-column p-2 pt-0 pb-0 ">
              <h3 class="mb-1 fs-5 text-white "><strong>KE-NO</strong></h3>
              <h6 class="mb-1 fs-10 text-white">Fitness Center</h6>
            </div>
          </div>
          <a class="text-decoration-none text-black m-0" aria-current="page" href="../index.php"><span class='bx bxs-left-arrow align-middle fs-4'></span>Go Back</a>
          <form class="mb-3 px-4" method="POST" enctype="multipart/form-data">
            <div class="form-floating mb-3">
              <input type="text" class="form-control rounded" placeholder="Enter email"  id="floatingInput" name="user" required>
              <label for="floatingInput"><?php if (isset($error) && $error=='Invalid') {echo $error . ' Email / Username  ';} else {echo 'Email / Username  ';}?> </label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control rounded" placeholder="Enter your Password" id="floatingPassword" name="password" required>
              <label for="floatingPassword"><?php if (isset($error) && $error=='Invalid') {echo $error . ' Password ';} else {echo 'Password';}?></label>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="autoSizingCheck2">
              <label class="form-check-label">Remember Me</label>
            </div>
            <div class="d-grid gap-2 mb-3">
              <button type="submit" class="btn btn-dark btn-lg border-0 rounded"> <a class="text-decoration-none text-white" >Log In</a></button>
            </div>
            <div class="forgot-password-link mb-3 text-end">
              <a href="#" title="Forgot Password" class="text-decoration-none"> Forgot Password?</a>
            </div>
            <p class="text-center">Don't Have an Account? <a class="text-decoration-none"href="sign-up.php">Sign-Up</a></p>
            <div class="d-flex">
              <hr class="my-auto flex-grow-1">
              <div class="px-4">OR</div>
              <hr class="my-auto flex-grow-1">
            </div>
            <div class="sign-up-accounts">
              <div class="social-accounts d-flex justify-content-center">
                <a href="#" title="Facebook"><i class='bx bxl-facebook'></i></a>
                <button type="button" id="signinButton" ><i class='bx bxl-google'></i></button>
              </div>
            </div>
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

<?php require_once("../js/login.js");?>


<script>
  $('#signinButton').click(function() {
    // signInCallback defined in step 6.
    auth2.grantOfflineAccess().then(signInCallback);
  });
</script>

<!-- Last part of BODY element in file index.html -->
<script>
function signInCallback(authResult) {
  if (authResult['code']) {

    // Hide the sign-in button now that the user is authorized, for example:
    
    var postForm = { //Fetch form data
          'code'     : authResult['code']; //Store name fields value
    };
    // Send the code to the server
    $.ajax({
      type: 'POST',
      url: 'https://kenogym.online/login/google.php',
      // Always include an `X-Requested-With` header in every AJAX request,
      // to protect against CSRF attacks.
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      contentType: 'application/octet-stream; charset=utf-8',
      success: function(result) {
        // Handle or verify the server response.
        $('#signinButton').attr('style', 'display: none');
        console.log(result);
      },
      processData: false,
      data: postForm
    });
  } else {
    // There was an error.
  }
}
</script>

