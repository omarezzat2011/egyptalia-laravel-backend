<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.hostinger.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'support@egyptalia.com';
$mail->Password = 'sU@304050';
$mail->setFrom('support@egyptalia.com', 'Your Name');
$mail->addReplyTo('support@egyptalia.com', 'Your Name');
$mail->addAddress('omarezzat2011@gmail.com', 'Receiver Name');
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
