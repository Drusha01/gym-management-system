<?php
// start session
session_start();


if(isset($_SESSION['admin_id'])){
  header('location:admin/admin_control_log_in.php');
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
    <title>Keno Gym</title>
    <link rel="icon" type="images/x-icon" href="images/favicon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/boxicons.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/boxicons.min.css">

    <script defer src="js/bootstrap.bundle.min.js"></script>

    <script defer src="js/modalpop.js"></script>
</head>


<body>
<!-- Modal -->
<div class="modal fade" id="popAnnounce" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="position-absolute top-0 start-100 translate-middle">
        <button type="button" class="btn btn-dark btn-circle btn-sm fw-bolder" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
        
      <div class="modal-body">
            <div class=" w-100">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="owl-single dots-absolute owl-carousel">
                            <img src="images/home-0.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-3 w-100">
                            <img src="images/home-1.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-3 w-100">
                            <div class="card mh-50" style="width: 100%; min-height:100%;">
                              <div class="card-body">
                                <h5 class="card-title">No Gym Between these Dates</h5>
                                <hr>
                                <p class="card-text"><li>March 23, 2022</li></p>
                                <p class="card-text"><li>March 25, 2022</li></p>
                              </div>
                            </div>
                            <img src="images/home-3.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-3 w-100">
                        </div>
                    </div>
                </div>
            </div>
      </div>
    </div>
  </div>
</div>

  <section class="header">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #A73535">
            <div class="container-fluid">
                <div class="d-flex flex-row">
                    <a class="navbar-brand navbar" href="#">
                      <img src="images/logo.png" alt="" width="55">
                      <div class="d-flex flex-column p-2 pt-0 pb-0">
                        <h3 class="mb-1 fs-5 text-white"><strong>KE-NO</strong></h3>
                        <h6 class="mb-1 fs-10 text-white">Fitness Center</h6>
                      </div>
                    </a>
                  </div>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home/offers.php">Offers</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="user/user-avail.php">Avail</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home/about.php">About</a>
                  </li>
                </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="login/sign-up.php"><span class='bx bx-user-plus align-middle fs-4'></span> Sign-Up</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="login/log-in.php"><span class='bx bx-log-in align-middle fs-4'></span> Log-In</a>
                    </li>
                  </ul>
              </div>
            </div>
          </nav>
  </section>
     <section id="home">
      <div class="carousel slide" data-bs-ride="carousel" id="carouselExampleIndicators">
        <div class="carousel-indicators">
          <button aria-label="Slide 1" class="active" data-bs-slide-to="0" data-bs-target="#carouselExampleIndicators" type="button"></button> <button aria-label="Slide 2" data-bs-slide-to="1" data-bs-target="#carouselExampleIndicators" type="button"></button> <button aria-label="Slide 3" data-bs-slide-to="2" data-bs-target="#carouselExampleIndicators" type="button"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item carousel-image bg-img-1 active">
            <div class="carousel-caption">
              <h1 class="fw-bolder fst-italic text-white display-4" ><strong>QUALITY YET <br> AFFORDABLE GYM</strong></h1>
              <p><button class="btn btn-brand fs-6" data-bs-toggle="modal" data-bs-target="#popAnnounce">Learn More</button></p>
            </div>
          </div>
          <div class="carousel-item carousel-image bg-img-2">
            <div class="carousel-caption">
              <h1 class="fw-bolder fst-italic text-white display-4" ><strong>NUMEROUS <br> GYM EQUIPMENTS</strong></h1>
              <p><a class="btn btn-brand fs-6" href="#">Learn More</a></p>
            </div>
          </div>
          <div class="carousel-item carousel-image bg-img-3">

            <div class="carousel-caption">
              <h1 class="fw-bolder fst-italic text-white display-4" ><strong>A GOOD PLACE <br> TO WORKOUT</strong></h1>
              <p><a class="btn btn-brand fs-6" href="#">Learn More</a></p>
            </div>
          </div>
        </div><button class="carousel-control-prev" data-bs-slide="prev" data-bs-target="#carouselExampleIndicators" type="button"><span aria-hidden="true" class="carousel-control-prev-icon"></span> <span class="visually-hidden">Previous</span></button> <button class="carousel-control-next" data-bs-slide="next" data-bs-target="#carouselExampleIndicators" type="button"><span aria-hidden="true" class="carousel-control-next-icon"></span> <span class="visually-hidden">Next</span></button>
      </div>
     </section>


     <br> <br>
  <section id="services">
    <div class="container">
       <div class="row">
          <div class="col-12 section-intro">
             <h1>Our Services</h1>
             <div class="hline"></div>
          </div>
       </div>
       <div class="row">
          <div class="col-lg-4 col-sm-6 p-4">
             <div class="icon-box">
                <i class='bx bx-dumbbell'></i>
             </div>
             <h4 class="title-sm mt-4">Gym-Use</h4>
             <p>You can use all the equipment that are available in our Gym.</p>
          </div>
          <div class="col-lg-4 col-sm-6 p-4">
             <div class="icon-box">
              <i class='bx bx-universal-access'></i>
             </div>
             <h4 class="title-sm mt-4">Trainer</h4>
             <p>You can avail a trainer to help you in your workout.</p>
          </div>
          <div class="col-lg-4 col-sm-6 p-4">
             <div class="icon-box">
              <i class='bx bx-cabinet'></i>
             </div>
             <h4 class="title-sm mt-4">Locker</h4>
             <p>Once you availed for a Gym-Subscription. You can avail for a locker to keep your belongings.</p>
          </div>
          <div class="col-lg-4 col-sm-6 p-4">
             <div class="icon-box">
              <i class='bx bx-run'></i>
             </div>
             <h4 class="title-sm mt-4">Walk-In</h4>
             <p>Going for a quick workout or just beginning? You can avail for a Walk-In in our Gym.</p>
          </div>
          <div class="col-lg-4 col-sm-6 p-4">
             <div class="icon-box">
              <i class='bx bx-calendar-event'></i>
             </div>
             <h4 class="title-sm mt-4">Programs</h4>
             <p>You can avail for a program that are available in our gym. This offer is related to the events of the Gym. It may be Zumba or Cardio Sessions.</p>
          </div>
          <div class="col-lg-4 col-sm-6 p-4">
            <div class="icon-box">
              <i class='bx bx-cart-add'></i>
            </div>
            <h4 class="title-sm mt-4">Sell</h4>
            <p>Our Gym also sells Gym-Stuff Related.</p>
         </div>
       </div>
    </div>
  </section>

<section id="sell" class="pb-5 pt-3">
  <!-- weights room -->
        <div class="container">
          <div class="col-12 text-white section-intro pb-3">
            <h1>Weights Room</h1>
            <div class="hline"></div>
          </div>
            <div class="owl-carousel owl-3-slider owl-carousel2">
                <div class="item">
                    <a class="media-thumb" href="images/weight_room/orig_size/orig_size_1.jpg" data-fancybox="gallery">
                        <div class="media-text">
                            <h3 class="text-light">Dumbells</h3>
                        </div>
                        <img src="images/weight_room/orig_size/orig_size_1.jpg" alt="Image" class="img-fluid center-cropped">
                    </a> 
                </div>
                <div class="item">
                    <a class="media-thumb" href="images/weight_room/orig_size/orig_size_2.jpg" data-fancybox="gallery">
                        <div class="media-text">
                            <h3 class="text-light">Machines</h3>
                        </div>
                        <img src="images/weight_room/orig_size/orig_size_2.jpg" alt="Image" class="img-fluid center-cropped">
                    </a> 
                </div>
                <div class="item">
                    <a class="media-thumb" href="images/weight_room/orig_size/orig_size_3.jpg" data-fancybox="gallery">
                        <div class="media-text">
                            <h3 class="text-light">Warm-Up Area</h3>
                        </div>
                        <img src="images/weight_room/orig_size/orig_size_3.jpg" alt="Image" class="img-fluid center-cropped">
                    </a>
                </div>
                <div class="item">
                    <a class="media-thumb" href="images/weight_room/orig_size/orig_size_4.jpg" data-fancybox="gallery">
                        <div class="media-text">
                            <h3 class="text-light">Warm-Up Area</h3>
                        </div>
                        <img src="images/weight_room/orig_size/orig_size_4.jpg" alt="Image" class="img-fluid center-cropped">
                    </a>
                </div>
            </div>
        </div>
  <!-- end of weights room -->
        <br>
        <br>
  <!-- start of func room -->
        <div class="container mt-4">
            <div class="col-12 text-white section-intro pb-3">
              <h1>Function Room</h1>
              <div class="hline"></div>
            </div>
            <div class="owl-carousel owl-3-slider owl-carousel2">
                <div class="item">
                    <a class="media-thumb" href="images/function_room/orig_size/1.jpg" data-fancybox="gallery">
                        <div class="media-text">
                            <h3 class="text-light">Front View</h3>
                        </div>
                        <img src="images/function_room/orig_size/1.jpg" alt="Image" class="img-fluid center-cropped">
                    </a>
                </div>
                <div class="item">
                    <a class="media-thumb" href="images/function_room/orig_size/2.jpg" data-fancybox="gallery">
                        <div class="media-text">
                            <h3 class="text-light">Boxing Area</h3>
                        </div>
                        <img src="images/function_room/orig_size/2.jpg" alt="Image" class="img-fluid center-cropped">
                    </a>
                </div>
                <div class="item">
                    <a class="media-thumb" href="images/function_room/orig_size/3.jpg" data-fancybox="gallery">
                        <div class="media-text">
                            <h3 class="text-light">Threadmill</h3>
                        </div>
                        <img src="images/function_room/orig_size/3.jpg" alt="Image" class="img-fluid center-cropped">
                    </a>
                </div>
                <div class="item">
                    <a class="media-thumb" href="images/function_room/orig_size/4.jpg" data-fancybox="gallery">
                        <div class="media-text">
                            <h3 class="text-light">Bike Area</h3>
                        </div>
                        <img src="images/function_room/orig_size/4.jpg" alt="Image" class="img-fluid center-cropped">
                    </a>
                </div>
            </div>
        </div>
      <!-- end of func room -->
        <br>
        <br>
</section>

<footer>
    <div class="footer-top">
        <div class="container">
        <div class="row gy-5">
            <div class="col-md-4">
            <div class="d-flex flex-row">
                <a class="navbar-brand navbar">
                <img src="images/logo.png" alt="" width="55">
                <div class="d-flex flex-column p-2 pt-0 pb-0">
                    <h3 class="mb-1 fs-5 text-white"><strong>KE-NO</strong></h3>
                    <h6 class="mb-1 fs-10 text-white">Fitness Center</h6>
                </div>
                </a>
            </div>

                <div class="social-icons">
                    <a href="#"><i class="bx bxl-facebook"></i></a>
                    <a href="#"><i class="bx bxl-twitter"></i></a>
                    <a href="#"><i class="bx bxl-instagram"></i></a>
                </div>
            </div>
            <div class="col-md-2">
                <h5 class="title-sm">Navigation</h5>
                <div class="footer-links">
                    <a href="#services">Services</a>
                    <a href="#">Our Gym</a>
                    <a href="#">Team</a>
                    <a href="#">Location</a>
                </div>
            </div>
            <div class="col-md-2">
                <h5 class="title-sm">More</h5>
                <div class="footer-links">
                    <a href="#">Gym Images</a>
                    <a href="#">Rules</a>
                </div>
            </div>
            <div class="col-md-2">
                <h5 class="title-sm">Contact</h5>
                <div class="footer-links">
                  <?php 
                    require_once('classes/admin_settings.class.php');
                    $settingObj = new admin_settings();
                    $setting_data = $settingObj->fetch_one();
                  ?>
                  <p class="mb text-white"><?php if($setting_data){echo htmlentities($setting_data['setting_gym_address']);}?></p>
                  <p class="mb text-white"><?php if($setting_data){echo htmlentities($setting_data['setting_gym_contact_number']);}?></p>
                  <p class="mb text-white"><?php if($setting_data){echo htmlentities($setting_data['setting_gym_email_address']);}?></p>
                </div>
            </div>
        </div>
        </div>
    </div>
</footer>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/moment.min.js"></script>
  <script src="js/daterangepicker.js"></script>
  <script src="js/custom.js"></script>
  
  <script>
  $( '.owl-carousel2' ).owlCarousel({

  loop: false,
  rewind: true,
  margin: 10,
  dots: true,
  navText: [ '<span class="fa fa-chevron-left"></span>', '<span class="fa fa-chevron-right"></span>' ],
  responsive:{

    0: {
        items: 1,
        nav: false
    },

    1000: {
        items: 3,
        nav: true
    }
  }
  })
  </script>
</body>
</html>
