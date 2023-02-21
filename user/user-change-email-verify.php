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
      // validate if the email is taken
      if(isset($_POST['email']) && validate_email($_POST)){
        $userObj = new users();
        $userObj->setuser_email($_POST['email']);

        // verify if email is taken
        $user_email = $userObj->user_duplicateEmail();
        if(!isset($user_email['user_id'])){
            $code = rand(1000000,10000000);
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 2;
            $mail->Host = 'smtp.hostinger.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'kenogymofficial@kenogym.online';
            $mail->Password = 'Uwat09hanz@2keno';
            $mail->setFrom('kenogymofficial@kenogym.online', 'KENO FITNESS CENTER');
            $mail->addReplyTo('kenogymofficial@kenogym.online', 'KENO FITNESS CENTER');
            $mail->addAddress($_POST['email'], $_SESSION['user_firstname'].' '.$_SESSION['user_lastname']);
            $mail->Subject = 'Email Verification';
            $mail->msgHTML(file_get_contents('message.html'), __DIR__);
            $mail->Body = 'Your email verification code is <strong>'.$code.'</strong><br> if this is not you, please contact us';
            //$mail->addAttachment('attachment.txt');
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                // insert to db here

                $emailObj = new email();
                $emailObj->insert($_SESSION['user_id'],$_POST['email'],$code);
                echo 'code';
            }
        }else{
            header('location:user-change-email-address.php');
        }
      }else{
        header('location:user-change-email-address.php');
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
        <label for="">EMAIL SENT TO <?php echo  $_POST['email']?></label><br>
        <label for="">code</label>
        <input type="text" name="code" value="">
        <input type="submit" value="next" name="next" >
    </form>
</body>
</html>