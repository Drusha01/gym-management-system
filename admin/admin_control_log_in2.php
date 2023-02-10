<?php
// start session
session_start();

// import class
require_once '../classes/admins.class.php';

// check if we are normal user
if(isset($_SESSION['user_id'])){
  header('location:../user/user-page.php');
}

print_r($_POST);

// check if we are logged in as admin
if(isset($_SESSION['admin_id'])){
  // go to dashboard
}else{
  // must be admin logint

  // check the post variable

  if(isset($_POST['admin_login']) && isset($_POST['admin_password']) && strlen($_POST['admin_login']) >= 6 && strlen($_POST['admin_password']) >= 12){
    // admin class instance
    $adminObj = new admins;
    if($admin_data = $adminObj->login_admin($_POST['admin_login'],$_POST['admin_login'])){
      if (password_verify($_POST['admin_password'], $admin_data['user_password_hashed'])) {
        // get user details and set it as admin
        $admin_data = $adminObj->get_admin_details($admin_data['admin_id']);
        // set session
        $_SESSION['admin_id'] = null;
        print_r($admin_data);
        //header('location:dashboard/dashboard.php');
      }
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
    <title>Keno Gym | Admin</title>
    <link rel="icon" type="images/x-icon" href="../images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/log-in.css">
    <link rel="stylesheet" href="../css/boxicons.min.css">
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
          <div class="row py-2">
            <h3 class="fw-normal text-center text-dark">Admin Control Log-In</h3>
          </div>
          <form class="mb-3 px-4" method="POST">
            <div class="form-floating mb-3">
              <input type="text" class="form-control rounded" placeholder="Enter your Email" id="floatingInput" name="admin_login" id="admin_login">
              <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control rounded" placeholder="Enter your Password" name="admin_password" id="admin_password">
              <label for="floatingPassword">Password</label>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="autoSizingCheck2">
              <label class="form-check-label">Remember Me</label>
            </div>
            <div class="d-grid gap-2 mb-3">
              <button type="submit" class="btn btn-dark btn-lg border-0 rounded" > Log In</button>
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