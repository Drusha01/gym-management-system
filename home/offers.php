<?php
// start session
session_start();


if(isset($_SESSION['admin_id'])){
  header('location:admin/admin_control_log_in2.php');
}

// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if($_SESSION['user_status_details'] =='active'){
    // check what type of user are we
    if($_SESSION['user_type_details'] =='admin'){
      // go to admin
    }else if($_SESSION['user_type_details'] == 'normal'){
      // go to user-page
      header('location:user/user-page.php');
    } 
  }else if($_SESSION['user_status_details'] =='inactive'){
    // handle inactive user details
  }else if($_SESSION['user_status_details'] =='deleted'){
    // handle deleted user details
  }
} else {
  // go to login page
  //header('location:../login/log-in.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keno Gym | About</title>
    <link rel="icon" type="images/x-icon" href="images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="../css/boxicons.min.css">
</head>
<body>
<?php require_once '../includes/top-nav-home.php';?>
<section class="offers_home">
<!-- Courses Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h6 class="text-danger text-uppercase mb-2">Gym Subscriptions</h6>
            <h1 class="display-6 mb-4">Our Gym Offers 4 Subscriptions</h1>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="courses-item d-flex flex-column bg-light overflow-hidden h-100">
                    <div class="text-center p-4 pt-0">
                        <div class="d-inline-block bg-danger text-white fs-5 py-1 px-4 mb-4"><i class='bx bx-dumbbell fs-3 mt-2'></i></div>
                        <h5 class="mb-3">Gym-Use</h5>
                        <p>With this subscription, you can use our gym freely and enjoy a variety of exercise options to help you achieve your fitness goals.</p>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="../images/img-2.png" alt="">
                        <div class="courses-overlay">
                            <a class="btn btn-outline-danger border-2" href="">Avail Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="courses-item d-flex flex-column bg-light overflow-hidden h-100">
                    <div class="text-center p-4 pt-0">
                        <div class="d-inline-block bg-danger text-white fs-5 py-1 px-4 mb-4"><i class='bx bx-universal-access fs-3 mt-1'></i></div>
                        <h5 class="mb-3">Trainer</h5>
                        <p>Get personalized fitness guidance and support by availing our experienced trainers. Sign up for our subscription now to maximize your workouts and achieve your fitness goals faster.</p>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="../images/img-3.png" alt="">
                        <div class="courses-overlay">
                            <a class="btn btn-outline-danger border-2" href="">Avail Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="courses-item d-flex flex-column bg-light overflow-hidden h-100">
                    <div class="text-center p-4 pt-0">
                        <div class="d-inline-block bg-danger text-white fs-5 py-1 px-4 mb-4"><i class='bx bx-cabinet fs-3 mt-2'></i></div>
                        <h5 class="mb-3">Locker</h5>
                        <p>Sign up for our gym-use subscription and add a subscription for convenient locker storage for your belongings.</p>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="../images/img-4.png" alt="">
                        <div class="courses-overlay">
                            <a class="btn btn-outline-danger border-2" href="">Avail Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="courses-item d-flex flex-column bg-light overflow-hidden h-100">
                    <div class="text-center p-4 pt-0">
                        <div class="d-inline-block bg-danger text-white fs-5 py-1 px-4 mb-4"><i class='bx bx-calendar-star fs-3 mt-2' ></i></div>
                        <h5 class="mb-3">Programs</h5>
                        <p>In addition to our gym, trainers, and lockers, we offer a variety of fitness programs to help you achieve your goals. Sign up for our subscription to gain access to our programs and take your fitness journey to the next level.</p>
                    </div>
                    <div class="position-relative mt-auto">
                        <img class="img-fluid" src="../images/img-5.png" alt="">
                        <div class="courses-overlay">
                            <a class="btn btn-outline-danger border-2" href="">Avail Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Courses End -->

</section>


<?php require_once '../includes/footer.php';?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/owl.carousel.min.js"></script>
<script src="../js/jquery.animateNumber.min.js"></script>
<script src="../js/jquery.waypoints.min.js"></script>
<script src="../js/jquery.fancybox.min.js"></script>
<script src="../js/aos.js"></script>
<script src="../js/moment.min.js"></script>
<script src="../js/daterangepicker.js"></script>
<script src="../js/custom.js"></script>

</body>
</html>
