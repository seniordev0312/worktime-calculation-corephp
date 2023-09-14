<?php

include('db.php');

if($_POST['id']) {
  // Connection
  $conn = new mysqli($servername,$username, $password, $databasename);

    // For checking if connection is
  // successful or not
  if ($conn->connect_error) {
    echo "connection failed";
    die("Connection failed: "
        . $conn->connect_error);
  }
  $date_time = date("h:i:s");
  $date_day = date("Y-m-d");
  $sql_check = "SELECT * FROM cm_ho_working_plans WHERE STAFF_ID = '{$_POST["id"]}' AND WORK_DATE = '{$date_day}'";
  $result_check = $conn->query($sql_check);
  if($result_check->num_rows > 0) {
    $id = (int) $_POST["id"];
    $updateQuery = "UPDATE cm_ho_working_plans SET TIME_START = '{$date_time}', TIME_END = '{$end_time}' WHERE STAFF_ID = '{$id}' AND WORK_DATE = '{$date_day}'";
    $result = $conn->query($updateQuery);
    if (!$result) {
      echo $result;
        die('Error: ' . $conn->error);
    }
    echo "1";
    

  } else {
    $sql = "INSERT INTO cm_ho_working_plans (STAFF_ID) VALUES ('{$_POST["id"]}')";
    // $result = $conn->query($sql);
    // if (!$result) {
    //   echo $result;
    //     die('Error: ' . $conn->error);
    // }
    echo "0";
  } 

  } 
  // echo "1111";

  $conn->close();


?>