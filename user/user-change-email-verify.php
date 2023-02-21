<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';
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
        $user_email = $userObj->user_duplicateEmail();
        if(!isset($user_email['user_id'])){
            
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
            $mail->addAddress('hanz.dumapit55@gmail.com', $_SESSION['user_firstname'].' '.$_SESSION['user_lastname']);
            $mail->Subject = 'Email Verification';
            $mail->msgHTML(file_get_contents('message.html'), __DIR__);
            $mail->Body = 'This is just a plain text message body';
            //$mail->addAttachment('attachment.txt');
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'The code is';
                echo(rand(1000000,10000000));
            }
        }else{
            header('location:user-change-email-address.php');
        }
        print_r($user_email);
        echo $userObj->getuser_email();
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