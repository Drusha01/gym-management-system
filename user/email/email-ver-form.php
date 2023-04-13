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
      // validate if the email is taken
      $error = false;
      $userObj = new users();
      $user_email = $userObj->user_duplicateEmail();
      if(isset($_POST['email']) && validate_email($_POST)){
        $userObj = new users();
        $userObj->setuser_email($_POST['email']);
        $user_email = $userObj->user_duplicateEmail();

        // verify if email is taken

        // check first if we already sent and email in last 60 seconds
        // if so dont sent another one.
        $emailObj = new email();
        $email_data =$emailObj->get_last_sent_email($_SESSION['user_id']);

        if(!isset($user_email['user_id']) && !isset($email_data['seconds'])){
          $code = rand(100000,1000000);
          $mail = new PHPMailer;
          $mail->isSMTP();
          $mail->SMTPDebug = 0;
          $mail->Host = 'smtp.hostinger.com';
          $mail->Port = 587;
          $mail->SMTPAuth = true;
          $mail->Username = 'kenogymofficial@kenogym.online';
          $mail->Password = 'Uwat09hanz@2keno';
          $mail->setFrom('kenogymofficial@kenogym.online', 'KENO FITNESS CENTER');
          $mail->addReplyTo('kenogymofficial@kenogym.online', 'KENO FITNESS CENTER');
          $mail->addAddress($_POST['email'], $_SESSION['user_firstname'].' '.$_SESSION['user_lastname']);
          $mail->Subject = 'Email Verification';
          $mail->msgHTML('none');
          $mail->Body = 'Your email verification code is <strong>'.$code.'</strong><br> if this is not you, please contact us';
          //$mail->addAttachment('attachment.txt');
          if (!$mail->send()) {
              echo 'Mailer Error: ' . $mail->ErrorInfo;
          } else {
              // insert to db here
              
            if($emailObj->insert($_SESSION['user_id'],$_POST['email'],$code)){
                header('location:email-6-digit.php?email='.$_POST['email']);
            }
          }
        }else{
          if($user_email ){
            $error = 'Email taken';
          }else if($email_data){
            $error ='<p> resend in <span id="countdowntimer">10 </span> Seconds</p>';
          }
        }
      }else{
        $_POST['email'] = $_SESSION['user_email'];
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
  <script defer src="../../js/bootstrap.bundle.min.js"></script>
  <html itemscope itemtype="http://schema.org/Article">

<script src="https://apis.google.com/js/platform.js" async defer></script>


</head>
<body>
  <section class="container">
    <div class="row content d-flex justify-content-center align-items-center">
      <div class="col-md-5">
        <div class="box shadow bg-white rounded">
          <div class="container-fluid bg-danger p-2 rounded-top d-inline-flex justify-content-center">
            <img src="../../images/logo.png" alt="" width="60">
            <div class="d-flex flex-column p-2 pt-0 pb-0 ">
              <h3 class="mb-1 fs-5 text-white "><strong>KE-NO</strong></h3>
              <h6 class="mb-1 fs-10 text-white">Fitness Center</h6>
            </div>
          </div>
          <a class="text-decoration-none text-black m-0" aria-current="page" href="../user-profile.php"><span class='bx bxs-left-arrow align-middle fs-4'></span>Go Back</a>
          <div class="container px-4">
            <form action="" method="POST">
                <p class="fw-bold fs-5">E-mail Verification</p>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">E-mail address</label>
                    <input type="email" class="form-control" name="email"value="<?php if(isset($_POST['email'])){echo_safe($_POST['email']);} ?>" placeholder="<?php if(isset($_POST['email'])){echo_safe($_POST['email']);} ?>" aria-describedby="emailHelp">
                </div>
                
                  <?php 
                  if($error){
                    echo '
                <div class="bg-danger text-dark bg-opacity-10 border border-danger rounded-1">
                  <div class="py-2 ms-3">
                    '.$error.'
                  </div>
                </div>';
                  }
                  ?>
                  
               
                <div class="text-center mt-2">
                  <input type="submit" name="Confirm E-Mail" value="Confirm E-Mail" class="btn btn-dark">
                </div>
            </form>
            <br>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    
  </script>
</body>

</html>