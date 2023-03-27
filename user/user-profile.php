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

<?php require_once '../includes/header-user.php';?>
<body>
  <?php require_once '../includes/header.php';?>
    <section class="my_acc">
        <div class="mt-6 custom-nav">
          <div class="container-fluid pb-2">
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
                  <button class="nav-link" id="lockers-tab" data-bs-toggle="tab" data-bs-target="#lockers" type="button" role="tab" aria-controls="contact" aria-selected="false" ">My Lockers</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="trainer-tab" data-bs-toggle="tab" data-bs-target="#trainer" type="button" role="tab" aria-controls="contact" aria-selected="false"  onclick="changeActiveTab('trainer-tab')">My Trainers</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button" role="tab" aria-controls="contact" aria-selected="false"  onclick="changeActiveTab('payment-tab')">Payment</button>
                  </li>
              </ul>
          </div>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                  <?php require_once 'user-acc.php'; ?>
                </div>
                <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab" onclick="changeActiveTab('notification')">
                      <?php require_once 'user-notif.php'; ?>
                </div>
                <div class="tab-pane fade" id="Subscription" role="tabpanel" aria-labelledby="Subscription-tab" onclick="changeActiveTab('Subscription')">
                    <div class="container-fluid p-3 " style="min-height: 450px;">
                        <?php require_once 'user_subscriptions.php'; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="lockers" role="tabpanel" aria-labelledby="lockers-tab">
                    <div class="container-fluid p-3 " style="min-height: 450px;">
                      <?php require_once 'user-locker.php'; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="trainer" role="tabpanel" aria-labelledby="trainer-tab" onclick="changeActiveTab('trainer')">
                    <div class="container-fluid p-3" style="min-height: 450px;">
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
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
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