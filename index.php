<?php
// start session
session_start();

// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if($_SESSION['user_status_details'] =='active'){
    // check what type of user are we
    if($_SESSION['user_type_details'] =='admin'){
      // go to admin
      header('location:../admin/admin-profile.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/boxicons.min.css">

</head>
<body>
    <section class="header">
            <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #A73535">
                <div class="container-fluid">
                    <div class="d-flex flex-row">
                        <a class="navbar-brand navbar">
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
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Subscriptions
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Gym-Use</a></li>
                          <li><a class="dropdown-item" href="#">Trainer</a></li>
                          <li><a class="dropdown-item" href="#">Locker</a></li>
                          <li><a class="dropdown-item" href="#">Programs</a></li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Avail</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          About
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Gym</a></li>
                          <li><a class="dropdown-item" href="#">Policies</a></li>
                          <li><a class="dropdown-item" href="#">Owner</a></li>
                          <li><a class="dropdown-item" href="#">Employee</a></li>
                          <li><a class="dropdown-item" href="#">Items</a></li>
                        </ul>
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
              <p><a class="btn btn-brand fs-6" href="#">Learn More</a></p>
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
             <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem incidunt sunt molestiae!</p>
          </div>
          <div class="col-lg-4 col-sm-6 p-4">
             <div class="icon-box">
              <i class='bx bx-universal-access'></i>
             </div>
             <h4 class="title-sm mt-4">Trainer</h4>
             <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem incidunt sunt molestiae!</p>
          </div>
          <div class="col-lg-4 col-sm-6 p-4">
             <div class="icon-box">
              <i class='bx bx-cabinet'></i>
             </div>
             <h4 class="title-sm mt-4">Locker</h4>
             <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem incidunt sunt molestiae!</p>
          </div>
          <div class="col-lg-4 col-sm-6 p-4">
             <div class="icon-box">
              <i class='bx bx-run'></i>
             </div>
             <h4 class="title-sm mt-4">Walk-In</h4>
             <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem incidunt sunt molestiae!</p>
          </div>
          <div class="col-lg-4 col-sm-6 p-4">
             <div class="icon-box">
              <i class='bx bx-calendar-event'></i>
             </div>
             <h4 class="title-sm mt-4">Programs</h4>
             <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem incidunt sunt molestiae!</p>
          </div>
       </div>
    </div>
 </section>

<section id="sell">
  <div class="col-12 section-intro text-white">
    <h1>What We Sell</h1>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem incidunt sunt molestiae!</p>
    <div class="hline"></div>
 </div>
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card">
          <img src="images/pexels-samer-daboul-1212845 (1).jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <div class="col-12 ">
              <h1 class="text-center">Supplements</h1>
              <div class="about-border"></div>
           </div>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-4">
        <div class="card">
          <img src="images/pexels-kai-pilger-996329 (1).jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <div class="col-12 ">
              <h1 class="text-center">Clothing</h1>
              <div class="about-border"></div>
           </div>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-4">
        <div class="card">
          <img src="images/pexels-steve-johnson-1000084 (1).jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <div class="col-12 ">
              <h1 class="text-center">Refreshments</h1>
              <div class="about-border"></div>
           </div>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>
      </div>
      
    </div>
    
  </div>
</section>
    <br>

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
                     <a href="#"><i class="bx bxl-github"></i></a>
                  </div>
               </div>
               <div class="col-md-2">
                  <h5 class="title-sm">Navigation</h5>
                  <div class="footer-links">
                     <a href="#">Services</a>
                     <a href="#">Our Work</a>
                     <a href="#">Team</a>
                     <a href="#">Blog</a>
                  </div>
               </div>
               <div class="col-md-2">
                  <h5 class="title-sm">More</h5>
                  <div class="footer-links">
                     <a href="#">FAQ's</a>
                     <a href="#">Privacy & Policy</a>
                     <a href="#">Liscences</a>
                  </div>
               </div>
               <div class="col-md-2">
                  <h5 class="title-sm">Contact</h5>
                  <div class="footer-links">
                     <p class="mb text-white">San Jose, Zamboanga City</p>
                     <p class="mb text-white">8(800)316-06-42</p>
                     <p class="mb text-white">hello@yourdomain.com</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
     crossorigin="anonymous"></script>
</body>
</html>