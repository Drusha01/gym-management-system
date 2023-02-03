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
      header('location:../admin/admin-profile.php');
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
    <link rel="icon" type="images/x-icon" href="../images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/boxicons.min.css">

</head>
<body>

  <?php require_once '../includes/header.php';?>

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
          <img src="../images/pexels-samer-daboul-1212845 (1).jpg" class="card-img-top" alt="...">
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
          <img src="../images/pexels-kai-pilger-996329 (1).jpg" class="card-img-top" alt="...">
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
          <img src="../images/pexels-steve-johnson-1000084 (1).jpg" class="card-img-top" alt="...">
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

    <?php require_once '../includes/footer.php';?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
     crossorigin="anonymous"></script>
</body>
</html>