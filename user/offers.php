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
    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.3.1/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.0/css/dataTables.dateTime.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.3.1/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://datatables.net/extensions/fixedheader/examples/integration/responsive-bootstrap.html"></script>
    <script src="https://cdn.datatables.net/datetime/1.4.0/js/dataTables.dateTime.min.js"></script>

</head>
<body>

<?php require_once '../includes/header.php';?>
<section class="offers_home">
<!-- Page Header Start -->
<div class="container-fluid page-header py-6 my-6 mt-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="fw-bolder text-white display-4 mb-4">Offers</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-decoration-none text-white" href="user-page.php">Home</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item  active" aria-current="page" style="color:#A73535;">Offers</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
<!-- Courses Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h6 class="text-danger text-uppercase mb-2">Gym Subscriptions</h6>
            <h1 class="display-6 fw-bolder mb-4">Our Gym Offers 4 Subscriptions</h1>
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

 <!-- Features Start -->
 <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <h6 class="text-uppercase mb-2" style="color:#A73535;">We Just Don't Offer Subscriptions</h6>
                    <h1 class="display-6 mb-4 fw-bolder">We Also Offer Walk-In</h1>
                    <p class="mb-5">At our gym, we believe that fitness should be accessible to everyone. That's why we not only offer subscription plans but also welcome walk-ins to use our facilities. Whether you're a regular gym-goer or just starting out, we have something for everyone. Our state-of-the-art equipment, experienced trainers, and convenient locker storage are available to all, so come and visit us today to start your fitness journey.</p>
                    <div class="row gy-5 gx-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="d-flex align-items-center justify-content-center flex-shrink-0 btn-square me-3" style="background-color:#A73535;">
                                    <i class='bx bx-walk text-white fs-3 '></i>
                                </div>
                                <h5 class="mb-0">Walk-In Gym-Use</h5>
                            </div>
                            <span>Achieve your fitness goals effortlessly by walking into our gym and using our easy to use equipment. All equipments can be used. </span>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="d-flex align-items-center justify-content-center flex-shrink-0 btn-square me-3" style="background-color:#A73535;">
                                    <i class='bx bxs-universal-access text-white fs-3 '></i>
                                </div>
                                <h5 class="mb-0">Walk-In Trainer</h5>
                            </div>
                            <span>Experience a personalized fitness journey by walking into our gym and availing the guidance and support of our experienced trainers</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="position-relative overflow-hidden pe-5 pt-5 h-100" style="min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="../images/img-7.jpg" alt="" style="object-fit: cover;">
                        <img class="position-absolute top-0 end-0 bg-white ps-3 pb-3" src="../images/rules2.jpg" alt="" style="width: 200px; height: 200px">
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Features End -->

</section>




<?php require_once '../includes/footer.php';?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>
</html>