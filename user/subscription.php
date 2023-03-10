<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';

if(isset($_SESSION['admin_id'])){
  header('location:../admin/admin_control_log_in.php');
}
// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if($_SESSION['user_status_details'] =='active'){
    // check what type of user are we
    if($_SESSION['user_type_details'] =='admin'){
      // go to admin
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
    <link rel="icon" type="images/x-icon" href="../images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/boxicons.min.css">

</head>
<body>

<?php require_once '../includes/header.php';?>

<section class="subscription-page px-1 px-lg-4">
    <div class="row">
        <div class="card border-0" style="background-color: #E2E2E2;">
        <div class="row p-3 d-flex align-items-center text-center text-lg-start">
          <div class="col-md-7 ms-lg-5 pb-3">
            <h6 class="fs-4 fw-normal">Our Gym Offers Four</h6>
            <h1 class="fs-1 fw-bolder fst-italic" style="color:#A73535;"><strong>SUBSCRIPTIONS</strong></h1>
            <p class="fw-light">Transform your body and achieve your fitness goals with our state-of-the-art and affordable gym facilities and expert guidance!</p>
            <a href="../user/user-avail.php" class="btn btn-danger rounded-pill " role="button" style="background-color: #A73535;">Subscribe Now!</a>
          </div>
          <div class="col-md-4 d-none d-lg-inline">
            <img src="../images/img-1.jpg" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
    

    <br>
  
    <div class="row align-items-md-stretch">
      <div class="col-md-6 mt-3">
        <div class="h-100 text-white bg-dark rounded-3 text-center text-lg-start">
          <div class="row pt-3">
            <div class="col-md-6 pt-4 ps-lg-4">
                <img src="../images/img-2.png" alt="" class="img-fluid ">
              </div>
              <div class="col-md-6 pt-2 px-4 px-lg-4 pb-3 pb-lg-4">
              <h6 class="fs-4 fw-bolder text-light">Gym-use</h6>
                    <p class="fw-light text-light">Unlock your full potential and achieve your fitness goals with our
                         top-of-the-line gym facilities and expert guidance. Whether you're looking to
                          build muscle, increase endurance, or simply maintain a healthy lifestyle,
                           our gym offers everything you need to take your fitness journey to the next level!</p>
                    <a href="../user/user-avail.php" class="btn btn-danger rounded-pill" role="button" style="background-color: #A73535;">Avail Now!</a>
              </div>
            </div>
          </div>
      </div>
      <div class="col-md-6 mt-3">
        <div class="h-100 text-white bg-dark rounded-3 text-center text-lg-start">
          <div class="row pt-3">
            <div class="col-md-6 pt-4 ps-lg-4">
                <img src="../images/img-3.png" alt="" class="img-fluid ">
              </div>
              <div class="col-md-6 pt-2 px-4 px-lg-4 pb-3 pb-lg-4">
              <h6 class="fs-4 fw-bolder text-light">Trainer</h6>
                <p class="fw-light text-light">Experience the ultimate fitness journey with our professional trainers by your side. 
                    From customized training plans to expert guidance and motivation, we'll take your workout to the next 
                    level and help you achieve your fitness goals like never before. Get ready to transform your 
                    body and mind and become the best version of yourself!</p>
                <a href="../user/user-avail.php" class="btn btn-danger rounded-pill" role="button" style="background-color: #A73535;">Avail Now!</a>
              </div>
            </div>
          </div>
      </div>
    </div>

    <div class="row align-items-md-stretch">
      <div class="col-md-6 mt-3">
        <div class="h-100 text-white bg-dark rounded-3 text-center text-lg-start">
          <div class="row pt-3">
            <div class="col-md-6 pt-4 ps-lg-4">
                <img src="../images/img-4.png" alt="" class="img-fluid ">
              </div>
              <div class="col-md-6 pt-2 px-4 px-lg-4 pb-3 pb-lg-4">
              <h6 class="fs-4 fw-bolder text-light">Locker</h6>
                <p class="fw-light text-light">Maximize your gym experience with our secure and 
                        convenient locker facilities. With spacious and easy-to-use lockers available 
                        for your belongings, you can focus on your workout without worrying about the 
                        safety of your personal items. Say goodbye to hassle and hello to peace of mind - only at our gym.</p>
                    <a href="../user/user-avail.php" class="btn btn-danger rounded-pill" role="button" style="background-color: #A73535;">Avail Now!</a>
              </div>
            </div>
          </div>
      </div>
      <div class="col-md-6 mt-3">
        <div class="h-100 text-white bg-dark rounded-3 text-center text-lg-start">
          <div class="row pt-3">
            <div class="col-md-6 pt-4 ps-lg-4">
                <img src="../images/img-5.png" alt="" class="img-fluid ">
              </div>
              <div class="col-md-6 pt-2 px-4 px-lg-4 pb-3 pb-lg-4">
              <h6 class="fs-5 fw-bolder text-light">Program</h6>
              <p class="fw-light text-light">Get ready to take your cardio game to the next level with our cutting-edge 
                        gym programs. Whether you're a seasoned runner or just starting out, our expertly designed cardio programs
                         will help you improve endurance, burn fat, and achieve your fitness goals. With personalized training plans
                          and top-of-the-line equipment, you'll have everything you need to crush your cardio workout and take your
                           fitness journey to new heights!</p>
                <a href="../user/user-avail.php" class="btn btn-danger rounded-pill" role="button" style="background-color: #A73535;">Avail Now!</a>
              </div>
            </div>
          </div>
      </div>
    </div>
   
<br>
   
</section>




<?php require_once '../includes/footer.php';?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>
</html>