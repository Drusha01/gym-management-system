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

<?php require_once '../includes/header-user.php'; ?>
<body>

  <?php require_once '../includes/header.php';?>
  <!-- Modal -->

        <?php   
            require_once('../classes/annoucements.class.php');
            $annoucementObj = new annoucements();
            $number_of_announcement = $annoucementObj->get_number_of_annoucements()['number_of_announcements'];

            // fetch all announcements ordering by announcement order
            if($annoucement_data = $annoucementObj->fetch_all_active()){
                $counter=1;
                $index =0;
          echo '
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
                      <div class="owl-single dots-absolute owl-carousel">';
                foreach ($annoucement_data as $key => $annoucement_item) {
                  if( $annoucement_item['announcement_status_details'] == 'Active'){
                    if($annoucement_item['announcement_type_details'] ==  'Image' ){
                      echo '<img src="../img/announcement/announcement-resized/'.htmlentities($annoucement_item['announcement_file_image']).'" alt="Free HTML Template by Untree.co" class="img-fluid rounded-3 w-100">';
                    }else{
                      echo '
                    <div class="card mh-50" style="width: 100%; min-height:100%;">
                      <div class="card-body">
                        <h5 class="card-title">'.htmlentities($annoucement_item['announcement_title']).'</h5>
                        <hr>
                        <p class="card-text"><li>'.date_format(date_create($annoucement_item['announcement_start_date']), "F d, Y").'</li></p>
                        <p class="card-text"><li>'.date_format(date_create($annoucement_item['announcement_end_date']), "F d, Y").'</li></p>
                      </div>
                    </div>';
                    }
                }
        $index++;
        $counter++;
                }
              echo' </div>
                 </div>
             </div>
         </div>     
     </div>
   </div>
  </div>
</div>
 ';
            }
            
            ?>
                        
  

  <section id="home">
  <div class="carousel slide" data-bs-ride="carousel" id="carouselExampleIndicators">
    <div class="carousel-indicators">
      
      <button aria-label="Slide 1" class="active" data-bs-slide-to="0" data-bs-target="#carouselExampleIndicators" type="button"></button> 
      <!-- <button aria-label="Slide 2" data-bs-slide-to="1" data-bs-target="#carouselExampleIndicators" type="button"></button> 
      <button aria-label="Slide 3" data-bs-slide-to="2" data-bs-target="#carouselExampleIndicators" type="button"></button> -->
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
    </div>
    <button class="carousel-control-prev" data-bs-slide="prev" data-bs-target="#carouselExampleIndicators" type="button"><span aria-hidden="true" class="carousel-control-prev-icon"></span> <span class="visually-hidden">Previous</span></button> <button class="carousel-control-next" data-bs-slide="next" data-bs-target="#carouselExampleIndicators" type="button"><span aria-hidden="true" class="carousel-control-next-icon"></span> <span class="visually-hidden">Next</span></button>
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
              <?php 
                require_once('../classes/landing_page.class.php');
                $landing_pageObj = new landing_page();

                if($Weights_room_data = $landing_pageObj->fetch_all_by_type('Weights Room')){
                  $counter =1;
                    foreach ($Weights_room_data as $key => $value) {
                      if($counter ==1){
                        echo '
                        <div class="item">
                      <a class="media-thumb" href="../img/Weights/Weights-resized/'.htmlentities($value['landing_page_file']).'" data-fancybox="gallery">
                          <div class="media-text">
                              <h3 class="text-light">'.htmlentities($value['landing_page_title']).'</h3>
                          </div>
                          <img src="../img/Weights/Weights-resized/'.htmlentities($value['landing_page_file']).'" alt="Image" class="img-fluid center-cropped">
                      </a> 
                    </div>';
                      }else{
                        echo '
                        <div class="item">
                            <a class="media-thumb" href="../img/Weights/Weights-resized/'.htmlentities($value['landing_page_file']).'" data-fancybox="gallery">
                                <div class="media-text">
                                    <h3 class="text-light">'.htmlentities($value['landing_page_title']).'</h3>
                                </div>
                                <img src="../img/Weights/Weights-resized/'.htmlentities($value['landing_page_file']).'" alt="Image" class="img-fluid center-cropped">
                            </a>
                        </div>';
                      }
                      $counter++;
                    }
                  }else{
                    // default
                    echo '
                    <div class="item">
                      <a class="media-thumb" href="images/weight_room/orig_size/orig_size_1.jpg" data-fancybox="gallery">
                          <div class="media-text">
                              <h3 class="text-light">Dumbells</h3>
                          </div>
                          <img src="../images/weight_room/orig_size/orig_size_1.jpg" alt="Image" class="img-fluid center-cropped">
                      </a> 
                    </div>
                    <div class="item">
                        <a class="media-thumb" href="images/weight_room/orig_size/orig_size_2.jpg" data-fancybox="gallery">
                            <div class="media-text">
                                <h3 class="text-light">Machines</h3>
                            </div>
                            <img src="../images/weight_room/orig_size/orig_size_2.jpg" alt="Image" class="img-fluid center-cropped">
                        </a> 
                    </div>
                    <div class="item">
                        <a class="media-thumb" href="images/weight_room/orig_size/orig_size_3.jpg" data-fancybox="gallery">
                            <div class="media-text">
                                <h3 class="text-light">Warm-Up Area</h3>
                            </div>
                            <img src="../images/weight_room/orig_size/orig_size_3.jpg" alt="Image" class="img-fluid center-cropped">
                        </a>
                    </div>
                    <div class="item">
                        <a class="media-thumb" href="images/weight_room/orig_size/orig_size_4.jpg" data-fancybox="gallery">
                            <div class="media-text">
                                <h3 class="text-light">Warm-Up Area</h3>
                            </div>
                            <img src="../images/weight_room/orig_size/orig_size_4.jpg" alt="Image" class="img-fluid center-cropped">
                        </a>
                    </div>';
                  }
                ?>
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
              <?php 
               require_once('../classes/landing_page.class.php');
               $landing_pageObj = new landing_page();

               if($Function_room_data = $landing_pageObj->fetch_all_by_type('Function Room')){
                $counter =1;
                  foreach ($Function_room_data as $key => $value) {
                    if($counter ==1){
                      echo '
                      <div class="item">
                          <a class="media-thumb" href="../img/Function/Function-resized/'.htmlentities($value['landing_page_file']).'" data-fancybox="gallery">
                              <div class="media-text">
                                  <h3 class="text-light">'.htmlentities($value['landing_page_title']).'</h3>
                              </div>
                              <img src="../img/Function/Function-resized/'.htmlentities($value['landing_page_file']).'" alt="Image" class="img-fluid center-cropped">
                          </a>
                      </div>';
                    }else{
                      echo '
                      <div class="item">
                          <a class="media-thumb" href="../img/Function/Function-resized/'.htmlentities($value['landing_page_file']).'" data-fancybox="gallery">
                              <div class="media-text">
                                  <h3 class="text-light">'.htmlentities($value['landing_page_title']).'</h3>
                              </div>
                              <img src="../img/Function/Function-resized/'.htmlentities($value['landing_page_file']).'" alt="Image" class="img-fluid center-cropped">
                          </a>
                      </div>';
                    }
                    $counter++;
                  }
                }else{
                  // default
                  echo '
                  <div class="item">
                      <a class="media-thumb" href="images/function_room/orig_size/1.jpg" data-fancybox="gallery">
                          <div class="media-text">
                              <h3 class="text-light">Front View</h3>
                          </div>
                          <img src="../images/function_room/orig_size/1.jpg" alt="Image" class="img-fluid center-cropped">
                      </a>
                  </div>
                  <div class="item">
                      <a class="media-thumb" href="images/function_room/orig_size/2.jpg" data-fancybox="gallery">
                          <div class="media-text">
                              <h3 class="text-light">Boxing Area</h3>
                          </div>
                          <img src="../images/function_room/orig_size/2.jpg" alt="Image" class="img-fluid center-cropped">
                      </a>
                  </div>
                  <div class="item">
                      <a class="media-thumb" href="images/function_room/orig_size/3.jpg" data-fancybox="gallery">
                          <div class="media-text">
                              <h3 class="text-light">Threadmill</h3>
                          </div>
                          <img src="../images/function_room/orig_size/3.jpg" alt="Image" class="img-fluid center-cropped">
                      </a>
                  </div>
                  <div class="item">
                      <a class="media-thumb" href="images/function_room/orig_size/4.jpg" data-fancybox="gallery">
                          <div class="media-text">
                              <h3 class="text-light">Bike Area</h3>
                          </div>
                          <img src="../images/function_room/orig_size/4.jpg" alt="Image" class="img-fluid center-cropped">
                      </a>
                  </div>';
                }
              ?>
                
            </div>
        </div>
      <!-- end of func room -->
        <br>
        <br>
</section>


<?php require_once '../includes/footer.php';?>
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/owl.carousel.min.js"></script>
<script src="../js/aos.js"></script>
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