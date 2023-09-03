<?php

include('db.php');

if($_POST['id']) {
  // Connection
  $conn = new mysqli($servername,$username, $password, $databasename);
  echo $_POST['id'];

    // For checking if connection is
  // successful or not
  if ($conn->connect_error) {
    echo "connection failed";
    die("Connection failed: "
        . $conn->connect_error);
  }
  $date_time = date("h:i:s");

  $sql = "UPDATE cm_ho_working_plans SET TIME_END='{$date_time}' WHERE STAFF_ID={$_POST['id']}";
  $result = $conn->query($sql);
  if($result->num_rows > 0) {
    echo "1";
  } else {
    echo "0";
  }

  $conn->close();

}

?>