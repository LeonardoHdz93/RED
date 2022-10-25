<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";
$mail = new PHPMailer(true);

//Enable SMTP debugging.
$mail->SMTPDebug = 3;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "hernandez.melendez.leonardo@gmail.com";                 
$mail->Password = "Ichl1evedish";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "UTF-8";                           
//Set TCP port to connect to
$mail->Port = 587;                                   

$mail->From = "leonardohm1604@gmail.com";
$mail->FromName = "Leonardo";

$mail->addAddress("leonardohm1604@gmail.com", "leonardo");

$mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";

try {
    $mail->send();
    echo "Message has been sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}