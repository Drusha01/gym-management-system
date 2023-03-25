<?php
// start session
session_start();

// import class
require_once '../classes/admins.class.php';

// check if we are normal user
if(isset($_SESSION['user_id'])){
  header('location:../user/user-page.php');
}



// check if we are logged in as admin
if(isset($_SESSION['admin_id'])){
  // go to dashboard
  header('location:dashboard/dashboard.php');
}else{
  // must be admin logint

  // check the post variable

  if(isset($_POST['admin_login']) && isset($_POST['admin_password']) && strlen($_POST['admin_login']) >= 6 && strlen($_POST['admin_password']) >= 12){
    // admin class instance
    $adminObj = new admins();
    if($admin_data = $adminObj->login_admin($_POST['admin_login'],$_POST['admin_login'])){
      if (password_verify($_POST['admin_password'], $admin_data['user_password_hashed'])) {
        // get user details and set it as admin
        $admin_data = $adminObj->get_admin_details($admin_data['admin_id']);
        // set session
        $_SESSION['admin_id'] = $admin_data['admin_id'];
        $_SESSION['admin_user_id'] = $admin_data['user_id'];
        $_SESSION['admin_user_status_details'] = $admin_data['user_status_details'];
        $_SESSION['admin_user_type_details'] = $admin_data['user_type_details'] ;
        $_SESSION['admin_user_gender_details'] = $admin_data['user_gender_details'];
        $_SESSION['admin_user_phone_contry_code_details'] = $admin_data['user_phone_contry_code_details'];

        $_SESSION['admin_user_phone_number'] = $admin_data['user_phone_number'];
        $_SESSION['admin_user_email'] =$admin_data['user_email'];
        $_SESSION['admin_user_name'] = $admin_data['user_name'];
        $_SESSION['admin_user_password_hashed'] = 'null';
        $_SESSION['admin_user_firstname'] = $admin_data['user_firstname'];
        $_SESSION['admin_user_middlename'] = $admin_data['user_middlename'];

        $_SESSION['admin_user_lastname'] = $admin_data['user_lastname'];
        $_SESSION['admin_user_address'] = $admin_data['user_address'];
        $_SESSION['admin_user_birthdate'] = $admin_data['user_birthdate'];
        $_SESSION['admin_user_valid_id_photo'] = $admin_data['user_valid_id_photo'];
        $_SESSION['admin_user_profile_picture'] = $admin_data['user_profile_picture'];

        $_SESSION['admin_offer_restriction_details'] = $admin_data['admin_offer_restriction_details'];
        $_SESSION['admin_avail_restriction_details'] = $admin_data['admin_avail_restriction_details'];
        $_SESSION['admin_account_restriction_details'] = $admin_data['admin_account_restriction_details'];
        $_SESSION['admin_payment_restriction_details'] = $admin_data['admin_payment_restriction_details'];
        $_SESSION['admin_maintenance_restriction_details'] = $admin_data['admin_maintenance_restriction_details'];
        $_SESSION['admin_report_restriction_details'] = $admin_data['admin_report_restriction_details'];

        $_SESSION['admin_user_date_created'] = $admin_data['user_date_created'];
        $_SESSION['admin_user_date_updated'] = $admin_data['user_date_updated'];
        $_SESSION['admin_user_name_verified'] = $user_details['user_name_verified'];
        $_SESSION['admin_user_email_verified'] = $user_details['user_email_verified'];
        $_SESSION['admin_user_phone_verified'] = $user_details['user_phone_verified'];


        header('location:dashboard/dashboard.php');
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

    <script defer src="../js/bootstrap.bundle.min.js"></script>
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
              <label class="bg-transparent"for="floatingInput">Enter Username</label>
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
</body>
</html>