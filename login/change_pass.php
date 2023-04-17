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
  // must be change pass
  if(isset($_GET['code']) && isset($_SESSION['forgot_password_hashed']) && $_GET['code'] == $_SESSION['forgot_password_hashed']){
    // check if the code is valid
    require_once '../classes/forgot_password.class.php';
   
    
    $forgot_passwordObj = new forgot_password();
    $userObj = new users();

    if($forgot_password_data = $forgot_passwordObj->get_last_sent_email($_SESSION['forgot_user_id'])){
        require_once '../tools/functions.php';
        if(isset($_POST['new_password']) && isset($_POST['confirm_passwprd']) && validate_password_same($_POST,'new_password','confirm_passwprd') && validate_password($_POST,'new_password')){
            $userObj->setuser_id($_SESSION['forgot_user_id']);
            $userObj->setuser_password_hashed(password_hash($_POST['new_password'], PASSWORD_ARGON2I));
            if($userObj->change_user_password()){
                header('location:log-in.php');
                $_SESSION['forgot_user_id'] = NUll;
                $_SESSION['forgot_password_hashed'] = NUll;
            }else{
                $error="error changing password";
            }
        }
        print_r($_GET);
        print_r($_SESSION);
        print_r($_POST);
    }
   
  }else{
    header('location:log-in.php');
  }
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="google-signin-client_id" content="53523092857-46kpu1ffikh67k7kckngcbm6k7naf8ic.apps.googleusercontent.com">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keno Gym | Log-In</title>
  <link rel="icon" type="images/x-icon" href="../images/favicon.png">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/log-in.css">
  <link rel="stylesheet" href="../css/boxicons.min.css">
  <script defer src="../js/bootstrap.bundle.min.js"></script>
  <html itemscope itemtype="http://schema.org/Article">

<script src="https://apis.google.com/js/platform.js" async defer></script>


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
          <a class="text-decoration-none text-black m-0" aria-current="page" href="../user/user-profile.php"><span class='bx bxs-left-arrow align-middle fs-4'></span>Go Back</a>
          <div class="container px-4">
            <form action="" method="POST">
                <p class="fw-bold fs-5">Change password</p>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">New password</label>
                    <input type="password"  class="form-control"name="new_password" id="new_passwprd" required>
                    <label for="exampleInputEmail1" class="form-label">Confirm password</label>
                    <input type="password" class="form-control" name="confirm_passwprd" id="confirm_passwprd" required>
                </div>
                <?php 
                if(isset($error)){
                  echo ' 
                <div class="bg-danger text-dark bg-opacity-10 border border-danger rounded-1" id="error" ">
                  <div class="py-2 ms-3">
                      '.$error.'
                  </div>
                </div>';
                }?>
                <div class="text-center mt-2">
                  <input type="submit" name="Confirm E-Mail" value="Change password" class="btn btn-dark">
                </div>
            </form>
            <br>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    
  </script>
</body>

</html>