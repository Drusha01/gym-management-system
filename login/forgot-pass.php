<?php
// start session
session_start();
require '../vendor/autoload.php';
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
      header('location:../user/user-page.php');
    } 
  }else if($_SESSION['user_status_details'] =='inactive'){
    // handle inactive user details
  }else if($_SESSION['user_status_details'] =='deleted'){
    // handle deleted user details
  }
} else {
   // includes
    require_once '../tools/functions.php';
    require_once '../classes/users.class.php';
    require_once '../classes/forgot_password.class.php';
   
    
    $error = false;
    $userObj = new users();
    $forgot_passwordObj = new forgot_password();
    $user_email = $userObj->user_duplicateEmail();
    if(isset($_POST['email']) && validate_email($_POST)){
        $userObj->setuser_email($_POST['email']);
        if($user_email = $userObj->user_duplicateEmail()){
            // check if we sent an email already
            $userObj->setuser_id($user_email['user_id']);
            $user_details = $userObj->get_user_details();
           // print_r($user_details);
            if($forgot_password_data = $forgot_passwordObj->get_last_sent_email($user_email['user_id'])){
              header('location:successfully-sent.php');
              
            }else{
              $hashed = md5(random_bytes(48));             
              // set session to retrieve later
              $_SESSION['forgot_user_id'] = $user_email['user_id'];
              $_SESSION['forgot_password_hashed'] = $hashed;
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
              $mail->addAddress($user_details['user_email'], $user_details['user_firstname'].' '.$user_details['user_lastname']);
              $mail->Subject = 'RECOVER ACCOUNT';
              $mail->msgHTML('none');
              $mail->Body = '
                  <!DOCTYPE html>
                  <html lang="en">
                  <head>
                  </head>
                  <body>
                  <strong><a href="https://kenogym.online/login/change_pass.php?code='.$hashed.'">https://kenogym.online/login/change_pass.php?code='.$hashed.'"</a></strong><br> if this is not you, please contact us
                  </body>
                  </html>
                  ';

              if ($mail->send()) {
                  // insert to db here
                  $forgot_passwordObj->insert($user_email['user_id'],$hashed);
              } else {
                  echo 'Mailer Error: ' . $mail->ErrorInfo;
              }
            }
            
        }
      
    }
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
  <link rel="icon" type="images/x-icon" href="../images/favicon.png">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/log-in.css">
  <link rel="stylesheet" href="../css/boxicons.min.css">
  <script defer src="../js/bootstrap.bundle.min.js"></script>
  <html itemscope itemtype="http://schema.org/Article">

<script src="https://apis.google.com/js/platform.js" async defer></script>

</head>
<body>
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
          <a class="text-decoration-none text-black m-0" aria-current="page" href="log-in.php"><span class='bx bxs-left-arrow align-middle fs-4'></span>Go Back</a>
          <div class="container px-4">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <!-- <div class="bg-danger text-dark bg-opacity-10 border border-danger rounded-1">
                  <div class="py-2 ms-3">
                    Insert Text Here
                  </div>
                </div> -->
                <div class="text-center mt-2">
                  <input type="submit" value="Recover" name="recover" class="btn btn-dark">
                  <!-- <a href="succesfully-sent.php" class="btn btn-dark">Next</a> -->
                </div>
            </form>
            <br>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>