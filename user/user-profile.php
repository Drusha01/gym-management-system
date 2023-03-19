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
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="magnific-popup/jquery.magnific-popup.js"></script>

</head>
<body>
  <?php require_once '../includes/header.php';?>
    <section class="my_acc">
        <div class="container-fluid mt-6 custom-nav">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab" aria-controls="account" aria-selected="true"  onclick="changeActiveTab('account-tab')">My Account</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="notification-tab" data-bs-toggle="tab" data-bs-target="#notification" type="button" role="tab" aria-controls="notification" aria-selected="false"  onclick="changeActiveTab('notification-tab')">Notifications</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="Subscription-tab" data-bs-toggle="tab" data-bs-target="#Subscription" type="button" role="tab" aria-controls="contact" aria-selected="false"  onclick="changeActiveTab('Subscription-tab')">My Subscriptions</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="trainer-tab" data-bs-toggle="tab" data-bs-target="#trainer" type="button" role="tab" aria-controls="contact" aria-selected="false"  onclick="changeActiveTab('trainer-tab')">My Trainers</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button" role="tab" aria-controls="contact" aria-selected="false"  onclick="changeActiveTab('payment-tab')">Payment</button>
                  </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                  <?php require_once 'user-acc.php'; ?>
                </div>
                <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab" onclick="changeActiveTab('notification')">
                      <?php require_once 'user-notif.php'; ?>
                </div>
                <div class="tab-pane fade" id="Subscription" role="tabpanel" aria-labelledby="Subscription-tab" onclick="changeActiveTab('Subscription')">
                    <div class="container-fluid p-3 ">
                        <?php require_once 'user_subscriptions.php'; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="trainer" role="tabpanel" aria-labelledby="trainer-tab" onclick="changeActiveTab('trainer')">
                    <div class="container-fluid p-3">
                      <?php require_once 'user-trainer.php'; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab" onclick="changeActiveTab('payment')">
                    <div class="container-fluid p-3">
                      <?php require_once 'user-payment.php'; ?>
                    </div>
                </div>
              </div>
            </div>
    </section>

    
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img class="img-fluid" src="<?php echo_safe('../img/valid-id/'.$_SESSION['user_valid_id_photo'])?>">

      </div>
    </div>
  </div>
</div>
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

// $(document).ready(function() {
//   $('#view-valid-id').magnificPopup({type:'image'});
// });

function changeActiveTab(tab){
  console.log(tab);
  var myParam = location.search.split('active=')[1];
  console.log(myParam);
}

window.onload = (event) =>{
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const active = urlParams.get('active')
  console.log(active);
  if(active != null){
    $('#'+active).trigger('click');
  }

};

</script>