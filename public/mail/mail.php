<?php
   require '../vendor/autoload.php';
   use PHPMailer\PHPMailer\PHPMailer;
   $mail = new PHPMailer();
   $mail->isSMTP();
   $mail->SMTPDebug = 2;
   $mail->Host = 'smtp.hostinger.com';
   $mail->Port = 587;
   $mail->SMTPAuth = true;
   $mail->Username = 'kenogymofficial@kenogym.online';
   $mail->Password = 'Uwat09hanz@2';
   $mail->setFrom('kenogymofficial@kenogym.online', 'KENO FITNESS CENTER');
   $mail->addReplyTo('kenogymofficial@kenogym.online', 'KENO FITNESS CENTER');
   $mail->addAddress('hanz.dumapit53@gmail.com', 'Receiver Name');
   $mail->Subject = 'Checking if PHPMailer works';
   //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
   $mail->Body = 'This is just a plain text message body';
   //$mail->addAttachment('attachment.txt');
   if (!$mail->send()) {
       echo 'Mailer Error: ' . $mail->ErrorInfo;
   } else {
       echo 'The email message was sent.';
   }
?>

