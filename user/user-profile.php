<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';

if(isset($_SESSION['admin_id'])){
  header('location:../admin/admin_control_log_in2.php');
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
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="magnific-popup/jquery.magnific-popup.js"></script>

</head>
<body>
  <?php require_once '../includes/header.php';?>
    <section class="my_acc">
        <div class="container-fluid mt-6 custom-nav">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab" aria-controls="account" aria-selected="true">My Account</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="notification-tab" data-bs-toggle="tab" data-bs-target="#notification" type="button" role="tab" aria-controls="notification" aria-selected="false">Notifications</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="Subscription-tab" data-bs-toggle="tab" data-bs-target="#Subscription" type="button" role="tab" aria-controls="contact" aria-selected="false">My Subscriptions</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="trainer-tab" data-bs-toggle="tab" data-bs-target="#trainer" type="button" role="tab" aria-controls="contact" aria-selected="false">My Trainers</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button" role="tab" aria-controls="contact" aria-selected="false">Payment</button>
                  </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <div class="container-fluid p-3">
                        <div class="row gutters-sm">
                            <div class="col-md-4 mb-3">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex flex-column align-items-center text-center">
                                    <a href="../img/profile/<?php echo_safe($_SESSION['user_profile_picture'])?>"><img src="../img/profile-resize/<?php echo_safe($_SESSION['user_profile_picture'])?>" alt="Admin" class="rounded-circle" width="150"></a>
                                    <div class="mt-3">
                                      <h4><?php if(isset($_SESSION['user_name'])){
                                        echo_safe($_SESSION['user_name']);}else {echo 'username not set';}?></h4>
                                      <p class="text-dark fw-bold mb-1">Status: <span class="text-secondary fw-normal">Subscribed</span></p>
                                      <p class="text-muted font-size-sm">San Jose, Zamboanga City</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card mt-3">
                                <div class="py-1 px-3">
                                    <h5 class="fw-bold">Status of Subscription</h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Gym-Use</h6>
                                    <span class="text-secondary">Subscribed</span>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Trainer</h6>
                                    <span class="text-secondary">Subscribed</span>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Locker</h6>
                                    <span class="text-secondary">Subscribed</span>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Programs</h6>
                                    <span class="text-secondary">Not Availed</span>
                                  </li>
                                  <li class="list-group-item d-flex flex-row-reverse flex-wrap">
                                        <a class="btn btn-success float-right " href="#">More Details</a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="col-lg-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo_safe($_SESSION['user_lastname']. ', '.$_SESSION['user_firstname'].' '.$_SESSION['user_middlename']) ?>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col-lg-3">
                                                <h6 class="mb-0">Gender</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo_safe($_SESSION['user_gender_details']) ?>
                                            </div>
                                        </div>
                                    </div>
                                     <hr>
                                    <div class="row">
                                        <div class="col">
                                            <div class="col-lg-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php if (strlen($_SESSION['user_address']) > 0) {
                                                  echo_safe($_SESSION['user_address']);
                                                  
                                                } else {
                                                  echo 'No address';
                                                } ?>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col-lg-3">
                                                <h6 class="mb-0">Phone Number</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                              <?php echo_safe($_SESSION['user_phone_number']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <div class="col-lg-3">
                                                <h6 class="mb-0">Age</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                              <?php echo_safe(getAge($_SESSION['user_birthdate'])) ?>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="col">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-9 text-secondary">
                                              <?php echo_safe($_SESSION['user_email']); if(isset($_SESSION['user_email_verified'])){echo '<a class="btn btn-success float-right" id="view-valid-id">Verified ✓</a>';}else{echo('<a href="user-change-email-address.php" class="btn btn-success float-right" id="view-valid-id">Verify your email </a>');} ?>
                                              
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <div class="col-lg-3">
                                                <h6 class="mb-0">Birth Date</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                              <?php echo_safe(date_format(date_create($_SESSION['user_birthdate']), "F d,Y"));?>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col">
                                                <h6 class="mb-0">Account Created</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">

                                                <?php echo_safe(date_format(date_create($_SESSION['user_date_created']), "F d,Y"));?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row px-3 ">
                                      <div class="col">
                                      <li class="list-group-item d-flex  flex-wrap">
                                              <a class="btn btn-success float-right" id="view-valid-id" href="<?php echo_safe('../img/valid-id/'.$_SESSION['user_valid_id_photo'])?>">View Valid ID</a>
                                        </li>
                                        
                                      </div>
                                      <div class="col">
                                        <li class="list-group-item d-flex flex-row-reverse flex-wrap">
                                              <a class="btn btn-primary float-right " href="user-edit.php">MODIFY</a>
                                        </li>

                                      </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            </div>
                        </div>
                    </div>
                  <?php //require_once 'user-acc.php'; ?>
                </div>
                <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                      <?php require_once 'user-notif.php'; ?>
                </div>
                <div class="tab-pane fade" id="Subscription" role="tabpanel" aria-labelledby="Subscription-tab">
                    <div class="container-fluid p-3 my_subscription">
                        <?php require_once 'user_subscriptions.php'; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="trainer" role="tabpanel" aria-labelledby="trainer-tab">
                    <div class="container-fluid p-3 my-trainer">
                      <?php require_once 'user-trainer.php'; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                    <div class="container-fluid p-3">
                      <?php require_once 'user-payment.php'; ?>
                    </div>
                </div>
              </div>
            </div>
    </section>

    

</body>
</html>




    <?php require_once '../includes/footer.php';?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
     crossorigin="anonymous"></script>
</body>
</html>


<script>

// $(document).ready(function() {
//   $('.btn btn-success float-right').magnificPopup({type:'image'});
// });

$(document).ready(function() {
  $('#view-valid-id').magnificPopup({type:'image'});
});
</script>