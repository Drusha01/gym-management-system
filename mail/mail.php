<?php
   require '../vendor/autoload.php';
   use PHPMailer\PHPMailer\PHPMailer;
   $mail = new PHPMailer;
   $mail->isSMTP();
   $mail->SMTPDebug = 2;
   $mail->Host = 'smtp.hostinger.com';
   $mail->Port = 587;
   $mail->SMTPAuth = true;
   $mail->Username = 'kenogymofficial@kenogym.online';
   $mail->Password = 'Uwat09hanz@2keno';
   $mail->setFrom('kenogymofficial@kenogym.online', 'Hanrickson receiver');
   $mail->addReplyTo('kenogymofficial@kenogym.online', 'Your Name');
   $mail->addAddress('hanz.dumapit55@gmail.com', 'Receiver Name');
   $mail->Subject = 'Checking if PHPMailer works';
   $mail->msgHTML(file_get_contents('message.html'), __DIR__);
   $mail->Body = 'This is just a plain text message body';
   //$mail->addAttachment('attachment.txt');
   if (!$mail->send()) {
       echo 'Mailer Error: ' . $mail->ErrorInfo;
   } else {
       echo 'The email message was sent.';
   }
?>