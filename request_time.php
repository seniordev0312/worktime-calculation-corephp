<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require 'vendor\phpmailer\phpmailer\src\Exception.php';

/* The main PHPMailer class. */
require 'vendor\phpmailer\phpmailer\src\PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'vendor\phpmailer\phpmailer\src\SMTP.php';

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
//Enable SMTP debugging.
$mail->SMTPDebug = 3;                           
//Set PHPMailer to use SMTP.
$mail->isSMTP();        
//Set SMTP host name                      
$mail->Host = "mail.smtp2go.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                      
//Provide username and password
$mail->Username = "freelancer-smtp";             
$mail->Password = "Devsenior0312!!!";                       
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                       
//Set TCP port to connect to
$mail->Port = 465;                    
$mail->From = "devsonspree@gmail.com";
$mail->FromName = "Full Name";
$mail->addAddress("devsenior0312@gmail.com", "Recepient Name");
$mail->isHTML(true);
$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";
if(!$mail->send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
echo "Message has been sent successfully";
}

?>