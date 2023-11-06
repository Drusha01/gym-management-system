<?php
// start session
session_start();


// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';
require_once '../classes/email.class.php';
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
      // validate if the email is taken
      if(isset($_POST['email']) && validate_email($_POST)){
        $userObj = new users();
        $userObj->setuser_email($_POST['email']);

        // verify if email is taken
        if($user_email = $userObj->user_duplicateEmail()){
          print_r($user_email);
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
                  echo 'insert successfully';
              }
              echo 'code';
            }
          }else{
            //header('location:user-change-email-address.php');
          }
        }
        // must be code
      }else if(isset($_POST['code'])  ){
        $emailObj = new email();
        $email_data = $emailObj->verify($_SESSION['user_id']);
        if($_SESSION['user_id'] == $email_data['email_verify_user_id'] && $_POST['code'] ==$email_data['email_verify_code'] ){
          print_r($email_data);
          // update user email and user validated email
          $userObj = new users();
          if($userObj->update_email($email_data['email_verify_user_id'],$email_data['email_verify_email'])){
            
           // update session
           $_SESSION['user_email'] = $email_data['email_verify_email'];
           $_SESSION['user_email_verified'] = 1;
           header('location:user-profile.php');
          }
        }
      }
      else{
        //header('location:user-change-email-address.php');
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

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VERIFY EMAIL</title>
</head>
<body>
    <h3>EMAIL VERIFICATION</h3>
    <form action="" method="POST">
        <label for="">EMAIL SENT TO <?php echo  $_GET['email']?></label><br>
        
        <label for="">code</label>
        <input type="number" name="code" id="" value="">
        <input type="submit" value="next" name="next" >
    </form>
</body>
</html>