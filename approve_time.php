<?php

include('db.php');
date_default_timezone_set('Europe/London');

$date_day = date("Y-m-d");

try {
  // For checking if connection is
  // successful or not
  if ($conn->connect_error) {
    echo "connection failed";
    die("Connection failed: "
        . $conn->connect_error);
  }
  $hour = (int)$_GET["hours"];
  $sql_check = "SELECT * FROM cm_ho_working_plans WHERE STAFF_ID = '{$_GET['id']}' AND WORK_DATE = '{$_GET["date"]}'";
  $result_check = $conn->query($sql_check);
  if($result_check->num_rows > 0) {
    $updateQuery = "UPDATE cm_ho_working_plans SET HOURS_TOTAL='$hour' WHERE STAFF_ID ='{$_GET['id']}' AND WORK_DATE = '$date_day'";

    $updateResult = $conn->query($updateQuery);
  } else {
    $createQuery = "INSERT INTO cm_ho_working_plans (HOURS_TOTAL, WORK_DATE, STAFF_ID) VALUES ('{$hour}', '{$_GET['date']}', '{$_GET['id']}')";
    $conn->query($createQuery);
  }
  echo "Successfully Approved!";
  
} catch (Exception $e) {
  echo "Time track still not started";
}

?>