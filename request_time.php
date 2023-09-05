<?php
require 'envParse.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
                  
//Set PHPMailer to use SMTP.
$mail->isSMTP();        
//Set SMTP host name                      
$mail->Host = "smtp.ionos.de";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                      
//Provide username and password
$mail->Username = "ueberstunden@cutman-friseur.de";             
$mail->Password = "123.456.Aliveli07";                       
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                       
//Set TCP port to connect to
$mail->Port = 465;                    
$mail->From = "devsonspree@gmail.com";
$mail->FromName = $_GET['name'] . " ". $_GET['surname'];
$mail->addAddress("devsenior0312@gmail.com", "Ugur");
$mail->isHTML(true);
$mail->Subject = "Time Request";
$mail->Body = "<h2>Hi, Ugur!</h2>";
$mail->AltBody = "I want to add " .$_GET['hours']. " more today. Please allow me.";
try {
  $mail->send();
  echo 'Request submitted successfully.';
} catch (Exception $e) {
  echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
}

?>