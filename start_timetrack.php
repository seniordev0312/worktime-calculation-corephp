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

  $sql = "INSERT INTO cm_ho_working_plans (STAFF_ID, WORK_DATE, TIME_START) VALUES ('{$_POST["id"]}', '{$date_day}', '{$date_time}')";
  $result = $conn->query($sql);

  $conn->close();

}

?>