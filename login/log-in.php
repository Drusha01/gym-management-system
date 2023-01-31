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
      header('location: ../userpage.php');
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
    $userObj = new Users();
    $userObj->setuser_name($_GET['login']);
    $userObj->setuser_email($_GET['login']);
    $userObj->setuser_phone_number($_GET['login']);
    $data = $userObj->login();
    if(!$data){
        echo '0';
    }else{
        print_r($data);
        // verify password

        // once verified query the user details
        
        // go to dashboard (admin / userpage)
    }
  }else{
    $error = 'invalid';
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
            <img src="../images/logo.png" alt="" width="60">
            <div class="d-flex flex-column p-2 pt-0 pb-0 ">
              <h3 class="mb-1 fs-5 text-white "><strong>KE-NO</strong></h3>
              <h6 class="mb-1 fs-10 text-white">Fitness Center</h6>
            </div>
          </div>
          <a class="text-decoration-none text-black m-0" aria-current="page" href="../index.html"><span class='bx bxs-left-arrow align-middle fs-4'></span>Go Back</a>
          <form class="mb-3 px-4">
            <div class="form-floating mb-3">
              <input type="text" class="form-control rounded" placeholder="Email / Username / Phone" name ="user" id="email">
              <label for="floatingInput">Email / Username / Phone</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control rounded" placeholder="Enter your Password" name="password" id="password">
              <label for="floatingPassword">Password</label>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="autoSizingCheck2">
              <label class="form-check-label">Remember Me</label>
            </div>
            <div class="d-grid gap-2 mb-3">
              <button type="button" class="btn btn-dark btn-lg border-0 rounded"> <a class="text-decoration-none text-white" onclick="login()">Log In</a></button>
            </div>
            <p class="text-center">Don't Have an Account? <a class="text-decoration-none"href="../login/sign-up.php">Sign-Up</a></p>
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
function login() {
  // get the
  var username = $('#email').val();
  var password = $('#password').val()
  console.log(username)
  console.log(password)
  // javascript validation here 
  // ajax here

}
</script>