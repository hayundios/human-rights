<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try{
    //server settings
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP();          
$mail->Host      ='email-smtp.us-east-1.amazonaws.com';
$mail->SMTPAuth  =true;
$mail->Username  ='AKIAVL6JXZDGAGWIM3VG';
$mail->Password  ='oHl4bthnsECE+ye/oP4s2WVg7dwf0HIn/Ai3pJws';
$mail->SMTPSecure = 'tls';
$mail->Port       = 587;

//Recipients
$mail ->setFrom('tosinjohn26@gmail.com', 'Mailer');
$mail ->addAddress('cealcmod77@gmail.com', 'myuser');

//content
$mail ->isHTML(true);
$mail ->Subject = 'HERE IS A CUSTOMER ENTRY';
$mail ->Body    = 'This is the HTML message body <b> </b>';
$mail ->AltBody = 'This is the body in plain text for non-HTML mail clients';

$mail->send();
echo 'Message has been sent';
}
catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


?>