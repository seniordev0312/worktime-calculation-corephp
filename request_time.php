<?php
ini_set("SMTP", "smtp.ionos.de");
ini_set("sendmail_from", "devsonspree@gmail.com");

$message = "The mail message was sent with the following mail setting:\r\nSMTP = aspmx.l.google.com\r\nsmtp_port = 25\r\nsendmail_from = YourMail@address.com";

$headers = "From: devsonspree@gmail.com";

mail("devsenior0312@gmail.com", "Testing", $message, $headers);
echo "Check your email now....&lt;BR/>";
?>