<?php

include('db.php');

if($_POST['id']) {
  // Connection
  $conn = new mysqli($servername,$username, $password, $databasename);
  date_default_timezone_set('Europe/London');

    // For checking if connection is
  // successful or not
  if ($conn->connect_error) {
    echo "connection failed";
    die("Connection failed: "
        . $conn->connect_error);
  }
  $date_time = date("H:i:s");
  $date_day = date("Y-m-d");
  $sql_check = "SELECT * FROM cm_ho_working_plan_data WHERE STAFF_ID = '{$_POST["id"]}' AND WORK_DATE = '{$date_day}'";
  $result_check = $conn->query($sql_check);
  echo $result_check->num_rows;
  if($result_check->num_rows > 0) {
    $id = (int) $_POST["id"];
    $updateQuery = "UPDATE cm_ho_working_plan_data SET TIME_START = '{$date_time}' WHERE STAFF_ID = '{$id}' AND WORK_DATE = '{$date_day}'";
    $result = $conn->query($updateQuery);
    if (!$result) {
      echo $result;
        die('Error: ' . $conn->error);
    }
    echo "1";
    

  } else {
    $sql = "INSERT INTO cm_ho_working_plan_data (STAFF_ID, WORK_DATE, TIME_START) VALUES ('{$_POST["id"]}', '{$date_day}', '{$date_time}')";
    $result = $conn->query($sql);
    if (!$result) {
      echo $conn->error;
        die('Error: ' . $conn->error);
    }
    echo $sql;
  } 

  } 
  // echo "1111";

  $conn->close();


?>