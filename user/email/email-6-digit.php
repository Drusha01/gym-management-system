<?php
// start session
session_start();


// includes
require_once '../../tools/functions.php';
require_once '../../classes/users.class.php';
require_once '../../classes/email.class.php';
require '../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;


if(isset($_SESSION['admin_id'])){
  header('location:../../admin/admin_control_log_in.php');
}
// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if($_SESSION['user_status_details'] =='active'){
    // check what type of user are we
    if($_SESSION['user_type_details'] =='admin'){
      // go to admin
    }else if($_SESSION['user_type_details'] == 'normal'){
      if(isset($_POST['code'])  ){
        $emailObj = new email();
        $email_data = $emailObj->verify($_SESSION['user_id']);
        if($email_data && $_SESSION['user_id'] == $email_data['email_verify_user_id'] && $_POST['code'] == $email_data['email_verify_code'] ){
          // update user email and user validated email
          $userObj = new users();
          if($userObj->update_email($email_data['email_verify_user_id'],$email_data['email_verify_email'])){
            
           // update session
            $_SESSION['user_email'] = $email_data['email_verify_email'];
            $_SESSION['user_email_verified'] = 1;

            require_once '../../classes/notifications.class.php';
            $notificationObj = new notifications();
                
            $notification_info ='Congratulations! Your Account is now verified. ';
            if(!$notificationObj->insert($_SESSION['admin_user_id'],$_GET['trainer_add_with_id'],'Account','verified.png', $notification_info)){
                exit('notification insert error');
            }

            header('location:../user-profile.php');
          }
        }else{
          echo 'not nice';
        }
      }
     
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
  <meta name="google-signin-client_id" content="53523092857-46kpu1ffikh67k7kckngcbm6k7naf8ic.apps.googleusercontent.com">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keno Gym | Log-In</title>
  <link rel="icon" type="images/x-icon" href="../../images/favicon.png">
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/log-in.css">
  <link rel="stylesheet" href="../../css/boxicons.min.css">
  <script defer src="../js/bootstrap.bundle.min.js"></script>

  <html itemscope itemtype="http://schema.org/Article">

<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>
<body>
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
            <img src="../../images/logo.png" class="rounded me-2" alt="logo" style="width: 25px;">
            <strong class="me-auto">KE-NO Fitness Center</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
            Succesfully sent to E-mail.✅
            </div>
        </div>
    </div>
  <section class="container">
    <div class="row content d-flex justify-content-center align-items-center">
      <div class="col-md-5">
        <div class="box shadow bg-white rounded">
          <div class="container-fluid bg-danger p-2 rounded-top d-inline-flex justify-content-center">
            <img src="../images/logo.png" alt="" width="60">
            <div class="d-flex flex-column p-2 pt-0 pb-0 ">
              <h3 class="mb-1 fs-5 text-white "><strong>KE-NO</strong></h3>
              <h6 class="mb-1 fs-10 text-white">Fitness Center</h6>
            </div>
          </div>
          <a class="text-decoration-none text-black m-0" aria-current="page" href="../user-profile.php"><span class='bx bxs-left-arrow align-middle fs-4'></span>Go Back</a>
          <div class="container px-4">
            <div class="text-center">
              <p class="fw-bold fs-4">Email Has Been Sent To</p>
              <p class="fw-light fs-5"><?php if(isset($_GET['email'])){echo $_GET['email'];}?></p>
            </div>
            <section class="wrapper">
              <label for="digit">Type your 6 Digit Security Code</label>
              <form action="" method="POST">
                <input type="number" class="form-control" name="code" max="1000000" aria-describedby="emailHelp">
                <div class="text-center mt-2">
                  <input type="submit" name="Confirm E-Mail" value="Confirm E-Mail" class="btn btn-dark">
                </div>
              </form>
            </section>
            <div class="row mt-4">
            <p id="content" style="color:red;"> Verfiy email in <span id="countdowntimer">60 </span> Seconds</p>
                <div class="col-lg-6 text-center text-lg-start">
                    Didn't Get the Code?<a href="#" id="resend"class="ms-2">Resend?</a>
                </div>
                <div class="col-lg-6 text-center text-lg-end mt-2 mt-lg-0">
                    <a href="email-ver-form.php">Change Email</a>
                </div>
            </div>
            <input type="email" class="form-control" name="email" id="email"value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>" aria-describedby="emailHelp" style="visibility:hidden;">
            <br> <br>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    // Listen to paste on the document
document.addEventListener("paste", function(e) {
  // if the target is a text input
  if (e.target.type === "text") {
   var data = e.clipboardData.getData('Text');
   // split clipboard text into single characters
   data = data.split('');
   // find all other text inputs
   [].forEach.call(document.querySelectorAll("input[type=text]"), (node, index) => {
      // And set input value to the relative character
      node.value = data[index];
    });
  }
});
var timeleft = 60;
var downloadTimer = setInterval(function(){
timeleft--;
document.getElementById("countdowntimer").textContent = timeleft;
if(timeleft <= 0){
  clearInterval(downloadTimer);
    $('#content').html('Email verification expired');
}
    
},1000);


$('#resend').click(function (){
  console.log($('#email').val());
});
  </script>
</body>

</html>