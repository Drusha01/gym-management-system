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

<?php require_once 'header.php';?>
<body>
<?php require_once '../includes/top-nav-home.php';?>
<section style="margin-top: 4%;">
<!-- Page Header Start -->
<div class="container-fluid page-header py-6 my-6 mt-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="fw-bolder text-white display-4 mb-4">About</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-decoration-none text-white" href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none text-white" href="#">Pages</a></li>
                <li class="breadcrumb-item  active" aria-current="page" style="color:#A73535;">About</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
    <!-- about gym -->
    <div class="untree_co-section" style="background-color: #EBECF0" >
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="owl-single dots-absolute owl-carousel">
                        <img src="../images/home-0.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-3">
                        <img src="../images/home-1.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-3">
                        <img src="../images/home-2.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-3">
                        <img src="../images/home-3.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-3">
                    </div>
                </div>
                <div class="col-lg-5 ps-lg-5 ms-auto align-self-center">
                    <h2 class="text-center text-lg-start">About Our Gym</h2>
                    <div class="d-flex justify-content-center d-lg-flex justify-content-lg-start">
                        <div class="bg-dark w-75" style="padding: 1px;"></div>
                    </div>
                    <p class="mt-3 text-center text-lg-start">Our gym offers affordable prices, modern and easy-to-use equipment, and a welcoming atmosphere. 
                        With user-friendly facilities and knowledgeable staff, you'll have everything you need to reach your 
                        fitness goals. Whether you're just starting out or are a seasoned fitness enthusiast, our gym is 
                        the perfect choice for staying healthy.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end of about gym -->

    <!-- team -->
    <div class="testimonial-section">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
            <h2 class="section-title text-center">Team</h2>
            <div class="d-flex justify-content-center py-2 pb-3">
                <div class="bg-dark w-25" style="padding: 2px;"></div>
            </div>

            <div class="owl-single owl-carousel no-nav">
                <div class="mx-auto">
                    <div class="d-flex justify-content-center">
                        <img src="../images/person_1.jpg" alt="Image" class="img-fluid mb-4 rounded-3 w-50">
                    </div>
                    <div class="px-3">
                    <h3 class="mb-0">Ken Steven Lao</h3>
                    <p>Gym-Owner</p>
                    </div>
                </div>
                <div class="mx-auto">
                    <div class="d-flex justify-content-center">
                        <img src="../images/person_1.jpg" alt="Image" class="img-fluid mb-4 rounded-3 w-50">
                    </div>
                    <div class="px-3">
                    <h3 class="mb-0">Joviel Biya</h3>
                    <p>Gym Employee</p>
                    </div>
                </div>
            </div>

            </div>
        </div>
        </div>
    </div>
    <!-- end of team -->


    <!-- rules Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 d-lg-none">
                    <div class="position-relative overflow-hidden pe-5 pt-5 h-100" style="min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="../images/home-0.jpg" alt="" style="object-fit: cover;">
                        <img class="position-absolute top-0 end-0 bg-white ps-3 pb-3" src="../images/img-6.jpg" alt="" style="width: 200px; height: 200px">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp">
                    <h2 class="text-center text-lg-start">Rules</h2>
                    <div class="d-flex justify-content-center d-lg-flex justify-content-lg-start">
                        <div class="bg-dark w-50" style="padding: 1px;"></div>
                    </div>
                    <p class="mt-3 text-center text-lg-start">To ensure a safe and enjoyable experience for all members, we kindly ask that you follow our gym rules. These rules are designed to help you get the most out of your workout while also promoting a respectful and positive environment for everyone.</p>
                    <div class="row g-2 mb-4 pb-2">
                        <div class="col-sm-6 text-center text-lg-start">
                            <i class="bx bx-dumbbell fs-3 me-2 align-middle"></i> Return Weights After Use.
                        </div>
                        <div class="col-sm-6 text-center text-lg-start">
                            <i class="bx bx-dumbbell fs-3 me-2 align-middle"></i> No Shouting.
                        </div>
                        <div class="col-sm-6 text-center text-lg-start">
                            <i class="bx bx-dumbbell fs-3 me-2 align-middle"></i> Wipe Down Machines After use.
                        </div>
                        <div class="col-sm-6 text-center text-lg-start">
                            <i class="bx bx-dumbbell fs-3 me-2 align-middle"></i> No Sweat Towel, No Workout.
                        </div>
                        <div class="col-sm-6 text-center text-lg-start">
                            <i class="bx bx-dumbbell fs-3 me-2 align-middle"></i> Don't Drop The Weights.
                        </div>
                        <div class="col-sm-6 text-center text-lg-start">
                            <i class="bx bx-dumbbell fs-3 me-2 align-middle"></i>Suitable Workout Gear Must Be Worn Inside The Gym. No Jeans and Slippers. 
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-inline">
                    <div class="position-relative overflow-hidden pe-5 pt-5 h-100" style="min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="../images/rules.jpg" alt="" style="object-fit: cover;">
                        <img class="position-absolute top-0 end-0 bg-white ps-3 pb-3" src="../images/rules2.jpg" alt="" style="width: 200px; height: 200px">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->

    <!-- Location Start -->
    <div class="testimonial-section">
        <div class="container-xxl">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6 d-none d-lg-inline" style="min-height: 450px;">
                        <div class="position-relative h-100 shadow-lg">
                            <iframe class="position-relative w-100 h-100"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d934.6276124520334!2d122.06454040096312!3d6.9128737761047185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x325041e06e885201%3A0x6aa056dbaf277cb1!2sKENO%20FITNESS%20CENTER!5e0!3m2!1sen!2sph!4v1678763487368!5m2!1sen!2sph"
                                frameborder="0" style="min-height: 450px; border:0;" allowfullscreen="" aria-hidden="false"
                                tabindex="0"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6 align-self-center">
                        <h2 class="text-center text-lg-start">Location</h2>
                        <div class="d-flex justify-content-center d-lg-flex justify-content-lg-start">
                            <div class="bg-dark w-50" style="padding: 1px;"></div>
                        </div>
                        <p class="mt-3 text-center text-lg-start">Our gym is situated in San Jose, Zamboanga City,
                            offering convenient access to fitness enthusiasts in the area. Equipped with state-of-the-art facilities,
                            we provide a variety of exercise options to help you achieve your fitness goals. 
                            Whether you're looking to build muscle, lose weight, or improve your overall health and well-being,
                            our experienced trainers are ready to guide you every step of the way. Come and visit us today to kick-start your fitness journey!</p>
                    </div>
                    <div class="col-lg-6 d-lg-none" style="min-height: 450px;">
                        <div class="position-relative h-100">
                        <iframe class="position-relative w-100 h-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d934.6276124520334!2d122.06454040096312!3d6.9128737761047185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x325041e06e885201%3A0x6aa056dbaf277cb1!2sKENO%20FITNESS%20CENTER!5e0!3m2!1sen!2sph!4v1678763487368!5m2!1sen!2sph"
                            frameborder="0" style="min-height: 450px; border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Contact End -->


</section>


<?php require_once '../includes/footer.php';?>

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
