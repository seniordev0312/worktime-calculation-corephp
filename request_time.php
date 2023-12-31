<?php
require 'envParse.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('db.php');
date_default_timezone_set('Europe/London');

$date_day = date("Y-m-d");

$mail = new PHPMailer(true);
                  
//Set PHPMailer to use SMTP.
$mail->isSMTP();        
//Set SMTP host name                      
$mail->Host = $env['SMTP_HOST'];
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                      
//Provide username and password
$mail->Username = $env['SMTP_USER'];             
$mail->Password = $env['SMTP_PASS'];                       
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                       
//Set TCP port to connect to
$mail->Port = 587;                    
$mail->From = $env['SENDER_MAIL'];
$mail->FromName = $_GET['name'] . " ". $_GET['surname'];
$mail->addAddress($env['RECEIVER_MAIL'], "Ugur");
$mail->isHTML(true);
$mail->Subject = "Time Request";
$mail->Body = "<h4>Hi, Ugur! <br> I want to " .$_GET["date"]. " take overtime time off. "  .$_GET["hours"] . " hours <br> Kind Regards <br> " . $_GET['name'] . " ". $_GET['surname'] . "</h4>";
try {
  // For checking if connection is
  // successful or not
  if ($conn->connect_error) {
    echo "connection failed";
    die("Connection failed: "
        . $conn->connect_error);
  }
  $hour = (int)$_GET["hours"];
  $sql_check = "SELECT * FROM cm_ho_working_report_plans WHERE STAFF_ID = '{$_GET['id']}' AND WORK_DATE = '{$_GET["date"]}'";
  $result_check = $conn->query($sql_check);
  if($result_check->num_rows > 0) {
    $updateQuery = "UPDATE cm_ho_working_report_plans SET (HOURS_TOTAL='$hour',  STATUS = 'pending') WHERE STAFF_ID ='{$_GET['id']}' AND WORK_DATE = '$date_day'";

    $updateResult = $conn->query($updateQuery);
  } else {
    $createQuery = "INSERT INTO cm_ho_working_report_plans (HOURS_TOTAL, WORK_DATE, STAFF_ID, STATUS ) VALUES ('{$hour}', '{$_GET['date']}', '{$_GET['id']}', 'pending')";
    $conn->query($createQuery);
  }
  try {
  
    $mail->send();
    
    echo 'Request submitted successfully.';
  } catch (Exception $e) {
    echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
  }
  
} catch (Exception $e) {
  echo "Time track still not started";
}

?>